@extends('front.layout.app')

@section('title', 'Layanan Servis')

@section('content')
<main class="overflow-x-hidden w-full">
    <section class="bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 h-[350px] flex items-center justify-center text-center px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Layanan Servis Kami</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">Perawatan berkala dan perbaikan spesifik dengan standar presisi tinggi untuk performa motor yang optimal.</p>
        </div>
    </section>

    <section class="py-24 bg-slate-50 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pilih Layanan Terbaik</h2>
                <p class="text-slate-600">Kami menyediakan berbagai macam perawatan mekanis yang ditangani oleh teknisi ahli.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($layanans ?? [] as $layanan)
                    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden flex flex-col justify-between p-8 hover:shadow-md hover:border-blue-600 transition-all group">
                        <div>
                            <div class="w-12 h-12 bg-slate-100 text-slate-700 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                                <span class="material-symbols-outlined text-2xl">build</span>
                            </div>
                            
                            <h3 class="font-bold text-2xl text-slate-900 mb-2">
                                {{ $layanan->nama_layanan }}
                            </h3>
                            
                            <p class="text-xl font-black text-blue-600 mb-4">
                                Rp {{ number_format($layanan->harga, 0, ',', '.') }}
                            </p>
                            
                            <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3">
                                {{ Str::limit($layanan->deskripsi ?? 'Perawatan performa motor menyeluruh untuk menjaga efisiensi dan keamanan berkendara Anda.', 120) }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            @if(isset($layanan->estimasi_waktu))
                                <span class="text-xs text-slate-500 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">schedule</span> {{ $layanan->estimasi_waktu }}
                                </span>
                            @else
                                <span></span>
                            @endif
                            <a href="{{ route('front.layanan.show', $layanan->id) }}" class="inline-flex items-center gap-1 text-sm font-bold text-slate-900 hover:text-blue-600 transition-colors">
                                Lihat Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200 text-slate-500">
                        <span class="material-symbols-outlined text-5xl mb-3">handyman</span>
                        <p class="text-lg font-medium">Belum ada layanan yang tersedia saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="bg-slate-900 rounded-3xl p-12 text-center">
                <h2 class="text-3xl font-bold text-white mb-6">Ingin Menjadwalkan Servis Rutin?</h2>
                <p class="text-white/80 mb-8 max-w-md mx-auto">Gunakan layanan booking online kami untuk memilih mekanik pilihan dan mengamankan antrean prioritas.</p>
                <a href="{{ route('front.booking.create') }}" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all shadow-md">
                    Booking Sekarang
                </a>
            </div>
        </div>
    </section>
</main>
@endsection