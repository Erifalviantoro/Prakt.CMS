@extends('front.layout.app')

@section('title', 'Booking Berhasil')

@section('content')
<main class="py-24 bg-surface-container-low px-margin-desktop min-h-[70vh] flex items-center">
    <div class="max-w-xl mx-auto bg-white border border-outline-variant rounded-3xl p-12 text-center shadow-sm space-y-6">
        
        <!-- Ikon Sukses -->
        <div class="w-20 h-20 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto shadow-inner animate-bounce">
            <span class="material-symbols-outlined text-5xl">check_circle</span>
        </div>

        <!-- Judul -->
        <div class="space-y-2">
            <h1 class="font-headline-lg text-headline-lg text-primary">Booking Berhasil!</h1>
            <p class="text-sm text-secondary font-semibold">Terima kasih, {{ session('nama_pelanggan') ?? 'Pelanggan Setia' }}</p>
        </div>
@if(isset($booking))
<div class="bg-primary/5 border border-primary/10 rounded-2xl p-5">
    <p class="text-xs uppercase tracking-widest text-gray-500 mb-2">
        Nomor Booking Anda
    </p>

    <h2 class="text-3xl font-bold text-primary">
        #BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
    </h2>

    <p class="text-xs text-gray-500 mt-2">
        Simpan nomor ini untuk memudahkan pengecekan status servis.
    </p>
</div>
@endif
        <!-- Deskripsi -->
        <p class="text-on-surface-variant leading-relaxed text-sm max-w-md mx-auto">
            Data pendaftaran dan jadwal pengerjaan servis Anda telah tersimpan di sistem kami. Customer service Sumber Baru Motor akan segera menghubungi Anda melalui WhatsApp/Telepon untuk konfirmasi jam kedatangan.
        </p>

        <!-- Informasi Tambahan Ringkas -->
        <div class="bg-surface-container-low p-4 rounded-2xl text-xs text-on-surface-variant flex items-start gap-3 text-left">
            <span class="material-symbols-outlined text-secondary text-sm flex-shrink-0">info</span>
            <p>Harap membawa kendaraan tepat waktu sesuai hari yang dipilih, dan tunjukkan nomor telepon terdaftar Anda pada bagian administrasi bengkel.</p>
        </div>

        <hr class="border-outline-variant">

        <!-- Navigasi -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center pt-2">
            <a href="{{ route('front.status.booking') }}"class="px-6 py-3 border border-primary text-primary rounded-xl font-bold hover:bg-primary/5 transition-all text-sm flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-sm">search</span>
                Lihat Status Booking
            </a>
            <a href="{{ route('front.home') }}" class="px-6 py-3 bg-primary text-white rounded-xl font-bold hover:bg-primary-container transition-all shadow-sm text-sm">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</main>
@endsection