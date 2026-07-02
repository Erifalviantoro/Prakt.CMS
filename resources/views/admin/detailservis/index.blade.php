@extends('admin.layout.layout')
@php
use Illuminate\Support\Str;
@endphp

@section('content')

<main class="pl-64 min-h-screen bg-slate-50/50">
    @include('admin.layout.header')
    
    <div class="p-8 max-w-7xl mx-auto">
        
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 shadow-sm">
            <span class="material-symbols-outlined text-green-600">check_circle</span>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
        @endif
        
        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="flex items-center gap-2 text-slate-500 mb-2">
                    <a class="text-xs hover:text-slate-800 transition-colors" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-xs text-slate-800 font-bold">Kelola Servis</span>
                </nav>
                <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Kelola Workshop Servis</h2>
                <p class="text-sm text-slate-500 mt-0.5">Pantau antrian, alokasi sparepart mekanik, hingga penerbitan invoice kasir.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 border border-slate-200 rounded-xl flex items-center gap-4 shadow-sm">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                    <span class="material-symbols-outlined block text-2xl">pending_actions</span>
                </div>
                <div>
                    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Antrian</p>
                    <h4 class="text-2xl font-black text-slate-800">{{ $pending }}</h4>
                </div>
            </div>
            <div class="bg-white p-5 border border-slate-200 rounded-xl flex items-center gap-4 shadow-sm">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <span class="material-symbols-outlined block text-2xl">sync</span>
                </div>
                <div>
                    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Sedang Dikerjakan</p>
                    <h4 class="text-2xl font-black text-slate-800">{{ $progress }}</h4>
                </div>
            </div>
            <div class="bg-white p-5 border border-slate-200 rounded-xl flex items-center gap-4 shadow-sm">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <span class="material-symbols-outlined block text-2xl">check_circle</span>
                </div>
                <div>
                    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Selesai</p>
                    <h4 class="text-2xl font-black text-slate-800">{{ $completed }}</h4>
                </div>
            </div>
            <div class="bg-white p-5 border border-slate-200 rounded-xl flex items-center gap-4 shadow-sm">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                    <span class="material-symbols-outlined block text-2xl">request_quote</span>
                </div>
                <div>
                    <p class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">Invoice Terbit</p>
                    <h4 class="text-2xl font-black text-slate-800">{{ $invoiceCount ?? $detailServis->where('transaksi', '!=', null)->count() }}</h4>
                </div>
            </div>
        </div>

        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[1100px]">
                    <thead>
                        <tr class="bg-slate-800 text-slate-100 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold w-28">Booking ID</th>
                            <th class="px-6 py-4 font-semibold">Pelanggan</th>
                            <th class="px-6 py-4 font-semibold">Kendaraan</th>
                            <th class="px-6 py-4 font-semibold">Teknisi</th>
                            <th class="px-6 py-4 font-semibold text-right">Biaya Jasa</th>
                            <th class="px-6 py-4 font-semibold text-center w-28">Status</th>
                            <th class="px-6 py-4 font-semibold text-center w-28">Invoice</th>
                            <th class="px-6 py-4 font-semibold text-right w-80">Aksi Selanjutnya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                        @forelse($detailServis as $item)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4 font-mono font-bold text-slate-800">
                                BK-{{ str_pad($item->booking_id, 4, '0', STR_PAD_LEFT) }}
                            </td>
                            
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $item->booking->pelanggan->nama ?? 'Tanpa Nama' }}
                            </td>
                            
                            <td class="px-6 py-4 text-slate-500">
                                <span class="font-medium text-slate-700">{{ $item->booking->kendaraan->merk_kendaraan ?? '-' }}</span>
                                <span class="text-xs block text-slate-400 font-mono mt-0.5">{{ $item->booking->kendaraan->nomor_plat ?? '' }}</span>
                            </td>
                            
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ $item->teknisi->nama ?? 'Belum Ditunjuk' }}
                            </td>

                            <td class="px-6 py-4 text-right font-bold text-slate-800">
                                Rp {{ number_format($item->biaya_jasa ?? 0, 0, ',', '.') }}
                            </td>
                            
                            <td class="px-6 py-4 text-center">
                                @if($item->status_servis == 'selesai')
                                    <span class="inline-block w-20 text-center px-2 py-1 bg-green-50 text-green-700 border border-green-200 rounded-md text-[11px] font-extrabold uppercase">
                                        Selesai
                                    </span>
                                @elseif($item->status_servis == 'proses')
                                    <span class="inline-block w-20 text-center px-2 py-1 bg-blue-50 text-blue-700 border border-blue-200 rounded-md text-[11px] font-extrabold uppercase animate-pulse">
                                        Proses
                                    </span>
                                @else
                                    <span class="inline-block w-20 text-center px-2 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-md text-[11px] font-extrabold uppercase">
                                        Antrian
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($item->transaksi)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-200 rounded-full text-xs font-bold">
                                        <span class="w-1.5 h-1.5 bg-purple-600 rounded-full"></span> Sudah
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-400 border border-slate-200 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-slate-300 rounded-full"></span> Belum
                                    </span>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.detailservis.show', $item->id) }}" 
                                       class="inline-flex items-center gap-1 bg-slate-100 hover:bg-slate-200 text-slate-700 px-3 py-1.5 text-xs font-bold rounded-lg transition-colors border border-slate-200 shadow-sm"
                                       title="Lihat Detail Log Pengerjaan">
                                        <span class="material-symbols-outlined text-[16px]">visibility</span>
                                        Detail
                                    </a>

                                    @if($item->status_servis == 'selesai')
                                        <a href="{{ route('admin.penggunaan-sparepart.create', ['detail_servis_id' => $item->id]) }}" 
                                           class="inline-flex items-center gap-1 bg-teal-600 hover:bg-teal-700 text-white px-3 py-1.5 text-xs font-bold rounded-lg transition-colors shadow-sm"
                                           title="Input Komponen & Suku Cadang">
                                            <span class="material-symbols-outlined text-[16px]">handyman</span>
                                            Sparepart
                                        </a>
                                    @endif

                                    @if($item->transaksi)
                                        <a href="{{ route('admin.transaksi.show', $item->transaksi->id) }}" 
                                           class="inline-flex items-center gap-1 bg-purple-600 hover:bg-purple-700 text-white px-3 py-1.5 text-xs font-bold rounded-lg transition-colors shadow-sm"
                                           title="Buka Nota Tagihan">
                                            <span class="material-symbols-outlined text-[16px]">receipt_long</span>
                                            Invoice
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-16 text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-40">engineering</span>
                                Tidak ada data pengerjaan servis aktif dalam database workshop saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-6 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-4 bg-slate-50/50">
                <p class="text-slate-500 text-xs">Menampilkan lembar daftar antrian kendaraan terikat sistem.</p>
                <div>
                    {{ $detailServis->links() }}
                </div>
            </div>
        </div>

    </div>
</main>

@endsection