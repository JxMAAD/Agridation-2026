<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            // penerima notifikasi
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // pengirim/admin (optional)
            $table->foreignId('sender_id')->nullable()->constrained('users')->nullOnDelete();
            // judul notif
            $table->string('title');
            // isi notif
            $table->text('message');
            // tipe notif
            $table->enum('type', ['payment', 'submission', 'announcement', 'schedule', 'team', 'system'])->default('system');
            // link tujuan frontend
            $table->string('url')->nullable();
            // icon frontend
            $table->string('icon')->nullable();
            // warna badge frontend
            $table->string('color')->nullable();
            // apakah sudah dibaca
            $table->boolean('is_read')->default(false);
            // waktu dibaca
            $table->timestamp('read_at')->nullable();
            // data tambahan json
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
