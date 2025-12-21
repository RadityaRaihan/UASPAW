<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pastikan baris ini ADA
        $table->string('title');
        $table->enum('type', ['lost', 'found']);
        $table->string('category');
        $table->text('description');
        $table->string('image_url')->nullable();
        $table->decimal('latitude', 10, 8);
        $table->decimal('longitude', 11, 8);
        $table->string('status')->default('open');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
