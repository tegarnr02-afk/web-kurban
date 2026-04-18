<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('zakat_payments', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 20)->unique();
            $table->string('nama', 100);
            $table->string('kontak', 100);                     // HP atau email
            $table->enum('jenis_zakat', ['fitrah', 'profesi', 'maal', 'emas', 'perdagangan']);
            $table->unsignedBigInteger('nominal');
            $table->string('laz', 100)->default('BAZNAS');
            $table->enum('metode_bayar', ['transfer', 'ewallet', 'qris', 'va'])->default('transfer');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->boolean('disalurkan')->default(false);
            $table->timestamp('disalurkan_at')->nullable();
            $table->timestamps();

            // Index untuk query riwayat dan admin
            $table->index('kontak');
            $table->index('status');
            $table->index('jenis_zakat');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('zakat_payments');
    }
};