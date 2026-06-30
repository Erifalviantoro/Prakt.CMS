@extends('front.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    
    <!-- 1. Header Section -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                Halo, <span class="text-blue-600">{{ Auth::user()->name }}</span> 👋
            </h2>
            <p class="text-sm text-gray-500 mt-1">Selamat Datang di Dashboard MotoFix</p>
        </div>
        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
            Pelanggan Aktif
        </span>
    </div>

    <!-- MAIN GRID SYSTEM (Menu Cepat di Kiri, Konten Utama di Kanan) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI: Menu Cepat (Sticky agar ikut bergerak saat di-scroll) -->
        <div class="space-y-4 lg:sticky lg:top-6 order-2 lg:order-1">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Menu Cepat</h3>
            <div class="grid grid-cols-1 gap-3">
                <a href="#" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-xl group-hover:scale-110 transition duration-200">🛠️</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Booking Servis</p>
                        <p class="text-xs text-gray-400 mt-0.5">Buat jadwal baru</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="#" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-50 text-xl group-hover:scale-110 transition duration-200">📋</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Riwayat Booking</p>
                        <p class="text-xs text-gray-400 mt-0.5">Semua catatan servis</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="#" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-50 text-xl group-hover:scale-110 transition duration-200">👤</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Profil Saya</p>
                        <p class="text-xs text-gray-400 mt-0.5">Data diri & motor</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="#" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-50 text-xl group-hover:scale-110 transition duration-200">🔍</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Cek Status</p>
                        <p class="text-xs text-gray-400 mt-0.5">Pantau live pengerjaan</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>
            </div>

            <!-- Jam Operasional Bengkel -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">🕒 Jam Operasional</h4>
                <div class="text-xs space-y-1.5 text-gray-600">
                    <div class="flex justify-between"><span>Senin - Sabtu:</span><span class="font-semibold text-gray-800">08:00 - 17:00</span></div>
                    <div class="flex justify-between"><span>Minggu:</span><span class="text-red-500 font-semibold">Libur</span></div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Konten Utama (Mengambil 2/3 Bagian Layar) -->
        <div class="lg:col-span-2 space-y-6 order-1 lg:order-2">
            
            <!-- 2. Ringkasan Status Angka -->
            <div class="grid grid-cols-4 gap-3">
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase">Booking</p>
                    <p class="text-lg font-bold text-gray-800 mt-0.5">5</p>
                </div>
                <div class="bg-amber-50 p-3 rounded-xl border border-amber-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-amber-600 uppercase">Menunggu</p>
                    <p class="text-lg font-bold text-amber-800 mt-0.5">1</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-xl border border-blue-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-blue-600 uppercase">Diproses</p>
                    <p class="text-lg font-bold text-blue-800 mt-0.5">1</p>
                </div>
                <div class="bg-green-50 p-3 rounded-xl border border-green-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-green-600 uppercase">Selesai</p>
                    <p class="text-lg font-bold text-green-800 mt-0.5">3</p>
                </div>
            </div>

            <!-- 3. Booking Aktif Card -->
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Booking Aktif</h3>
                <div class="bg-gradient-to-br from-gray-900 to-slate-800 rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-[10px] text-gray-400 font-mono tracking-widest">NO. BOOKING</p>
                            <p class="text-xl font-bold font-mono text-blue-400">BK-00012</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-500/20 text-amber-300 border border-amber-500/30">
                            Menunggu
                        </span>
                    </div>
                    <div class="border-t border-gray-700/60 my-4"></div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-400">Sepeda Motor</p>
                            <p class="text-sm font-semibold text-gray-100">Honda Beat</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Jenis Layanan</p>
                            <p class="text-sm font-semibold text-gray-100">Servis Berkala</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Riwayat Booking Terbaru (Ringkas & Bersih) -->
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Riwayat Booking Terbaru</h3>
                <div class="divide-y divide-gray-100">
                    <!-- Item Riwayat 1 -->
                    <div class="flex justify-between items-center py-3 first:pt-0 last:pb-0">
                        <div>
                            <p class="text-sm font-bold text-gray-800">BK-00011</p>
                            <p class="text-xs text-gray-400">25 Juni &bull; Ganti Oli</p>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Selesai</span>
                    </div>
                    <!-- Item Riwayat 2 -->
                    <div class="flex justify-between items-center py-3 last:pb-0">
                        <div>
                            <p class="text-sm font-bold text-gray-800">BK-00010</p>
                            <p class="text-xs text-gray-400">15 Juni &bull; Tune Up</p>
                        </div>
                        <span class="px-2.5 py-1 text-xs font-semibold rounded bg-green-100 text-green-800">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- 5. Promo & Tips Grid Campuran (Mengisi Sektor Bawah) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Promo Bulan Ini -->
                <div class="bg-gradient-to-br from-red-500 to-amber-600 rounded-2xl p-5 text-white shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="bg-white/20 text-white text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wide">Promo Juni</span>
                        <h4 class="text-base font-bold mt-2 leading-snug">Diskon 15% Paket Tune Up Spesial!</h4>
                        <p class="text-xs text-red-100 mt-1">Berlaku untuk semua tipe motor matic sepanjang bulan ini.</p>
                    </div>
                    <div class="mt-4">
                        <span class="text-xs font-bold bg-white text-red-600 px-3 py-1.5 rounded-lg inline-block">Gunakan Kode: FIXJUNI</span>
                    </div>
                </div>

                <!-- Tips Perawatan Motor -->
                <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex flex-col justify-between">
                    <div>
                        <span class="bg-blue-100 text-blue-700 text-[10px] px-2 py-0.5 rounded font-bold uppercase tracking-wide">Tips Edukasi</span>
                        <h4 class="text-base font-bold text-gray-800 mt-2 leading-snug">Kapan Harus Ganti Oli Gardan?</h4>
                        <p class="text-xs text-gray-500 mt-1">Oli gardan matic sebaiknya diganti setiap 2x ganti oli mesin atau per 8.000 km.</p>
                    </div>
                    <div class="mt-4">
                        <a href="#" class="text-xs font-bold text-blue-600 hover:underline">Pelajari Selengkapnya &rarr;</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection