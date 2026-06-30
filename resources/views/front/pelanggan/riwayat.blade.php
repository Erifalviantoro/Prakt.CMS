@extends('front.layout.app')

@section('title', 'Riwayat Booking')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                Riwayat Booking
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Seluruh rekam jejak dan catatan servis kendaraan Anda di MotoFix.
            </p>
        </div>
        
        <!-- Back to Dashboard Link -->
        <a href="{{ route('front.dashboard') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1 self-start md:self-auto">
            &larr; Kembali ke Dashboard
        </a>
    </div>@extends('front.layout.app')

@section('title', 'Riwayat Booking')

@section('content')

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                Riwayat Booking
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Seluruh rekam jejak dan catatan servis kendaraan Anda di MotoFix.
            </p>
        </div>
        
        <!-- Back to Dashboard Link -->
        <a href="{{ route('front.dashboard') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1 self-start md:self-auto">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <!-- Search Bar with Icon -->
    <div class="mb-6 relative max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input type="text"
            placeholder="Cari Nomor Booking..."
            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 shadow-sm transition">
    </div>

    <!-- Card Booking Container -->
    <div class="space-y-4">

        @forelse($bookings as $booking)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md p-5 transition duration-200">
            
            <!-- Card Top Header -->
            <div class="flex justify-between items-start pb-4 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold font-mono text-blue-600">
                        BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                    </p>
                </div>

                <span class="px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider
                    @if($booking->status=='Menunggu')
                        bg-amber-50 text-amber-700 border border-amber-100
                    @elseif($booking->status=='Diproses' || $booking->status=='Dikonfirmasi')
                        bg-blue-50 text-blue-700 border border-blue-100
                    @elseif($booking->status=='Selesai')
                        bg-green-50 text-green-700 border border-green-100
                    @else
                        bg-red-50 text-red-700 border border-red-100
                    @endif">
                    {{ $booking->status }}
                </span>
            </div>

            <!-- Card Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4 text-sm">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Kendaraan</p>
                    <p class="font-semibold text-gray-800 mt-0.5">
                        {{ $booking->kendaraan->merk_kendaraan }} {{ $booking->kendaraan->model_kendaraan }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Jenis Layanan</p>
                    <p class="font-semibold text-gray-700 mt-0.5">
                        {{ $booking->layanan->nama_layanan }}
                    </p>
                </div>

                <!-- Bagian yang diperbaiki untuk mengatasi teks meluber -->
                <div class="min-w-0">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Keluhan / Catatan</p>
                    <p class="text-gray-600 mt-0.5 italic text-xs break-all line-clamp-2" title="{{ $booking->keluhan }}">
                        {{ $booking->keluhan ?? '-' }}
                    </p>
                </div>
            </div>

            <!-- Card Footer Action -->
          <div class="flex justify-end pt-3 border-t border-gray-50">
    <a href="{{ route('front.riwayat.show', $booking->id) }}"
       class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition duration-150">
        Lihat Detail
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </a>
</div>

        </div>
        @empty
        <!-- State jika belum ada booking sama sekali -->
        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center shadow-sm">
            <p class="text-3xl mb-2">📋</p>
            <h3 class="text-sm font-bold text-gray-700">Belum Ada Riwayat</h3>
            <p class="text-xs text-gray-400 mt-1">Seluruh transaksi atau jadwal servis Anda akan terdata di sini.</p>
        </div>
        @endforelse

    </div>

    <!-- Pagination Section -->
    @if($bookings->hasPages())
    <div class="mt-8 bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
        {{ $bookings->links() }}
    </div>
    @endif

</div>

@endsection

    <!-- Search Bar with Icon -->
    <div class="mb-6 relative max-w-md">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input type="text"
            placeholder="Cari Nomor Booking..."
            class="w-full bg-white border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 shadow-sm transition">
    </div>

    <!-- Card Booking Container -->
    <div class="space-y-4">

        @forelse($bookings as $booking)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-md p-5 transition duration-200">
            
            <!-- Card Top Header -->
            <div class="flex justify-between items-start pb-4 border-b border-gray-100">
                <div>
                    <h3 class="text-base font-bold font-mono text-blue-600">
                        BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                    </h3>
                    <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 002-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                    </p>
                </div>

                <span class="px-2.5 py-1 rounded-md text-xs font-semibold uppercase tracking-wider
                    @if($booking->status=='Menunggu')
                        bg-amber-50 text-amber-700 border border-amber-100
                    @elseif($booking->status=='Diproses')
                        bg-blue-50 text-blue-700 border border-blue-100
                    @elseif($booking->status=='Selesai')
                        bg-green-50 text-green-700 border border-green-100
                    @else
                        bg-red-50 text-red-700 border border-red-100
                    @endif">
                    {{ $booking->status }}
                </span>
            </div>

            <!-- Card Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-4 text-sm">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Kendaraan</p>
                    <p class="font-semibold text-gray-800 mt-0.5">
                        {{ $booking->kendaraan->merk_kendaraan }} {{ $booking->kendaraan->model_kendaraan }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Jenis Layanan</p>
                    <p class="font-semibold text-gray-700 mt-0.5">
                        {{ $booking->layanan->nama_layanan }}
                    </p>
                </div>

                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">Keluhan / Catatan</p>
                    <p class="text-gray-600 mt-0.5 italic text-xs">
                        {{ $booking->keluhan ?? '-' }}
                    </p>
                </div>
            </div>

            <!-- Card Footer Action -->
            <div class="flex justify-end pt-3 border-t border-gray-50">
                <a href="#" class="inline-flex items-center gap-1 text-xs font-bold text-gray-700 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg transition duration-150">
                    Lihat Detail 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
        @empty
        <!-- State jika belum ada booking sama sekali -->
        <div class="bg-white border border-gray-200 rounded-2xl p-12 text-center shadow-sm">
            <p class="text-3xl mb-2">📋</p>
            <h3 class="text-sm font-bold text-gray-700">Belum Ada Riwayat</h3>
            <p class="text-xs text-gray-400 mt-1">Seluruh transaksi atau jadwal servis Anda akan terdata di sini.</p>
        </div>
        @endforelse

    </div>

    <!-- Pagination Section -->
    @if($bookings->hasPages())
    <div class="mt-8 bg-white border border-gray-200 rounded-2xl p-4 shadow-sm">
        {{ $bookings->links() }}
    </div>
    @endif

</div>

@endsection