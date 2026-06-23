@extends('admin.layout.layout')

@section('content')
<!-- Main Content Canvas -->
<main class="pl-64 min-h-screen">
<!-- Top Nav Bar -->
@include('admin.layout.header')

<!-- Content Area -->
<div class="p-8 max-w-[1280px] mx-auto">

    <!-- 16. Tambahkan Error Jika Data Kosong -->
    @if(!$detailServis)
        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined">error</span>
            <span>Data detail servis tidak ditemukan atau sistem gagal memuat database.</span>
        </div>
    @else

        <!-- Action Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2 text-outline mb-2">
                    <span class="material-symbols-outlined text-[18px]" data-icon="arrow_back">arrow_back</span>
                    <!-- Tombol Kembali -->
                    <a class="font-label-md text-label-md uppercase tracking-wider hover:text-primary transition-colors"
                       href="{{ route('admin.detailservis.index') }}">
                        Kembali ke Daftar Servis
                    </a>
                </div>
                <!-- Judul Halaman -->
                     <nav class="flex items-center gap-2 mb-8 text-on-surface-variant font-label-md text-label-md">
                        <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
                        <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                        <a class="hover:text-primary transition-colors" href="{{ route('admin.detailservis.index') }}">Detail Servis</a>
                    </nav>
                <h1 class="font-headline-lg text-headline-lg text-primary">Detail Servis </h1>
                <!-- Logika Status Dokumen/Pengerjaan -->
                <p class="text-on-surface-variant mt-1">Status: 
                    @if($detailServis->waktu_selesai)
                        <span class="px-2.5 py-0.5 rounded-full bg-green-100 text-green-700 font-semibold text-label-sm">
                            Selesai
                        </span>
                    @else
                        <span class="px-2.5 py-0.5 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-label-sm">
                            Proses
                        </span>
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="window.print()" class="px-5 py-2.5 border border-primary text-primary rounded-lg font-bold flex items-center gap-2 hover:bg-primary hover:text-on-primary transition-all">
                    <span class="material-symbols-outlined" data-icon="print">print</span>
                    Cetak Detail Servis
                </button>
                <!-- Tombol Edit -->
                <a href="{{ route('admin.detailservis.edit', $detailServis->id) }}"
                   class="px-5 py-2.5 bg-secondary text-on-secondary rounded-lg font-bold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                    <span class="material-symbols-outlined">
                        edit
                    </span>
                    Edit Data
                </a>
            </div>
        </div>

        <!-- Bento Grid Layout -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Column 1: Transaction & Work Details -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Card 1: Informasi Transaksi -->
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="bg-primary px-6 py-4">
                        <h2 class="text-on-primary font-headline-md text-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined" data-icon="info">info</span>
                            Informasi Transaksi
                        </h2>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">ID Transaksi</p>
                            <p class="font-bold text-body-lg text-primary">{{ $detailServis->transaksi->id ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">Pelanggan</p>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-primary font-bold">
                                    {{ strtoupper(substr($detailServis->transaksi->pelanggan->nama ?? 'P', 0, 2)) }}
                                </div>
                                <p class="font-bold text-body-lg text-primary">{{ $detailServis->transaksi->pelanggan->nama ?? 'Pelanggan Umum' }}</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-label-sm text-outline uppercase mb-1">Metode Pembayaran</p>
                            <p class="font-bold text-body-lg text-primary">{{ $detailServis->transaksi->metode_pembayaran ?? '-' }}</p>
                        </div>
                    </div>
                </section>

                <!-- Card 2: Detail Pengerjaan -->
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
                    <div class="bg-primary px-6 py-4">
                        <h2 class="text-on-primary font-headline-md text-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined" data-icon="construction">construction</span>
                            Detail Pengerjaan
                        </h2>
                    </div>
                    <div class="p-6 space-y-6">
                        <div class="flex flex-col md:flex-row md:items-start gap-8">
                            <div class="w-full md:w-1/3">
                                <p class="text-label-sm text-outline uppercase mb-1">Teknisi Utama</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                        M
                                    </div>
                                    <div>
                                        <!-- Nama Teknisi -->
                                        <p class="font-bold text-body-md text-primary">{{ $detailServis->teknisi->nama ?? '-' }}</p>
                                        <p class="text-label-sm text-on-surface-variant">Mekanik</p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-2/3">
                                <p class="text-label-sm text-outline uppercase mb-1">Keluhan / Deskripsi</p>
                                <!-- Deskripsi Servis -->
                                <p class="text-body-md text-on-surface leading-relaxed whitespace-pre-line">{{ $detailServis->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-secondary">
                            <p class="text-label-sm text-secondary font-bold uppercase mb-1 flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]" data-icon="note">note</span>
                                Catatan Teknisi
                            </p>
                            <!-- Catatan Teknisi -->
                            <p class="text-body-md text-on-surface">{{ $detailServis->catatan ? $detailServis->catatan : 'Tidak ada catatan tambahan.' }}</p>
                        </div>
                    </div>
                </section>

                <!-- Card 3: Daftar Penggunaan Sparepart -->
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm overflow-hidden">
    <div class="bg-primary px-6 py-4">
        <h2 class="text-on-primary font-headline-md">
            Penggunaan Sparepart
        </h2>
    </div>

    <div class="p-6">

        @php
            $totalSparepart =
                $detailServis->penggunaanSparepart->sum('subtotal');

            $total =
                $detailServis->biaya_jasa +
                $totalSparepart;
        @endphp

        <table class="w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Sparepart</th>
                    <th class="text-center py-2">Jumlah</th>
                    <th class="text-right py-2">Subtotal</th>
                </tr>
            </thead>

            <tbody>

                @forelse($detailServis->penggunaanSparepart as $item)

                    <tr class="border-b">

                        <td class="py-2">
                            {{ $item->sparepart->nama ?? '-' }}
                        </td>

                        <td class="text-center">
                            {{ $item->jumlah }}
                        </td>

                        <td class="text-right">
                            Rp {{ number_format($item->subtotal,0,',','.') }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">
                            Belum ada sparepart digunakan
                        </td>
                    </tr>

                @endforelse

            </tbody>
        </table>

    </div>
</section>
<section class="bg-white rounded-xl border border-outline-variant shadow-sm p-6">

    <h3 class="font-headline-md text-primary mb-4">
        Ringkasan Biaya
    </h3>

    <div class="flex justify-between mb-3">
        <span>Biaya Jasa</span>

        <span>
            Rp {{ number_format($detailServis->biaya_jasa,0,',','.') }}
        </span>
    </div>

    <div class="flex justify-between mb-3">
        <span>Total Sparepart</span>

        <span>
            Rp {{ number_format($totalSparepart,0,',','.') }}
        </span>
    </div>

    <hr class="my-3">

    <div class="flex justify-between font-bold text-lg">

        <span>Total Biaya</span>

        <span class="text-primary">
            Rp {{ number_format($total,0,',','.') }}
        </span>

    </div>

</section>
            </div>

            <!-- Column 2: Time Summaries -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Card 4: Waktu & Durasi -->
                <section class="bg-white rounded-xl border border-outline-variant shadow-sm p-6">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined" data-icon="schedule">schedule</span>
                        Waktu &amp; Durasi
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant">
                            <span class="text-on-surface-variant font-label-md">Waktu Mulai</span>
                            <!-- Format Waktu Mulai -->
                            <span class="font-bold text-primary">
                                {{ $detailServis->waktu_mulai ? \Carbon\Carbon::parse($detailServis->waktu_mulai)->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-outline-variant">
                            <span class="text-on-surface-variant font-label-md">Waktu Selesai</span>
                            <!-- Format Waktu Selesai -->
                            <span class="font-bold text-primary">
                                @if($detailServis->waktu_selesai)
                                    {{ \Carbon\Carbon::parse($detailServis->waktu_selesai)->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <span class="text-on-surface-variant font-label-md">Total Durasi</span>
                            <!-- Hitung Selisih Hari Operasional -->
                            @php
                            $durasi = '-';
                            if($detailServis->waktu_mulai && $detailServis->waktu_selesai){
                                $durasi = \Carbon\Carbon::parse($detailServis->waktu_mulai)->diffInDays(\Carbon\Carbon::parse($detailServis->waktu_selesai));
                            }
                            @endphp
                            <span class="px-3 py-1 bg-primary text-on-primary rounded-full font-bold text-label-md">
                                {{ $durasi !== '-' ? $durasi . ' Hari' : '-' }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Image Promo/Atmosphere -->
                <div class="relative h-64 rounded-xl overflow-hidden group shadow-md">
                    <img alt="Motorcycle Engine Close-up" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD--43bgy6b_Xtho5PKYE9rOHiM2ZWWI2VTPbTDThp9udGoC9i3KUwUZ-pu7RrAJQHWV6t4MzrsrPdjlzoCt_ThqmlqC1n28fVuSe2aEsR1JF6RlZVJY-qEi_JQQgYtubl91zs65oOg3NihGkBNSvzJ6knrMukJcTzdU2SOK-2MUJA2PbXLTrFzw1lqPvWLgjt-j4XZk-WYOenRTCbn9xeDx6z49YI4fEQt0MxX6CWWqmBLvRM2zVhglVhgpNUl9ysjwivF_vOkim5e"/>
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent flex flex-col justify-end p-6">
                        <p class="text-on-primary font-bold text-body-lg">Precision Engineering</p>
                        <p class="text-on-primary-container text-label-sm">Quality guarantee on every bolt we turn.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Action Floating (Visible on small screens) -->
        <div class="fixed bottom-6 right-6 md:hidden z-50">
            <a href="{{ route('admin.detailservis.edit', ['detailservi' => $detailServis]) }}" class="bg-secondary text-on-secondary p-4 rounded-full shadow-2xl flex items-center justify-center">
                <span class="material-symbols-outlined" data-icon="edit">edit</span>
            </a>
        </div>

    @endif
</div>
</main>
@endsection