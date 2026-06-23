@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen pb-12">
    @include('admin.layout.header')
    <div class="px-gutter pt-8 max-w-container-max-width mx-auto">
        <div class="flex justify-between items-end mb-8">
            <div>
                <div class="flex items-center gap-2 text-on-surface-variant mb-2">
                    <span class="font-label-sm uppercase tracking-widest text-xs text-gray-400">Transaksi</span>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                    <span class="font-label-sm uppercase tracking-widest text-primary font-bold text-xs">Detail #TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
                <h2 class="font-headline-lg text-3xl font-bold text-primary">Detail Transaksi</h2>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="flex items-center gap-2 px-6 py-3 border border-yellow-500 text-yellow-600 rounded-lg font-label-md hover:bg-yellow-50 transition-all">
                    <span class="material-symbols-outlined text-sm">edit</span>
                    Edit Transaksi
                </a>
                <button onclick="window.print()" class="flex items-center gap-2 px-8 py-3 bg-primary text-white rounded-lg font-label-md shadow-lg hover:brightness-110 active:scale-95 transition-all">
                    <span class="material-symbols-outlined text-sm">print</span>
                    Cetak Invoice
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-4 space-y-6">
                <section class="glass-card bg-white rounded-xl p-6 shadow-sm border border-outline-variant">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-blue-50 text-primary rounded-lg">
                            <span class="material-symbols-outlined">receipt</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-primary font-bold">Info Transaksi</h3>
                            <p class="text-xs text-gray-400">Data administratif utama</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between border-b border-outline-variant pb-3 text-sm">
                            <span class="text-gray-500">ID Transaksi</span>
                            <span class="font-bold text-primary">TRX-{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between border-b border-outline-variant pb-3 text-sm">
                            <span class="text-gray-500">Tanggal Servis</span>
                            <span class="text-on-surface font-medium">{{ \Carbon\Carbon::parse($transaksi->tanggal_servis)->format('d M Y') }}</span>
                        </div>
                        
                        <div class="flex justify-between pb-1 text-sm">
                            <span class="text-gray-500">Status Servis</span>
                            @php
                                $statusServis = strtolower($transaksi->detailServis->status_servis ?? '');
                            @php
                            <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider flex items-center gap-1
                                @if($statusServis === 'selesai')
                                    bg-green-100 text-green-700
                                @elseif($statusServis === 'proses' || $statusServis === 'dikerjakan')
                                    bg-yellow-100 text-yellow-700
                                @else
                                    bg-gray-100 text-gray-600
                                @endif
                            ">
                                @if($statusServis === 'selesai')
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                @elseif($statusServis === 'proses' || $statusServis === 'dikerjakan')
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                @else
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span>
                                @endif
                                {{ $transaksi->detailServis->status_servis ?? 'Menunggu' }}
                            </span>
                        </div>
                    </div>
                </section>

                <section class="glass-card bg-white rounded-xl p-6 shadow-sm border border-outline-variant">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-purple-50 text-purple-700 rounded-lg">
                            <span class="material-symbols-outlined">person</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-primary font-bold">Pelanggan</h3>
                            <p class="text-xs text-gray-400">Kontak dan identitas</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-lg mb-4">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold shadow-sm border border-white">
                                {{ strtoupper(substr($transaksi->pelanggan->nama ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-on-surface">{{ $transaksi->pelanggan->nama ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Pelanggan SBM</p>
                            </div>
                        </div>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center gap-3 text-on-surface">
                                <span class="material-symbols-outlined text-gray-400 text-lg">call</span>
                                <span>{{ $transaksi->pelanggan->nomor_telepon ?? '-' }}</span>
                            </div>
                            <div class="flex items-start gap-3 text-on-surface">
                                <span class="material-symbols-outlined text-gray-400 text-lg mt-0.5">location_on</span>
                                <span class="text-gray-600 text-xs leading-relaxed">{{ $transaksi->pelanggan->alamat ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="glass-card bg-white rounded-xl p-6 shadow-sm border border-outline-variant">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-3 bg-amber-50 text-amber-700 rounded-lg">
                            <span class="material-symbols-outlined">motorcycle</span>
                        </div>
                        <div>
                            <h3 class="font-label-md text-primary font-bold">Kendaraan</h3>
                            <p class="text-xs text-gray-400">Spesifikasi unit pelanggan</p>
                        </div>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-xl text-primary mb-4 border border-blue-100">
                        <p class="text-[10px] uppercase tracking-widest font-semibold opacity-70">Nomor Plat</p>
                        <p class="text-2xl font-black tracking-wide">{{ $transaksi->kendaraan->nomor_plat ?? '-' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-xs text-gray-400">Merk / Model</p>
                            <p class="font-bold text-gray-700">{{ $transaksi->kendaraan->merk ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Tahun Unit</p>
                            <p class="font-bold text-gray-700">{{ $transaksi->kendaraan->tahun ?? '-' }}</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="lg:col-span-8 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <section class="glass-card bg-white rounded-xl p-6 shadow-sm border border-outline-variant flex flex-col justify-between">
                        <div>
                            <h3 class="font-label-md text-primary font-bold mb-4">Metode Pembayaran</h3>
                            <div class="flex items-center gap-4 p-4 border border-gray-100 rounded-lg bg-gray-50/50">
                                <div class="bg-white p-2 rounded shadow-sm border border-gray-100">
                                    <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">{{ $transaksi->metode_pembayaran }}</p>
                                    <p class="text-xs text-gray-400">Sistem Kasir</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4 p-4 
                            @if($transaksi->status_pembayaran == 'Lunas') 
                                bg-green-50 border border-green-100 text-green-700 
                            @elseif($transaksi->status_pembayaran == 'Belum Lunas') 
                                bg-yellow-50 border border-yellow-100 text-yellow-700 
                            @else 
                                bg-red-50 border border-red-100 text-red-700 
                            @endif rounded-lg">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">verified_user</span>
                                <span class="text-xs font-bold uppercase tracking-wider">Status: {{ $transaksi->status_pembayaran }}</span>
                            </div>
                            <p class="text-[10px] opacity-80 mt-1">Tercatat secara otomatis pada sistem keuangan.</p>
                        </div>
                    </section>

                    <section class="bg-primary text-white rounded-xl p-8 shadow-xl relative overflow-hidden flex flex-col justify-center min-h-[220px]">
                        <div class="absolute -bottom-6 -right-6 opacity-10">
                            <span class="material-symbols-outlined text-[160px] select-none">payments</span>
                        </div>
                        <div class="relative z-10 space-y-4">
                            <div class="flex justify-between items-center text-white/70 text-sm">
                                <span>Keterangan Biaya</span>
                                <span class="px-2 py-0.5 bg-white/20 rounded text-xs text-white">Final</span>
                            </div>
                            <div class="h-px bg-white/20 w-full"></div>
                            <div class="flex justify-between items-end pt-2">
                                <span class="font-medium opacity-90 text-sm">Total Akhir Biaya</span>
                                <div class="text-right">
                                    <p class="text-3xl font-black tracking-tight text-white">Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <section class="glass-card bg-white rounded-xl p-6 shadow-sm border border-outline-variant">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="material-symbols-outlined text-gray-400">description</span>
                        <h3 class="font-label-md text-primary font-bold">Catatan Internal</h3>
                    </div>
                    <p class="text-gray-500 italic bg-gray-50 p-4 rounded-lg text-sm">
                        "Pastikan lembar invoice ini dicetak dan diserahkan kepada pelanggan saat penyerahan unit kendaraan beserta bukti pembayaran lunas."
                    </p>
                </section>
            </div>
        </div>
    </div>
</main>
@endsection