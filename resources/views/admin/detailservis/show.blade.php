@extends('admin.layout.layout')

@section('content')
<main class="pl-64 min-h-screen">
@include('admin.layout.header')

<div class="p-8 max-w-[1280px] mx-auto">

    @if(!$detailServis)
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined">error</span>
            <span>Data detail servis tidak ditemukan atau sistem gagal memuat database.</span>
        </div>
    @else

        <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2 text-outline mb-2">
                    <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                    <a class="font-label-md text-label-md uppercase tracking-wider hover:text-primary transition-colors"
                       href="{{ route('admin.detailservis.index') }}">
                        Kembali ke Daftar Servis
                    </a>
                </div>
                
                <nav class="flex items-center gap-2 mb-3 text-on-surface-variant font-label-md text-label-md">
                    <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <a class="hover:text-primary transition-colors" href="{{ route('admin.detailservis.index') }}">Kelola Servis</a>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                    <span class="text-primary font-bold">Proses Pengerjaan</span>
                </nav>
                
                {{-- 1. Perubahan Judul Halaman --}}
                <h1 class="font-headline-lg text-headline-lg text-primary">Kelola Proses Servis</h1>
                
                <p class="text-on-surface-variant mt-1 flex items-center gap-2">
                    Status Kerja: 
                    @if($detailServis->status_servis == 'selesai')
                        <span class="px-2.5 py-0.5 rounded-full bg-green-100 text-green-700 font-bold text-label-sm uppercase tracking-wider">
                            Selesai
                        </span>
                    @elseif($detailServis->status_servis == 'proses')
                        <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-700 font-bold text-label-sm uppercase tracking-wider animate-pulse">
                            Proses Pengerjaan
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full bg-orange-100 text-orange-700 font-bold text-label-sm uppercase tracking-wider">
                            Dalam Antrian
                        </span>
                    @endif
                </p>
            </div>
            
            {{-- 2, 3, 4, 5, 11. Kontrol Tombol Alur Kerja Berdasarkan Status Komponen --}}
            <div class="flex flex-wrap items-center gap-3">
                <button onclick="window.print()" class="px-5 py-2.5 border border-primary text-primary rounded-lg font-bold flex items-center gap-2 hover:bg-primary hover:text-on-primary transition-all">
                    <span class="material-symbols-outlined">print</span>
                    Cetak Lembar Kerja
                </button>

                @if($detailServis->status_servis == 'antrian' || !$detailServis->status_servis)
                    {{-- Tombol Mulai Kerja --}}
                    <form method="POST" action="{{ route('admin.detailservis.mulai', $detailServis->id) }}">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-lg flex items-center gap-2 shadow-md hover:bg-blue-700 transition-all active:scale-95">
                            <span class="material-symbols-outlined">play_arrow</span>
                            Mulai Servis
                        </button>
                    </form>
                @endif

                @if($detailServis->status_servis == 'proses')
                    {{-- Tombol Selesaikan Kerja --}}
                    <form method="POST" action="{{ route('admin.detailservis.selesai', $detailServis->id) }}">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-lg flex items-center gap-2 shadow-md hover:bg-green-700 transition-all active:scale-95">
                            <span class="material-symbols-outlined">check_circle</span>
                            Selesaikan Servis
                        </button>
                    </form>
                @endif

                @if($detailServis->status_servis == 'selesai')
                    {{-- Tombol Alur Lanjutan ke Modul Transaksi --}}
                    <span class="px-4 py-2.5 bg-green-50 text-green-700 border border-green-200 font-bold text-sm rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Servis Selesai
                    </span>
                    <a href="{{ route('admin.transaksi.create', ['booking_id' => $detailServis->booking_id]) }}" 
                       class="px-6 py-2.5 bg-primary text-white font-bold rounded-lg flex items-center gap-2 shadow-md hover:bg-primary-container transition-all active:scale-95">
                        <span class="material-symbols-outlined">receipt_long</span>
                        Buat Invoice / Transaksi
                    </a>
                @endif
            </div>
        </div>

        {{-- 7. Komponen Progress Servis Alur Kerja Visual --}}
        <div class="bg-white border border-outline-variant rounded-xl p-6 mb-8 shadow-sm">
            <h3 class="text-sm font-bold uppercase tracking-wider text-outline mb-4">Progress Alur Pengerjaan</h3>
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 relative">
                
                <div class="flex items-center gap-3 z-10">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm bg-green-600 text-white shadow">✓</div>
                    <div>
                        <p class="font-bold text-sm text-primary">Booking Diterima</p>
                        <p class="text-xs text-gray-500">Otomatis Terbuat</p>
                    </div>
                </div>

                <div class="hidden md:block flex-1 h-0.5 bg-gray-200 {{ $detailServis->status_servis == 'proses' || $detailServis->status_servis == 'selesai' ? 'bg-green-600' : '' }}"></div>

                <div class="flex items-center gap-3 z-10">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm {{ $detailServis->status_servis == 'proses' || $detailServis->status_servis == 'selesai' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600' }} shadow">
                        {{ $detailServis->status_servis == 'proses' || $detailServis->status_servis == 'selesai' ? '✓' : '2' }}
                    </div>
                    <div>
                        <p class="font-bold text-sm {{ $detailServis->status_servis == 'proses' || $detailServis->status_servis == 'selesai' ? 'text-primary' : 'text-gray-400' }}">Mulai Kerja / Proses</p>
                        <p class="text-xs text-gray-500">Mekanik Standby</p>
                    </div>
                </div>

                <div class="hidden md:block flex-1 h-0.5 bg-gray-200 {{ $detailServis->status_servis == 'selesai' ? 'bg-green-600' : '' }}"></div>

                <div class="flex items-center gap-3 z-10">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm {{ $detailServis->status_servis == 'selesai' ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600' }} shadow">
                        {{ $detailServis->status_servis == 'selesai' ? '✓' : '3' }}
                    </div>
                    <div>
                        <p class="font-bold text-sm {{ $detailServis->status_servis == 'selesai' ? 'text-primary' : 'text-gray-400' }}">Pengerjaan Selesai</p>
                        <p class="text-xs text-gray-500">Pengecekan Akhir</p>
                    </div>
                </div>

                <div class="hidden md:block flex-1 h-0.5 bg-gray-200"></div>

                <div class="flex items-center gap-3 z-10">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm bg-gray-200 text-gray-600 shadow">4</div>
                    <div>
                        <p class="font-bold text-sm text-gray-400">Kasir / Invoice</p>
                        <p class="text-xs text-gray-500">Pembayaran</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 space-y-6">
                
                {{-- 8. Informasi Ringkas Booking & Kendaraan --}}
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="bg-primary px-6 py-4">
                        <h2 class="text-on-primary font-headline-md text-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined">layers</span>
                            Informasi Registrasi Booking & Kendaraan
                        </h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">Kode Booking</p>
                            <p class="font-bold text-body-lg text-primary">BK-{{ str_pad($detailServis->booking_id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">Nama Pelanggan</p>
                            <p class="font-bold text-body-md text-primary">{{ $detailServis->booking->pelanggan->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">Merek & Model</p>
                            <p class="font-bold text-body-md text-primary">
                                {{ $detailServis->booking->kendaraan->merk_kendaraan ?? '-' }} {{ $detailServis->booking->kendaraan->model_kendaraan ?? '' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1 font-bold">Nomor Plat</p>
                            <span class="px-2 py-1 bg-gray-900 text-yellow-400 font-mono font-bold rounded tracking-wide text-sm inline-block">
                                {{ $detailServis->booking->kendaraan->nomor_plat ?? '-' }}
                            </span>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="bg-primary px-6 py-4">
                        <h2 class="text-on-primary font-headline-md text-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined">construction</span>
                            Detail Pengerjaan Mekanik
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex flex-col md:flex-row md:items-start gap-8">
                            <div class="w-full md:w-1/3">
                                <p class="text-label-sm text-outline uppercase mb-1">Teknisi Utama</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                        {{ strtoupper(substr($detailServis->teknisi->nama ?? 'M', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-body-md text-primary">{{ $detailServis->teknisi->nama ?? 'Belum Ditentukan' }}</p>
                                        <p class="text-label-sm text-on-surface-variant">Mekanik Penanggung Jawab</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-2/3">
                                <p class="text-label-sm text-outline uppercase mb-1">Jenis Servis & Keluhan</p>
                                <p class="font-bold text-body-lg text-primary mb-1">{{ $detailServis->jenis_servis ?? 'Servis Reguler' }}</p>
                                <p class="text-body-md text-on-surface leading-relaxed whitespace-pre-line">{{ $detailServis->deskripsi ?? 'Tidak ada deskripsi keluhan.' }}</p>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-secondary">
                            <p class="text-label-sm text-secondary font-bold uppercase mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">note</span>
                                Catatan Tambahan Mekanik
                            </p>
                            <p class="text-body-md text-on-surface italic">{{ $detailServis->catatan ? $detailServis->catatan : 'Tidak ada catatan pengerjaan tambahan dari mekanik.' }}</p>
                        </div>
                    </div>
                </section>

                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="bg-primary px-6 py-4 flex items-center justify-between">
                        <h2 class="text-on-primary font-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined">build_circle</span>
                            Penggunaan Suku Cadang / Sparepart
                        </h2>
                        
                        {{-- 4, 9. Tombol Tambah Sparepart hanya muncul saat status pengerjaan 'proses' --}}
                        @if($detailServis->status_servis == 'proses')
                            <a href="{{ route('admin.penggunaan-sparepart.create', ['detail_servis_id' => $detailServis->id]) }}" 
                               class="bg-secondary hover:bg-opacity-95 text-white px-4 py-2 text-sm font-bold rounded-lg flex items-center gap-1 transition-all">
                                <span class="material-symbols-outlined text-[18px]">add</span>
                                Tambah Sparepart
                            </a>
                        @endif
                    </div>

                    <div class="p-6">
                        @php
                            $totalSparepart = $detailServis->penggunaanSparepart->sum('subtotal');
                            $total = $detailServis->biaya_jasa + $totalSparepart;
                        @endphp

                        {{-- 10. Tampilan List Suku Cadang Terpasang Otomatis --}}
                        <table class="w-full">
                            <thead>
                                <tr class="border-b text-outline text-label-md">
                                    <th class="text-left py-2 font-bold">Item Sparepart</th>
                                    <th class="text-center py-2 font-bold">Jumlah</th>
                                    <th class="text-right py-2 font-bold">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($detailServis->penggunaanSparepart as $item)
                                    <tr class="border-b text-body-md text-on-surface">
                                        <td class="py-3 font-medium">
                                            {{ $item->sparepart->nama ?? '-' }}
                                        </td>
                                        <td class="text-center font-bold">
                                            {{ $item->jumlah }} Pcs
                                        </td>
                                        <td class="text-right text-primary font-bold">
                                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-6 text-gray-400 text-sm">
                                            Belum ada penggunaan suku cadang (sparepart) pada pekerjaan ini.
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>

                {{-- 6. Ringkasan Komponen Finansial Pengerjaan --}}
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm p-6">
                    <h3 class="font-headline-md text-primary mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined">payments</span>
                        Kalkulasi Ringkasan Biaya Sementara
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between text-body-md text-on-surface-variant">
                            <span>Biaya Jasa Mekanik / Perbaikan</span>
                            <span class="font-bold text-on-surface">
                                Rp {{ number_format($detailServis->biaya_jasa, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between text-body-md text-on-surface-variant">
                            <span>Total Akumulasi Suku Cadang (Sparepart)</span>
                            <span class="font-bold text-on-surface">
                                Rp {{ number_format($totalSparepart, 0, ',', '.') }}
                            </span>
                        </div>
                        <hr class="my-3 border-outline-variant">
                        <div class="flex justify-between font-bold text-lg">
                            <span class="text-primary">Total Biaya Pengerjaan</span>
                            <span class="text-primary text-xl">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-span-12 lg:col-span-4 space-y-6">
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm p-6">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined">schedule</span>
                        Waktu & Durasi Kerja
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant">
                            <span class="text-on-surface-variant font-label-md">Waktu Mulai</span>
                            <span class="font-bold text-primary">
                                {{ $detailServis->waktu_mulai ? \Carbon\Carbon::parse($detailServis->waktu_mulai)->format('d M Y H:i') : 'Belum Dimulai' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant">
                            <span class="text-on-surface-variant font-label-md">Waktu Selesai</span>
                            <span class="font-bold text-primary">
                                {{ $detailServis->waktu_selesai ? \Carbon\Carbon::parse($detailServis->waktu_selesai)->format('d M Y H:i') : 'Proses Pengerjaan' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-on-surface-variant font-label-md">Total Durasi</span>
                            @php
                            $durasi = '-';
                            if($detailServis->waktu_mulai && $detailServis->waktu_selesai){
                                $start = \Carbon\Carbon::parse($detailServis->waktu_mulai);
                                $end = \Carbon\Carbon::parse($detailServis->waktu_selesai);
                                $durasi = $start->diffInMinutes($end);
                            }
                            @endphp
                            <span class="px-3 py-1 bg-primary text-on-primary rounded-full font-bold text-label-md">
                                {{ $durasi !== '-' ? ($durasi > 60 ? round($durasi/60, 1) . ' Jam' : $durasi . ' Menit') : '-' }}
                            </span>
                        </div>
                    </div>
                </section>

                <div class="relative h-64 rounded-xl overflow-hidden group shadow-md">
                    <div class="absolute inset-0 bg-primary/40 group-hover:bg-primary/20 transition-colors duration-300 z-10"></div>
                    <img alt="Motorcycle Workshop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://images.unsplash.com/photo-1485965120184-e220f721d03e?auto=format&fit=crop&w=600&q=80"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent flex flex-col justify-end p-6 z-20">
                        <p class="text-on-primary font-bold text-body-lg">Sistem Bengkel Presisi</p>
                        <p class="text-on-primary-container text-label-sm">Pantau kualitas berkendara konsumen dengan penanganan berstandar tinggi.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
</main>
@endsection