@extends('front.layout.app')

@section('title', 'Layanan Servis')

@section('content')
<main class="overflow-x-hidden w-full">
    <!-- 1. Hero Section -->
    <section class="relative h-[500px] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/70 to-blue-950/70 z-10"></div>
            <img src="{{ asset('images/service-banner.jpg') }}" class="w-full h-full object-cover">
        </div>

        <div class="relative z-20 max-w-container-max-width mx-auto px-margin-desktop w-full text-center px-4">
            <span class="inline-block bg-secondary/20 text-secondary-fixed-dim px-4 py-2 rounded-full font-label-md text-label-md border border-secondary/30">
                Bengkel Profesional
            </span>

            <h1 class="font-headline-xl text-headline-xl text-white mt-6 leading-tight max-w-4xl mx-auto">
                Layanan Servis Motor <br><span class="text-secondary-fixed-dim">Profesional & Terpercaya</span>
            </h1>

            <p class="font-body-lg text-body-lg text-white/80 mt-6 max-w-2xl mx-auto">
                Menyediakan berbagai layanan perawatan dan perbaikan motor dengan mekanik berpengalaman, sparepart berkualitas, dan proses pengerjaan yang cepat serta transparan.
            </p>

            <a href="{{ route('front.booking.create') }}" class="inline-flex items-center gap-2 mt-10 bg-secondary text-white px-8 py-4 rounded-lg font-label-md text-label-md hover:bg-secondary/90 transition-all shadow-lg">
                Booking Servis
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
    </section>

    <!-- Section Daftar Layanan -->
    <section class="py-24 bg-surface-container-low px-4">
        <div class="max-w-container-max-width mx-auto px-margin-desktop">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Pilih Layanan Terbaik</h2>
                <p class="text-on-surface-variant max-w-xl mx-auto">Kami menyediakan berbagai macam perawatan mekanis yang ditangani oleh teknisi ahli.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($layanans ?? [] as $layanan)
                    <!-- 2. Card Layanan -->
<div class="bg-white rounded-3xl shadow-sm border border-outline-variant overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition duration-500 flex flex-col">

    {{-- Gambar --}}
<div class="w-full h-52 overflow-hidden rounded-t-3xl">
    @if($layanan->gambar)
        <img
            src="{{ asset('storage/' . $layanan->gambar) }}"
            alt="{{ $layanan->nama_layanan }}"
            class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
    @else
        <img
            src="{{ asset('images/default-service.jpg') }}"
            alt="Default"
            class="w-full h-full object-cover">
    @endif
</div>             <div class="p-8 flex flex-col flex-grow">
                            <div class="flex justify-between items-start">
                                <div class="w-16 h-16 rounded-2xl bg-primary/5 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-3xl">
                                        engineering
                                    </span>
                                </div>
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                    Tersedia
                                </span>
                            </div>

                            <h3 class="font-headline-md text-[22px] text-primary mt-6">
                                {{ $layanan->nama_layanan }}
                            </h3>

                            <p class="text-on-surface-variant mt-3 leading-relaxed flex-grow">
                                {{ Str::limit($layanan->deskripsi ?? 'Perawatan performa motor menyeluruh untuk menjaga efisiensi dan keamanan berkendara Anda.', 120) }}
                            </p>

                            <div class="flex justify-between items-center mt-8 border-t border-outline-variant/50 pt-4">
                                <div>
                                    <small class="text-on-surface-variant/70 block font-label-sm">Mulai dari</small>
                                    <h4 class="font-headline-md text-[20px] text-secondary">
                                        Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                                    </h4>
                                </div>

                                @if(isset($layanan->estimasi_waktu))
                                    <div class="text-right">
                                        <small class="text-on-surface-variant/70 block font-label-sm">Estimasi</small>
                                        <p class="font-label-md text-primary">{{ $layanan->estimasi_waktu }}</p>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('front.layanan.show', $layanan->id) }}" class="mt-8 flex justify-center items-center gap-2 w-full py-4 rounded-lg text-secondary border border-secondary font-label-md hover:bg-secondary hover:text-white transition-all">
                                Detail Layanan
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-outline-variant text-on-surface-variant">
                        <span class="material-symbols-outlined text-5xl mb-3">handyman</span>
                        <p class="text-lg font-medium">Belum ada layanan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 3. Section Keunggulan -->
    <section class="py-24 bg-white">
        <div class="max-w-container-max-width mx-auto px-margin-desktop px-4">
            <div class="text-center mb-16">
                <h2 class="font-headline-lg text-headline-lg text-primary">Kenapa Memilih Layanan Kami?</h2>
                <p class="text-on-surface-variant mt-4">Kami memberikan pelayanan terbaik untuk menjaga performa kendaraan Anda.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <span class="material-symbols-outlined text-6xl text-secondary">verified</span>
                    <h3 class="font-headline-md text-[18px] text-primary mt-5">Mekanik Profesional</h3>
                    <p class="text-on-surface-variant mt-3">Dikerjakan oleh mekanik berpengalaman dan kompeten.</p>
                </div>

                <div class="text-center">
                    <span class="material-symbols-outlined text-6xl text-secondary">schedule</span>
                    <h3 class="font-headline-md text-[18px] text-primary mt-5">Proses Cepat</h3>
                    <p class="text-on-surface-variant mt-3">Pengerjaan sesuai estimasi dengan kualitas terbaik.</p>
                </div>

                <div class="text-center">
                    <span class="material-symbols-outlined text-6xl text-secondary">inventory_2</span>
                    <h3 class="font-headline-md text-[18px] text-primary mt-5">Sparepart Berkualitas</h3>
                    <p class="text-on-surface-variant mt-3">Menggunakan sparepart yang berkualitas untuk menjaga performa kendaraan.</p>
                </div>

                <div class="text-center">
                    <span class="material-symbols-outlined text-6xl text-secondary">support_agent</span>
                    <h3 class="font-headline-md text-[18px] text-primary mt-5">Pelayanan Ramah</h3>
                    <p class="text-on-surface-variant mt-3">Kami selalu mengutamakan kepuasan pelanggan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. CTA Terakhir -->
    <section class="py-24 px-4 max-w-container-max-width mx-auto px-margin-desktop">
        <div class="rounded-[32px] overflow-hidden bg-primary p-12 text-center relative shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-secondary/20 rounded-full blur-[100px] -mr-32 -mt-32"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/10 rounded-full blur-[100px] -ml-32 -mb-32"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto">
                <h2 class="font-headline-lg text-headline-lg text-white">Siap Merawat Motor Anda?</h2>
                <p class="font-body-lg text-white/70 mt-6 max-w-2xl mx-auto">
                    Lakukan booking servis sekarang dan nikmati proses servis yang cepat, praktis, serta ditangani oleh mekanik profesional.
                </p>
                <a href="{{ route('front.booking.create') }}" class="inline-flex mt-10 px-10 py-4 bg-secondary text-white rounded-xl font-label-md hover:scale-105 transition-all shadow-lg">
                    Booking Servis Sekarang
                </a>
            </div>
        </div>
    </section>
</main>
@endsection