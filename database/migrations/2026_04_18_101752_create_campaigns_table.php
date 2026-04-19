<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->enum('kategori', ['qurban', 'darurat', 'pendidikan', 'kesehatan', 'zakat', 'masjid']);
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->text('deskripsi');
            $table->json('tags')->nullable();
            $table->unsignedBigInteger('target_dana');
            $table->unsignedBigInteger('donasi_minimum')->default(10000);
            $table->date('tanggal_mulai');
            $table->date('tanggal_berakhir');
            $table->enum('tipe', ['reguler', 'promo', 'darurat', 'wakaf'])->default('reguler');
            $table->string('thumbnail')->nullable();
            $table->string('url_video')->nullable();
            $table->enum('status', ['aktif', 'draft', 'jadwal'])->default('draft');
            $table->timestamp('jadwal_tayang')->nullable();
            $table->boolean('tampil_beranda')->default(true);
            $table->boolean('izin_anonim')->default(true);
            $table->boolean('tampil_jumlah_donatur')->default(true);
            $table->boolean('notif_email_lembaga')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};