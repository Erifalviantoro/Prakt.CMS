@extends('front.layout.app')

@section('title', 'Detail Riwayat Booking')

@section('content')

<div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    
    <!-- 1. Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <span class="text-xs font-bold font-mono text-blue-600 bg-blue-50 px-3 py-1 rounded-md tracking-wider">
                BK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
            </span>
            <h2 class="text-2xl font-bold text-gray-900 tracking-tight mt-2">
                Detail Riwayat Booking
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Informasi lengkap proses dan rincian servis kendaraan Anda.
            </p>
        </div>

        <span class="px-4 py-1.5 rounded-full text-sm font-semibold self-start sm:self-auto uppercase tracking-wide shadow-sm
            @if($booking->status=='Menunggu')
                bg-amber-50 text-amber-700 border border-amber-200
            @elseif($booking->status=='Diproses' || $booking->status=='Dikonfirmasi')
                bg-blue-50 text-blue-700 border border-blue-200
            @elseif($booking->status=='Selesai')
                bg-green-50 text-green-700 border border-green-200
            @else
                bg-red-50 text-red-700 border border-red-200
            @endif">
            ● {{ $booking->status }}
        </span>
    </div>

    <!-- MAIN TWO-COLUMN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI (2/3): Detail Data -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Informasi Booking -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-3">
                    <span class="text-lg">📋</span>
                    <h3 class="font-bold text-gray-800 text-base">Informasi Booking</h3>
                </div>

                <div class="grid grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Tanggal Booking</p>
                        <p class="font-semibold text-gray-800 mt-0.5">
                            {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d F Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Layanan</p>
                        <p class="font-semibold text-blue-600 mt-0.5">
                            {{ $booking->layanan->nama_layanan }}
                        </p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Keluhan / Catatan</p>
                        <p class="text-gray-700 bg-gray-50 rounded-xl p-3 mt-1.5 border border-gray-100 text-xs italic break-words">
                            "{{ $booking->keluhan ?? 'Tidak ada keluhan tertulis.' }}"
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card Kendaraan -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-3">
                    <span class="text-lg">🏍️</span>
                    <h3 class="font-bold text-gray-800 text-base">Data Kendaraan</h3>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Nomor Plat</p>
                        <p class="font-mono font-bold text-gray-900 bg-gray-100 px-2 py-0.5 rounded inline-block mt-1 text-xs">
                            {{ $booking->kendaraan->nomor_plat }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Merk</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $booking->kendaraan->merk_kendaraan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Model</p>
                        <p class="font-semibold text-gray-800 mt-1">{{ $booking->kendaraan->model_kendaraan }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider">Tahun</p>
                        <p class="font-semibold text-gray-600 mt-1">{{ $booking->kendaraan->tahun_pembuatan }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Servis & Mekanik -->
            @if($booking->detailServis)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-50 pb-3">
                    <span class="text-lg">🛠️</span>
                    <h3 class="font-bold text-gray-800 text-base">Detail Pengerjaan</h3>
                </div>
                
                <div class="text-sm space-y-4">
                    <div class="flex items-center gap-3 bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-sm">
                            {{ strtoupper(substr($booking->detailServis->teknisi->nama, 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider">Teknisi / Mekanik</p>
                            <p class="font-semibold text-gray-800 text-xs">{{ $booking->detailServis->teknisi->nama }}</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-400 uppercase tracking-wider mb-2">Catatan & Tindakan Mekanik</p>
                        <div class="bg-amber-50/60 text-amber-900 rounded-xl p-4 border border-amber-100 text-xs leading-relaxed font-sans whitespace-pre-line">
                            {{ $booking->detailServis->catatan }}
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- KOLOM KANAN (1/3): Status Tracker & Pembayaran -->
        <div class="space-y-6">
            
            <!-- Modern Vertical Progress Tracker -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h3 class="font-bold text-gray-800 text-base mb-5 border-b border-gray-50 pb-2">Status Servis</h3>
                
                <div class="relative pl-6 space-y-6 before:absolute before:bottom-2 before:top-2 before:left-1.5 before:w-0.5 before:bg-gray-200">
                    
                    <!-- Step 1: Dibuat -->
                    <div class="relative">
                        <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-green-500 border-4 border-white ring-1 ring-green-500 flex items-center justify-center"></div>
                        <p class="text-xs font-bold text-gray-800">Booking Dibuat</p>
                        <p class="text-[10px] text-gray-400">Permintaan berhasil dikirim</p>
                    </div>

                    <!-- Step 2: Dikonfirmasi -->
                    <div class="relative">
                        <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-green-500 border-4 border-white ring-1 ring-green-500"></div>
                        <p class="text-xs font-bold text-gray-800">Dikonfirmasi</p>
                        <p class="text-[10px] text-gray-400">Jadwal disetujui bengkel</p>
                    </div>

                    <!-- Step 3: Diproses -->
                    <div class="relative">
                        @if($booking->status=="Diproses" || $booking->status=="Selesai")
                            <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-green-500 border-4 border-white ring-1 ring-green-500"></div>
                            <p class="text-xs font-bold text-gray-800">Sedang Diservis</p>
                            <p class="text-[10px] text-gray-400">Motor ditangani mekanik</p>
                        @else
                            <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-gray-200 border-4 border-white ring-1 ring-gray-300"></div>
                            <p class="text-xs font-medium text-gray-400">Sedang Diservis</p>
                        @endif
                    </div>

                    <!-- Step 4: Selesai -->
                    <div class="relative">
                        @if($booking->status=="Selesai")
                            <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-green-500 border-4 border-white ring-1 ring-green-500"></div>
                            <p class="text-xs font-bold text-gray-800">Servis Selesai</p>
                            <p class="text-[10px] text-gray-400">Motor siap diambil</p>
                        @else
                            <div class="absolute -left-6 mt-0.5 w-3.5 h-3.5 rounded-full bg-gray-200 border-4 border-white ring-1 ring-gray-300"></div>
                            <p class="text-xs font-medium text-gray-400">Servis Selesai</p>
                        @endif
                    </div>

                </div>
            </div>

            <!-- Total Biaya / Invoice Ringkas -->
            @if($booking->detailServis && $booking->detailServis->transaksi)
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm overflow-hidden relative">
                <div class="absolute top-0 inset-x-0 h-1.5 bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                
                <h3 class="font-bold text-gray-800 text-base mb-4">Rincian Pembayaran</h3>
                
                <div class="text-xs space-y-2.5 pb-4 border-b border-dashed border-gray-200 text-gray-600">
                    <div class="flex justify-between">
                        <span>Jasa Servis</span>
                        <span>
                            Rp {{ number_format($booking->detailServis->transaksi->total_jasa, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Sparepart</span>
                        <span>
                            Rp {{ number_format($booking->detailServis->transaksi->total_sparepart, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <span class="font-bold">Total Bayar</span>
                        <strong>
                            Rp {{ number_format($booking->detailServis->transaksi->total_biaya, 0, ',', '.') }}
                        </strong>
                    </div>
            </div>
            @endif

        </div>
    </div>

    <!-- Back Button Section -->
    <div class="mt-8 border-t border-gray-200 pt-6">
        <a href="{{ route('front.riwayat') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-700 bg-white border border-gray-300 hover:bg-gray-50 px-5 py-2.5 rounded-xl transition shadow-sm">
            &larr; Kembali ke Riwayat
        </a>
    </div>

</div>

@endsection