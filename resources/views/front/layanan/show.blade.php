@extends('front.layout.app')

@section('title', 'Detail Layanan - ' . $layanan->nama_layanan)

@section('content')
<main class="py-24 bg-surface-container-low px-margin-desktop">
    <div class="max-w-container-max-width mx-auto">
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('front.layanan.index') }}" class="inline-flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-semibold">
                <span class="material-symbols-outlined">arrow_back</span> Kembali ke Daftar Layanan
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter items-start">
            <!-- Sisi Kiri: Detail Deskripsi -->
            <div class="lg:col-span-8 bg-white border border-outline-variant rounded-2xl p-8 space-y-6 shadow-sm">
                <div>
                    <span class="inline-block px-3 py-1 bg-secondary/10 text-secondary text-xs font-semibold rounded-full mb-3">Layanan Utama</span>
                    <h1 class="font-headline-lg text-headline-lg text-primary">{{ $layanan->nama_layanan }}</h1>
                </div>

                <hr class="border-outline-variant">

                <div class="space-y-4">
                    <h3 class="font-bold text-lg text-primary">Deskripsi Layanan</h3>
                    <p class="text-on-surface-variant leading-relaxed whitespace-pre-line">
                        {{ $layanan->deskripsi ?? 'Belum ada penjelasan detail untuk layanan ini. Silakan hubungi tim support atau mekanik kami di bengkel untuk informasi lebih lanjut mengenai pengerjaan mekanis ini.' }}
                    </p>
                </div>
            </div>

            <!-- Sisi Kanan: Informasi Card Kontrak / Ringkasan Harga -->
            <div class="lg:col-span-4 bg-white border border-outline-variant rounded-2xl p-8 shadow-sm space-y-6 sticky top-24">
                <h3 class="font-bold text-lg text-primary">Informasi Biaya & Estimasi</h3>
                
                <!-- Harga -->
                <div class="bg-surface-container-low p-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-2xl">payments</span>
                        <span class="text-sm font-medium text-on-surface-variant">Biaya Jasa</span>
                    </div>
                    <span class="text-xl font-black text-primary">
                        Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                    </span>
                </div>

                <!-- Estimasi Waktu -->
                <div class="bg-surface-container-low p-4 rounded-xl flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-secondary text-2xl">schedule</span>
                        <span class="text-sm font-medium text-on-surface-variant">Estimasi Kerja</span>
                    </div>
                    <span class="text-base font-bold text-primary">
                        {{ $layanan->estimasi_waktu ?? '1-2 Jam' }}
                    </span>
                </div>

                <!-- Informasi Tambahan -->
                <div class="text-xs text-on-surface-variant/80 space-y-2 p-2">
                    <div class="flex gap-2 items-start">
                        <span class="material-symbols-outlined text-sm text-secondary">info</span>
                        <p>Harga tertera merupakan harga jasa servis, tidak termasuk penggantian sparepart tambahan jika diperlukan.</p>
                    </div>
                </div>

                <hr class="border-outline-variant">

                <!-- Action Button -->
                <a href="{{ route('front.booking.create', ['layanan_id' => $layanan->id]) }}" class="w-full text-center inline-block bg-primary text-white py-4 rounded-xl font-bold hover:bg-primary-container transition-all shadow-md">
                    Booking Layanan Ini
                </a>
            </div>
        </div>
    </div>
</main>
@endsection