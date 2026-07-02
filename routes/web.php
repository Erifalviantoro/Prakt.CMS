<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MekanikController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\PenggunaanSparepartController;
use App\Http\Controllers\Admin\SparepartController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\DetailServisController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda mendaftarkan rute web untuk aplikasi. Semua rute di dalam
| grup middleware "admin" diproteksi secara ketat.
|
*/

// Alur Default: Redirect ke Halaman Utama User
Route::get('/', function () {
    return redirect()->route('front.home');
});

/**
 * ==========================================
 * GRUP RUTE ADMIN (Grup Middleware Utama)
 * ==========================================
 */
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Poin 4: Resource Booking Terbatasi (Hanya kelola & update status)
        Route::resource('booking', BookingController::class)->only([
            'index', 'show', 'edit', 'update'
        ]);

        // Poin 5: Resource Master Data & Operasional Bengkel
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('kendaraan', KendaraanController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('mekanik', MekanikController::class);
        Route::resource('sparepart', SparepartController::class);
        Route::resource('penggunaan-sparepart', PenggunaanSparepartController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::resource('detailservis', DetailServisController::class);

        // Poin 1: Pindahan Rute Aksi Tombol Mulai & Selesai Detail Servis (Kini Konsisten dengan /admin/...)
        Route::post('detailservis/{id}/mulai', [DetailServisController::class, 'mulai'])->name('detailservis.mulai');
        Route::post('detailservis/{id}/selesai', [DetailServisController::class, 'selesai'])->name('detailservis.selesai');

        // Poin 3: Pindahan Rute Manajemen Kontak Feedback (Sisi Admin)
        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts');
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

        // Poin 9: Usulan Rute Cetak Termal / PDF Invoice Khusus untuk Demo Aplikasi Lebih Profesional
        Route::get('transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');

        // Menu Modul Laporan Eksekutif Bengkel
        Route::prefix('laporan')->name('laporan.')->group(function () {
            Route::get('/', [LaporanController::class, 'index'])->name('index');
            Route::get('/booking', [LaporanController::class, 'booking'])->name('booking');
            Route::get('/pelanggan', [LaporanController::class, 'pelanggan'])->name('pelanggan');
            Route::get('/kendaraan', [LaporanController::class, 'kendaraan'])->name('kendaraan');
            Route::get('/layanan', [LaporanController::class, 'layanan'])->name('layanan');
            Route::get('/mekanik', [LaporanController::class, 'mekanik'])->name('mekanik');
            Route::get('/detail-servis', [LaporanController::class, 'detailServis'])->name('detail_servis');
            Route::get('/sparepart', [LaporanController::class, 'sparepart'])->name('sparepart');
            Route::get('/penggunaan-sparepart', [LaporanController::class, 'penggunaanSparepart'])->name('penggunaan_sparepart');
            Route::get('/transaksi', [LaporanController::class, 'transaksi'])->name('transaksi'); 
        });
});

/**
 * ==========================================
 * GRUP RUTE DEPAN / PUBLIC FRONTEND
 * ==========================================
 */
Route::prefix('front')->name('front.')->group(function () {
    // Halaman Statis & Informasi
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/tentang-kami', [FrontController::class, 'tentang'])->name('tentang');
    Route::get('/kontak', [FrontController::class, 'kontak'])->name('kontak');

    // Berita & Edukasi Otomotif
    Route::get('/berita', [FrontController::class, 'berita'])->name('berita.index');
    Route::get('/berita/{id}', [FrontController::class, 'detailBerita'])->name('berita.show');

    // Katalog Layanan Servis Bengkel
    Route::get('/layanan', [FrontController::class, 'layanan'])->name('layanan.index');
    Route::get('/layanan/{id}', [FrontController::class, 'detailLayanan'])->name('layanan.show');

    // Fitur Cek Status Booking & Progres Mekanik Real-time via Kode Booking
    Route::get('/status-booking', [FrontController::class, 'statusBooking'])->name('status.booking');
    Route::post('/status-booking', [FrontController::class, 'cariStatusBooking'])->name('status.booking.cari');

    // Proteksi Autentikasi Pengguna/Pelanggan Umum
    Route::middleware(['auth','pelanggan'])->group(function () {
        // Reservasi Booking Online
        Route::get('/booking', [FrontController::class, 'booking'])->name('booking.create');
        Route::post('/booking', [FrontController::class, 'storeBooking'])->name('booking.store');
        
        // Dashboard Profil, Pengaturan Akun, & Riwayat Nota Masa Lalu
        Route::get('/dashboard', [FrontController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [FrontController::class, 'profile'])->name('profile');
        Route::get('/profile/edit', [FrontController::class, 'editProfile'])->name('profile.edit');
        Route::put('/profile/update', [FrontController::class, 'updateProfile'])->name('profile.update');
        Route::get('/riwayat', [FrontController::class, 'riwayat'])->name('riwayat');
        Route::get('/riwayat/{id}', [FrontController::class, 'detailRiwayat'])->name('riwayat.show');
    });
    
    // Halaman Berhasil Reservasi
    Route::get('/booking/sukses', [FrontController::class, 'bookingSukses'])->name('booking.sukses');
});

// Poin 2: Simpan Satu Rute Kirim Pesan / Hubungi Kami untuk Publik (Duplikat Lain Sudah Dihapus)
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Poin 7: Rute Manajemen Profil Bawaan Breeze (Tetap Dipertahankan)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Poin 8: Penertiban Kode -> Rute statis `Route::get('/profil')` yang usang telah dihapus dengan sukses.

require __DIR__.'/auth.php';