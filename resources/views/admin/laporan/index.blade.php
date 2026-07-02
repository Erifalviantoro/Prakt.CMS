@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col bg-slate-50/50">
    
    <div class="print:hidden">
        @include('admin.layout.header')
    </div>

    <div class="flex-1 p-margin-desktop print:p-0 print:bg-white">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-6 print:mb-6 print:pb-4">
            <div>
                <button onclick="window.location.href='{{ route('admin.laporan.index') }}'" class="print:hidden flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors mb-3">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Pusat Laporan
                </button>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight print:text-xl">Laporan Transaksi Finansial</h1>
                <p class="text-sm text-slate-500 mt-1 print:text-xs">
                    @if(request('tanggal_awal') && request('tanggal_akhir'))
                        Periode Penjualan: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}</span> s/d <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}</span>
                    @else
                        Menampilkan seluruh riwayat akumulasi kas masuk dan piutang berjalan.
                    @endif
                </p>
            </div>
            
            <div class="print:hidden">
                <button onclick="window.print()" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md transition-all duration-150">
                    <span class="material-symbols-outlined text-lg">print</span> Cetak Dokumen
                </button>
            </div>
        </div>

        <div class="print:hidden bg-white p-5 rounded-2xl border border-slate-200 shadow-sm mb-8">
            <form method="GET" action="{{ route('admin.laporan.transaksi') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:border-slate-400 transition-colors">
                </div>
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:border-slate-400 transition-colors">
                </div>
                <div class="flex gap-2 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none justify-center flex items-center gap-2 bg-rose-600 hover:bg-rose-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold transition-colors">
                        <span class="material-symbols-outlined text-lg">filter_alt</span> Filter
                    </button>
                    @if(request('tanggal_awal') || request('tanggal_akhir'))
                        <a href="{{ route('admin.laporan.transaksi') }}" class="justify-center flex items-center bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2.5 rounded-xl text-sm font-semibold transition-colors" title="Reset Filter">
                            <span class="material-symbols-outlined text-lg">restart_alt</span>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8 print:grid-cols-4 print:gap-2 print:mb-6">
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm print:shadow-none print:p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 print:text-[9px]">Total Pendapatan (Lunas)</p>
                <p class="text-xl lg:text-2xl font-black text-emerald-600 mt-2 print:text-base">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm print:shadow-none print:p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 print:text-[9px]">Volume Transaksi</p>
                <p class="text-xl lg:text-2xl font-black text-slate-800 mt-2 print:text-base">{{ $totalTransaksi }} Rekord</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm print:shadow-none print:p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 print:text-[9px]">Pembayaran Selesai</p>
                <p class="text-xl lg:text-2xl font-black text-blue-600 mt-2 print:text-base">{{ $totalLunas }} Transaksi</p>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm print:shadow-none print:p-4">
                <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 print:text-[9px]">Tagihan Tertunda</p>
                <p class="text-xl lg:text-2xl font-black text-amber-600 mt-2 print:text-base">{{ $totalBelumLunas }} Invoice</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden print:border-none print:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200 text-slate-400 text-[10px] font-bold uppercase tracking-wider print:bg-slate-100">
                            <th class="px-6 py-4 print:px-2 print:py-2">No. Invoice</th>
                            <th class="px-6 py-4 print:px-2 print:py-2">Pelanggan / Unit</th>
                            <th class="px-6 py-4 print:px-2 print:py-2">Tanggal Transaksi</th>
                            <th class="px-6 py-4 print:px-2 print:py-2">Status</th>
                            <th class="px-6 py-4 text-right print:px-2 print:py-2">Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                        @forelse($data as $item)
                            <tr class="hover:bg-slate-50/50 transition-colors print:hover:bg-transparent">
                                <td class="px-6 py-4 font-semibold text-slate-800 print:px-2 print:py-2 print:text-xs">
                                    {{ $item->kode_transaksi ?? 'TRX-'.$item->id }}
                                </td>
                                <td class="px-6 py-4 print:px-2 print:py-2 print:text-xs">
                                    <div class="font-medium text-slate-700">
                                        {{ $item->detailServis->booking->pelanggan->nama ?? 'Umum/Walk-In' }}
                                    </div>
                                    <div class="text-xs text-slate-400">
                                        {{ $item->detailServis->booking->kendaraan->nomor_plat ?? '-' }} - {{ $item->detailServis->booking->kendaraan->merek_model ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-500 print:px-2 print:py-2 print:text-xs">
                                    {{ $item->created_at->translatedFormat('d M Y, H:i') }} WIB
                                </td>
                                <td class="px-6 py-4 print:px-2 print:py-2 print:text-xs">
                                    @if($item->status_pembayaran == 'Lunas')
                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200/60 print:bg-transparent print:text-emerald-700 print:border-none print:p-0">Lunas</span>
                                    @elseif($item->status_pembayaran == 'Belum Lunas' || $item->status_pembayaran == 'Menunggu Pembayaran')
                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-50 text-amber-700 border border-amber-200/60 print:bg-transparent print:text-amber-700 print:border-none print:p-0">Pending</span>
                                    @else
                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-rose-50 text-rose-700 border border-rose-200/60 print:bg-transparent print:text-rose-700 print:border-none print:p-0">{{ $item->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right font-bold text-slate-800 print:px-2 print:py-2 print:text-xs">
                                    Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400 font-medium">
                                    <span class="material-symbols-outlined text-4xl block mb-2 opacity-40">find_in_page</span>
                                    Tidak menemukan data transaksi pada parameter atau periode tersebut.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="hidden print:block mt-16">
            <div class="flex justify-between text-xs text-slate-600">
                <div>
                    <p>Sistem Manajemen Bengkel - Sumber Baru Motor</p>
                    <p class="text-[10px] text-slate-400 mt-1">Dicetak otomatis oleh Admin pada {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                <div class="text-center w-48">
                    <p>Yogyakarta, {{ now()->translatedFormat('d F Y') }}</p>
                    <p class="mt-16 font-bold text-slate-800 border-b border-slate-400 pb-1">Kepala Bengkel / Admin</p>
                </div>
            </div>
        </div>

    </div>
</main>

<style>
    @media print {
        body {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        /* Sembunyikan sidebar utama bawaan layout */
        aside, nav, header, .sidebar, [class*="sidebar"] {
            display: none !important;
        }
        /* Tarik main layout ke kiri penuh karena sidebar hilang */
        main {
            margin-left: 0 !important;
            padding: 0 !important;
            background: transparent !important;
        }
    }
</style>
@endsection