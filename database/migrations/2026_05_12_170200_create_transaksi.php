<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('transaksi', function (Blueprint $table) {
        $table->id();

        $table->foreignId('detail_servis_id')
            ->constrained('detail_servis')
            ->onDelete('cascade');

        $table->decimal('total_jasa', 15, 2)->default(0);
        $table->decimal('total_sparepart', 15, 2)->default(0);
        $table->decimal('total_biaya', 15, 2)->default(0);

        $table->enum('status_pembayaran', [
            'Menunggu Pembayaran',
            'Belum Lunas',
            'Lunas',
            'Gagal'
        ])->default('Menunggu Pembayaran');

        $table->string('metode_pembayaran')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
}