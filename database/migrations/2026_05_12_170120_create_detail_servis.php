<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailServis extends Migration
{
    public function up(): void
    {
        Schema::create('detail_servis', function (Blueprint $table) {
            $table->id();

            // 1. WAJIB: Definisikan tipe dan nama kolom fisik terlebih dahulu
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('teknisi_id')->nullable();

            $table->text('deskripsi')->nullable();
            $table->string('catatan')->nullable();

            // Menggunakan format date/timestamp standar yang aman untuk Oracle
            $table->dateTime('waktu_mulai')->nullable();
            $table->dateTime('waktu_selesai')->nullable();
            $table->string('jenis_servis');
            $table->dateTime('estimasi_selesai')->nullable();

            $table->decimal('biaya_jasa', 15, 2)->default(0);
            
            // Menggunakan string biasa (lebih aman untuk kompatibilitas driver Oracle)
            $table->string('status_servis')->default('menunggu'); 

            $table->timestamps();

            // 2. Definisikan Constraint Foreign Key di bagian bawah
            // Diarahkan ke 'booking' (sesuai nama tabel yang sukses dibuat sebelumnya)
            $table->foreign('booking_id')
                  ->references('id')
                  ->on('booking') 
                  ->onDelete('cascade');

            // Diarahkan ke 'teknisi' (huruf kecil agar konsisten)
            $table->foreign('teknisi_id')
                  ->references('id')
                  ->on('teknisi')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_servis');
    }
}