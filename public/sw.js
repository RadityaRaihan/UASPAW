const CACHE_NAME = 'temubarang-v1';
const RUNTIME_CACHE = 'temubarang-runtime-v1';
const STATIC_ASSETS = [
  '/manifest.json',
  '/icons/icon-192x192.svg',
  '/icons/icon-512x512.svg'
];

// Install event - cache resources
self.addEventListener('install', event => {
  console.log('Service Worker: Installing...');
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Service Worker: Caching static assets');
        return cache.addAll(STATIC_ASSETS);
      })
      .catch(err => console.log('Cache open error:', err))
  );
  self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
  console.log('Service Worker: Activating...');
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME && cacheName !== RUNTIME_CACHE) {
            console.log('Service Worker: Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Skip cross-origin requests entirely
  if (url.origin !== location.origin) return;

  // Always network-first for navigations (HTML documents)
  if (request.mode === 'navigate' || request.destination === 'document') {
    // Do not cache auth-related pages to avoid stale sessions
    const authPaths = ['/login', '/register', '/logout', '/dashboard'];
    if (authPaths.some(p => url.pathname.startsWith(p))) {
      event.respondWith(fetch(request).catch(() => caches.match('/')));
      return;
    }

    event.respondWith(
      fetch(request)
        .then(response => {
          // Optionally cache the page shell for offline fallback
          const responseClone = response.clone();
          caches.open(RUNTIME_CACHE).then(cache => cache.put(request, responseClone)).catch(() => {});
          return response;
        })
        .catch(() => caches.match(request).then(r => r || caches.match('/')))
    );
    return;
  }

  // API requests: network-first, fallback to cache
  if (url.pathname.startsWith('/api/')) {
    event.respondWith(
      fetch(request)
        .then(response => {
          const clone = response.clone();
          caches.open(RUNTIME_CACHE).then(cache => cache.put(request, clone)).catch(() => {});
          return response;
        })
        .catch(() => caches.match(request))
    );
    return;
  }

  // Static assets: cache-first, then network
  if (request.method === 'GET') {
    event.respondWith(
      caches.match(request).then(cached => {
        const fetchPromise = fetch(request)
          .then(networkResponse => {
            if (networkResponse && networkResponse.status === 200) {
              const clone = networkResponse.clone();
              const cacheName = request.destination === 'script' || request.destination === 'style' || request.destination === 'image' ? CACHE_NAME : RUNTIME_CACHE;
              caches.open(cacheName).then(cache => cache.put(request, clone)).catch(() => {});
            }
            return networkResponse;
          })
          .catch(() => cached);

        return cached || fetchPromise;
      })
    );
  }
});

// Handle messages from the app
self.addEventListener('message', event => {
  if (event.data && event.data.type === 'SKIP_WAITING') {
    console.log('Service Worker: Skipping waiting and claiming');
    self.skipWaiting();
  }
});

// Periodic background sync for updates (if supported)
if ('periodicSync' in self.registration) {
  self.addEventListener('periodicsync', event => {
    if (event.tag === 'check-updates') {
      console.log('Service Worker: Checking for updates');
    }
  });
}
