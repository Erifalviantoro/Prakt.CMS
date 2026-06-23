<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('pelanggan_id');
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('layanan_id');

            $table->date('tanggal_booking');

            $table->text('keluhan');

            $table->enum('status', [
                'Menunggu',
                'Dikonfirmasi',
                'Diproses',
                'Selesai',
                'Dibatalkan'
            ])->default('Menunggu');

            $table->timestamps();

            $table->foreign('pelanggan_id')
                  ->references('id')
                  ->on('pelanggan')
                  ->onDelete('cascade');

            $table->foreign('kendaraan_id')
                  ->references('id')
                  ->on('kendaraan')
                  ->onDelete('cascade');

            $table->foreign('layanan_id')
            ->references('id')
            ->on('layanan')
            ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};