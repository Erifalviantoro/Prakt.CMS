<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaanSparepart extends Migration
{
    public function up(): void
    {
        Schema::create('penggunaan_sparepart', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('detail_servis_id');

            $table->unsignedBigInteger('id_sparepart');

            $table->integer('jumlah');

            $table->decimal('subtotal', 15, 2)
                  ->default(0);

            $table->timestamps();

            $table->foreign('detail_servis_id', 'fk_pgn_detail')
                  ->references('id')
                  ->on('detail_servis')
                  ->onDelete('cascade');

            $table->foreign('id_sparepart', 'fk_pgn_spr')
                  ->references('id')
                  ->on('sparepart');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penggunaan_sparepart');
    }
}