@extends('front.layout.app')

@section('title', 'Cek Status Booking')

@section('content')

<main class="py-24 bg-slate-50 min-h-screen px-4 md:px-8">
    <div class="max-w-4xl mx-auto">

        <div class="text-center mb-12">
            <span class="px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-bold uppercase tracking-wider mb-3 inline-block">
                Status Pelayanan
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 tracking-tight mb-3">
                Cek Status Booking Anda
            </h1>
            <p class="text-slate-500 max-w-md mx-auto text-sm md:text-base">
                Pantau proses perbaikan dan status administrasi kendaraan Anda secara real-time.
            </p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm shadow-slate-100/50 mb-10">
            <form action="{{ route('front.status.booking.cari') }}" method="POST">
                @csrf
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 font-medium text-sm">
                            +62
                        </span>
                        <input
                            type="text"
                            name="nomor_telepon"
                            value="{{ old('nomor_telepon') }}"
                            placeholder="Masukkan nomor telepon terdaftar"
                            class="w-full border border-slate-200 rounded-xl pl-14 pr-4 py-3.5 text-sm focus:outline-none focus:ring-4 focus:ring-red-600/5 focus:border-red-600 transition-all placeholder:text-slate-400"
                            required>
                    </div>

                    <button
                        type="submit"
                        class="bg-red-600 text-white px-8 py-3.5 rounded-xl font-semibold text-sm hover:bg-red-700 transition-all shadow-md shadow-red-600/10 active:scale-[0.98]">
                        Cari Status
                    </button>
                </div>
            </form>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-8 flex items-start gap-3 text-sm font-medium">
                <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($bookings))
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                    <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                        <span>Hasil Pencarian</span>
                        <span class="bg-slate-100 text-slate-600 text-xs px-2 py-0.5 rounded-full">{{ count($bookings) }} Data</span>
                    </h3>
                </div>

                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden transition-all hover:shadow-md">
                        
                        <div class="bg-slate-50/70 px-6 py-4 border-b border-slate-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                            <div>
                                <span class="text-xs font-mono font-bold text-slate-400 uppercase tracking-wider block">KODE BOOKING</span>
                                <h4 class="font-extrabold text-slate-800 text-base">
                                    #BKG-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                </h4>
                            </div>
                            
                            <div>
                                @if(in_array(strtolower($booking->status), ['menunggu', 'pending']))
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-amber-50 text-amber-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Menunggu
                                    </span>
                                @elseif(in_array(strtolower($booking->status), ['dikonfirmasi', 'proses', 'disetujui'])) {{--  Selesai Diperbaiki Di Sini --}}
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Dikonfirmasi
                                    </span>
                                @elseif(strtolower($booking->status) == 'selesai')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Selesai Servis
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-50 text-slate-700 rounded-full text-xs font-bold uppercase tracking-wider">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> {{ $booking->status }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 border-b border-slate-100 pb-6 text-sm">
                                <div>
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Pelanggan</p>
                                    <p class="font-bold text-slate-800">{{ $booking->pelanggan->nama }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $booking->pelanggan->nomor_telepon }}</p>
                                </div>

                                <div>
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Kendaraan</p>
                                    <p class="font-bold text-slate-800">{{ $booking->kendaraan->model ?? 'Kendaraan' }}</p>
                                    <p class="text-xs font-mono text-slate-500 bg-slate-100 px-1.5 py-0.5 rounded inline-block mt-1 font-semibold">
                                        {{ $booking->kendaraan->nomor_plat ?? $booking->kendaraan->no_polisi ?? '-' }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Tanggal Booking</p>
                                    <p class="font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d M Y') }}
                                    </p>
                                </div>

                                <div>
                                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Layanan Utama</p>
                                    <p class="font-bold text-red-600">{{ $booking->layanan->nama_layanan ?? 'Servis Reguler' }}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1.5">Keluhan/Catatan Pelanggan</p>
                                <div class="bg-slate-50/80 p-3.5 rounded-xl text-slate-600 text-sm border border-slate-100 leading-relaxed">
                                    "{!! $booking->keluhan ?? 'Tidak ada keluhan tertulis.' !!}"
                                </div>
                            </div>

                            @if($booking->detailServis)
                                <div class="mt-6 pt-6 border-t border-slate-100">
                                    <div class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-xl p-5 text-white">
                                        <div class="flex items-center gap-2 mb-4">
                                            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                                            <h5 class="font-bold text-sm uppercase tracking-wider text-slate-300">
                                                Update Proses Bengkel
                                            </h5>
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-sm mb-4">
                                            <div class="bg-white/5 p-3 rounded-lg border border-white/10">
                                                <p class="text-white/50 text-xs mb-0.5">Mekanik Handal</p>
                                                <p class="font-bold text-white">{{ $booking->detailServis->teknisi->nama ?? 'Menunjuk Teknisi...' }}</p>
                                            </div>

                                            <div class="bg-white/5 p-3 rounded-lg border border-white/10">
                                                <p class="text-white/50 text-xs mb-0.5">Status Pengerjaan</p>
                                                <span class="font-bold text-amber-400 uppercase tracking-wide text-xs">
                                                    {{ $booking->detailServis->status_servis }}
                                                </span>
                                            </div>

                                            <div class="bg-white/5 p-3 rounded-lg border border-white/10">
                                                <p class="text-white/50 text-xs mb-0.5">Estimasi Selesai</p>
                                                <p class="font-bold text-white">{{ $booking->detailServis->estimasi_selesai ?? '-' }}</p>
                                            </div>
                                        </div>

                                        @if($booking->detailServis->transaksi)
                                            <div class="mt-4 pt-4 border-t border-white/10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                                                <div>
                                                    <span class="text-white/40 text-xs block">Total Biaya Akhir</span>
                                                    <span class="text-xl font-extrabold text-white">
                                                        Rp {{ number_format($booking->detailServis->transaksi->total_biaya, 0, ',', '.') }}
                                                    </span>
                                                </div>

                                                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                                                    @if(in_array(strtolower($booking->detailServis->transaksi->status_pembayaran), ['lunas', 'sukses']))
                                                        <span class="px-4 py-1.5 bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 rounded-lg text-xs font-bold uppercase tracking-wider inline-block text-center">
                                                            ✓ Pembayaran Lunas
                                                        </span>
                                                    @else
                                                        <span class="px-4 py-1.5 bg-amber-500/20 border border-amber-500/30 text-amber-400 rounded-lg text-xs font-bold uppercase tracking-wider inline-block text-center md:animate-pulse">
                                                            🛈 Menunggu Pembayaran
                                                        </span>
                                                        
                                                        <a href="https://wa.me/6281234567890?text={{ urlencode('Halo Admin MotoFix, saya ingin mengonfirmasi pembayaran untuk:'."\n\n".'• Kode Booking: #BKG-'.str_pad($booking->id, 5, '0', STR_PAD_LEFT)."\n".'• Nama Pelanggan: '.$booking->pelanggan->nama."\n".'• Total Biaya: Rp '.number_format($booking->detailServis->transaksi->total_biaya, 0, ',', '.')."\n\n".'Berikut saya lampirkan bukti transfernya.') }}" 
                                                           target="_blank"
                                                           class="inline-flex items-center justify-center gap-2 px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-xs font-bold uppercase tracking-wider transition-all shadow-md active:scale-95">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.503-5.729-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.742.002-2.599-1.012-5.042-2.856-6.886-1.843-1.844-4.291-2.859-6.892-2.86-5.445 0-9.87 4.374-9.875 9.745-.002 1.777.472 3.51 1.371 5.042l-.993 3.626 3.756-.976zm11.455-6.812c-.29-.145-1.714-.836-1.979-.932-.266-.096-.459-.145-.653.145-.193.291-.748.932-.917 1.125-.169.193-.338.217-.627.072-.29-.145-1.224-.445-2.33-1.417-.86-.757-1.44-1.693-1.609-1.982-.169-.29-.018-.447.126-.59.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.096-.193.048-.361-.024-.507-.072-.145-.653-1.545-.894-2.124-.235-.564-.474-.488-.653-.497-.169-.008-.361-.01-.554-.01-.193 0-.507.072-.772.361-.266.291-1.013.977-1.013 2.383 0 1.407 1.038 2.766 1.182 2.959.145.193 2.043 3.08 4.949 4.3c.691.291 1.231.465 1.652.596.694.218 1.327.187 1.826.113.557-.082 1.714-.691 1.956-1.359.242-.667.242-1.24.17-1.359-.073-.118-.266-.19-.555-.335z"/>
                                                            </svg>
                                                            Konfirmasi Pembayaran
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="mt-6 pt-6 border-t border-slate-100">
                                    <div class="bg-amber-50/50 border border-amber-100 rounded-xl p-4 flex items-center gap-3 text-amber-800 text-sm">
                                        <svg class="w-5 h-5 text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        <p class="font-medium">Booking Anda telah sukses diverifikasi sistem. Harap tunggu antrean panggilan mekanik.</p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-slate-100 rounded-2xl p-12 text-center shadow-sm">
                        <div class="w-16 h-16 bg-slate-50 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-1">Data Tidak Ditemukan</h4>
                        <p class="text-slate-400 text-sm max-w-xs mx-auto">
                            Nomor telepon tidak cocok atau belum melakukan reservasi servis apa pun.
                        </p>
                    </div>
                @endforelse
            </div>
        @endif

    </div>
</main>

@endsection