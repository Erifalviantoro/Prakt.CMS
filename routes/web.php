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

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('booking', BookingController::class)
        ->only([
            'index',
            'show',
            'edit',
            'update'
        ]);
        Route::resource('pelanggan', PelangganController::class);
        Route::resource('kendaraan', KendaraanController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('mekanik', MekanikController::class);
        Route::resource('sparepart', SparepartController::class);
        Route::resource('penggunaan-sparepart', PenggunaanSparepartController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::resource('detailservis', DetailServisController::class);

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/booking', [LaporanController::class, 'booking'])->name('laporan.booking');
    Route::get('/laporan/pelanggan', [LaporanController::class, 'pelanggan'])->name('laporan.pelanggan');
    Route::get('/laporan/kendaraan', [LaporanController::class, 'kendaraan'])->name('laporan.kendaraan');
    Route::get('/laporan/layanan', [LaporanController::class, 'layanan'])->name('laporan.layanan');
    Route::get('/laporan/mekanik', [LaporanController::class, 'mekanik'])->name('laporan.mekanik');
    Route::get('/laporan/detail-servis', [LaporanController::class, 'detailServis'])->name('laporan.detail_servis');
    Route::get('/laporan/sparepart', [LaporanController::class, 'sparepart'])->name('laporan.sparepart');
    Route::get('/laporan/penggunaan-sparepart', [LaporanController::class, 'penggunaanSparepart'])->name('laporan.penggunaan_sparepart');
    Route::get('/laporan/transaksi', [LaporanController::class, 'transaksi'])->name('laporan.transaksi');
});


Route::post(
    'detailservis/{id}/mulai',
    [DetailServisController::class, 'mulai']
)->name('admin.detailservis.mulai'); // <-- Tambahkan 'admin.' di sini

Route::post(
    'detailservis/{id}/selesai',
    [DetailServisController::class, 'selesai']
)->name('admin.detailservis.selesai'); // <-- Tambahkan 'admin.' di sini


Route::get('/', function () {
    return redirect()->route('front.home');
});
Route::prefix('front')->name('front.')->group(function () {
    // Halaman Utama & Statis
    Route::get('/', [FrontController::class, 'home'])->name('home');
    Route::get('/tentang-kami', [FrontController::class, 'tentang'])->name('tentang');
    Route::get('/kontak', [FrontController::class, 'kontak'])->name('kontak');

    // Fitur Berita
    Route::get('/berita', [FrontController::class, 'berita'])->name('berita.index');
    Route::get('/berita/{id}', [FrontController::class, 'detailBerita'])->name('berita.show'); // Sesuai file show.blade.php di folder berita

    // Fitur Layanan
    Route::get('/layanan', [FrontController::class, 'layanan'])->name('layanan.index');
    Route::get('/layanan/{id}', [FrontController::class, 'detailLayanan'])->name('layanan.show');

    // Fitur Booking
    Route::middleware('auth')->group(function () {
        Route::get('/booking', [FrontController::class, 'booking'])
            ->name('booking.create');

        Route::post('/booking', [FrontController::class, 'storeBooking'])
            ->name('booking.store');
    });
    Route::get('/booking/sukses', [FrontController::class, 'bookingSukses'])->name('booking.sukses');
    
    // Cek Status Servis
Route::get('/status-booking', [FrontController::class, 'statusBooking'])
    ->name('status.booking');

Route::post('/status-booking', [FrontController::class, 'cariStatusBooking'])
    ->name('status.booking.cari');
});

Route::get('/profil', function () {
    return view('profil');
})->name('profil');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
