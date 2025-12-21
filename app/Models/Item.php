<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * Properti $fillable menentukan kolom mana saja yang boleh diisi
     * melalui perintah Item::create([...]) di Controller.
     */
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'type', 
        'category', 
        'image_url', 
        'latitude', 
        'longitude', 
        'status',
        'phone'
    ];

    /**
     * Relasi: Satu barang dilaporkan oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk nomor WA yang diformat untuk link wa.me
     */
    public function getFormattedPhoneAttribute()
    {
        $phone = $this->phone;
        if (!$phone) return null;

        // Hapus semua karakter non-digit
        $phone = preg_replace('/\D/', '', $phone);

        // Jika dimulai dengan 0, ganti dengan 62
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return $phone;
    }
}