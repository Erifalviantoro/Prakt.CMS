@extends('front.layout.app')

@section('title', 'Dashboard')

@section('content')

<div class="max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    
    <!-- 1. Header Section (Greeting Dinamis) -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                Halo, <span class="text-blue-600">{{ $bookingAktif?->pelanggan->nama ?? Auth::user()->name }}</span> 👋
            </h2>
            <p class="text-sm text-gray-500 mt-1">Selamat Datang di Dashboard MotoFix</p>
        </div>
        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
            Pelanggan Aktif
        </span>
    </div>

    <!-- MAIN GRID SYSTEM -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI: Menu Cepat -->
        <div class="space-y-4 lg:sticky lg:top-6 order-2 lg:order-1">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider px-1">Menu Cepat</h3>
            <div class="grid grid-cols-1 gap-3">
                
                <a href="{{ route('front.booking.create') }}" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-xl group-hover:scale-110 transition duration-200">🛠️</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Booking Servis</p>
                        <p class="text-xs text-gray-400 mt-0.5">Buat jadwal baru</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="{{ route('front.riwayat') }}" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-50 text-xl group-hover:scale-110 transition duration-200">📋</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Riwayat Booking</p>
                        <p class="text-xs text-gray-400 mt-0.5">Semua catatan servis</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="{{ route('front.profile') }}" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-purple-50 text-xl group-hover:scale-110 transition duration-200">👤</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Profil Saya</p>
                        <p class="text-xs text-gray-400 mt-0.5">Data diri & motor</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>

                <a href="{{ route('front.status.booking') }}" class="flex items-center gap-4 p-4 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition duration-200 group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-green-50 text-xl group-hover:scale-110 transition duration-200">🔍</div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm text-gray-800 group-hover:text-blue-600 transition">Cek Status</p>
                        <p class="text-xs text-gray-400 mt-0.5">Pantau live pengerjaan</p>
                    </div>
                    <span class="text-gray-300 group-hover:text-blue-500 group-hover:translate-x-1 transition text-sm">&rarr;</span>
                </a>
            </div>

            <!-- Jam Operasional -->
            <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">🕒 Jam Operasional</h4>
                <div class="text-xs space-y-1.5 text-gray-600">
                    <div class="flex justify-between"><span>Senin - Sabtu:</span><span class="font-semibold text-gray-800">08:00 - 17:00</span></div>
                    <div class="flex justify-between"><span>Minggu:</span><span class="text-red-500 font-semibold">Libur</span></div>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN: Konten Utama -->
        <div class="lg:col-span-2 space-y-6 order-1 lg:order-2">
            
            <!-- 2. Card Ringkasan Angka Dinamis -->
            <div class="grid grid-cols-4 gap-3">
                <div class="bg-white p-3 rounded-xl border border-gray-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Booking</p>
                    <p class="text-xl font-bold text-gray-800 mt-0.5 font-mono">{{ $totalBooking }}</p>
                </div>
                <div class="bg-amber-50 p-3 rounded-xl border border-amber-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wider">Menunggu</p>
                    <p class="text-xl font-bold text-amber-800 mt-0.5 font-mono">{{ $menunggu }}</p>
                </div>
                <div class="bg-blue-50 p-3 rounded-xl border border-blue-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-blue-600 uppercase tracking-wider">Diproses</p>
                    <p class="text-xl font-bold text-blue-800 mt-0.5 font-mono">{{ $diproses }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded-xl border border-green-100 shadow-sm text-center">
                    <p class="text-[10px] font-bold text-green-600 uppercase tracking-wider">Selesai</p>
                    <p class="text-xl font-bold text-green-800 mt-0.5 font-mono">{{ $selesai }}</p>
                </div>
            </div>

            <!-- 3. Kondisi Booking Aktif -->
            <div>
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Booking Aktif</h3>
                @if($bookingAktif)
                    <div class="bg-gradient-to-br from-gray-900 to-slate-800 rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <p class="text-[10px] text-gray-400 font-mono tracking-widest">NO. BOOKING</p>
                                <a href="{{ route('front.riwayat.show', $bookingAktif->id) }}" class="text-xl font-bold font-mono text-blue-400 hover:underline tracking-wide">
                                    BK-{{ str_pad($bookingAktif->id, 5, '0', STR_PAD_LEFT) }}
                                </a>
                            </div>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30">
                                {{ $bookingAktif->status }}
                            </span>
                        </div>
                        <div class="border-t border-gray-700/60 my-4"></div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400">Sepeda Motor</p>
                                <p class="text-sm font-semibold text-gray-100">
                                    {{ $bookingAktif->kendaraan->merk_kendaraan }} {{ $bookingAktif->kendaraan->model_kendaraan }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Jenis Layanan</p>
                                <p class="text-sm font-semibold text-gray-100">
                                    {{ $bookingAktif->layanan->nama_layanan }}
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center text-gray-400 text-sm shadow-sm">
                        <span class="block text-2xl mb-1">📅</span> Belum ada booking aktif saat ini.
                    </div>
                @endif
            </div>

            <!-- 4. Riwayat Booking Terkini Loop -->
            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Riwayat Booking Terbaru</h3>
                    <a href="{{ route('front.riwayat') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 inline-flex items-center gap-0.5 transition">
                        Lihat Semua Riwayat &rarr;
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($riwayatBooking as $booking)
                        <div class="flex justify-between items-center py-3.5 first:pt-0 last:pb-0">
                            <div>
                                <a href="{{ route('front.riwayat.show', $booking->id) }}" class="text-sm font-bold text-gray-800 hover:text-blue-600 font-mono tracking-wide">
                                    BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                </a>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}
                                    <span class="mx-1">&bull;</span>
                                    {{ $booking->layanan->nama_layanan }}
                                </p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded {{ $booking->status == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                                {{ $booking->status }}
                            </span>
                        </div>
                    @empty
                        <p class="text-xs text-gray-400 text-center py-4">Belum ada riwayat aktivitas pengerjaan.</p>
                    @endforelse
                </div>
            </div>

            <!-- 5. Promo & Tips Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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