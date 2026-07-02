@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col bg-slate-50/50">

    <div class="no-print">
        @include('admin.layout.header')
    </div>

    <div class="flex-1 p-margin-desktop print:p-0 print:bg-white">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-gray-200 pb-5">
            <div class="flex items-start gap-4">
                <a href="{{ route('admin.laporan.index') }}" class="no-print flex items-center justify-center bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 p-3 rounded-xl shadow-sm transition-all duration-150 group" title="Kembali ke Pusat Laporan">
                    <span class="material-symbols-outlined text-xl transform group-hover:-translate-x-1 transition-transform">arrow_back</span>
                </a>
                <div class="bg-rose-700 text-white p-3 rounded-xl shadow-md print:hidden">
                    <span class="material-symbols-outlined text-3xl block">payments</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Laporan Finansial Kas Masuk</h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        @if(request('tanggal_awal') && request('tanggal_akhir'))
                            Periode Transaksi: <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse(request('tanggal_awal'))->translatedFormat('d F Y') }}</span> s/d <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse(request('tanggal_akhir'))->translatedFormat('d F Y') }}</span>
                        @else
                            Dokumen rekapitulasi omzet, metode pembayaran invoice, dan pemantauan piutang berjalan.
                        @endif
                    </p>
                </div>
            </div>
            
            <button onclick="window.print()" class="no-print flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-150">
                <span class="material-symbols-outlined text-sm">print</span>
                Cetak Laporan / PDF
            </button>
        </div>

        <div class="no-print bg-white p-5 rounded-xl border border-slate-200 shadow-sm mb-8">
            <form method="GET" action="{{ route('admin.laporan.transaksi') }}" class="flex flex-col md:flex-row items-end gap-4">
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Tanggal Awal</label>
                    <input type="date" name="tanggal_awal" value="{{ request('tanggal_awal') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:border-slate-400 transition-colors">
                </div>
                <div class="flex-1 w-full">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:border-slate-400 transition-colors">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm print:border-slate-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-green-600 font-bold uppercase tracking-wider">Total Pendapatan Bersih (Lunas)</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            Rp {{ number_format($data->where('status_pembayaran', 'Lunas')->sum('total_biaya'), 0, ',', '.') }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-green-600 bg-green-50 p-2 rounded-lg print:hidden">
                        account_balance_wallet
                    </span>
                </div>
            </div>
            
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm print:border-slate-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-red-600 font-bold uppercase tracking-wider">Total Piutang & Tagihan Tertunda</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            Rp {{ number_format($data->whereIn('status_pembayaran', ['Belum Lunas', 'Menunggu Pembayaran', 'Gagal'])->sum('total_biaya'), 0, ',', '.') }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-red-600 bg-red-50 p-2 rounded-lg print:hidden">
                        money_off
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden print:border-0 print:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-700 text-slate-100 print:bg-slate-100 print:text-black print:border-b-2 print:border-slate-300">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-12">NO</th>
                            <th class="px-6 py-4 font-semibold">TANGGAL TRANSAKSI</th>
                            <th class="px-6 py-4 font-semibold">ENTITAS PELANGGAN</th>
                            <th class="px-6 py-4 font-semibold text-center">METODE BAYAR</th>
                            <th class="px-6 py-4 font-semibold text-center w-44">STATUS INVOICE</th>
                            <th class="px-6 py-4 font-semibold text-right">TOTAL PENDAPATAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600 print:divide-y-2 print:divide-slate-200">
                        @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors print:hover:bg-transparent">
                            <td class="px-6 py-4 text-center font-medium text-slate-400 print:text-xs">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700 print:text-xs">
                                {{ $item->created_at->translatedFormat('d F Y, H:i') }} WIB
                            </td>
                            <td class="px-6 py-4 print:text-xs">
                                <div class="font-bold text-slate-800">{{ $item->detailServis?->booking?->pelanggan?->nama ?? 'Umum / Walk-In' }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $item->detailServis?->booking?->kendaraan?->nomor_plat ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500 print:text-xs">
                                <span class="bg-slate-100 px-2 py-1 rounded border border-slate-200 print:border-none print:bg-transparent print:p-0">
                                    {{ $item->metode_pembayaran ?? 'Tunai' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center print:text-xs">
                                @if($item->status_pembayaran == 'Lunas')
                                    <span class="px-2.5 py-1 rounded-md text-xs font-bold inline-block border bg-green-50 text-green-700 border-green-200 print:bg-transparent print:border-none print:text-green-700 print:p-0">
                                        Lunas
                                    </span>
                                @elseif($item->status_pembayaran == 'Belum Lunas')
                                    <span class="px-2.5 py-1 rounded-md text-xs font-bold inline-block border bg-yellow-50 text-yellow-700 border-yellow-200 print:bg-transparent print:border-none print:text-yellow-700 print:p-0">
                                        Belum Lunas
                                    </span>
                                @elseif($item->status_pembayaran == 'Menunggu Pembayaran')
                                    <span class="px-2.5 py-1 rounded-md text-xs font-bold inline-block border bg-blue-50 text-blue-700 border-blue-200 print:bg-transparent print:border-none print:text-blue-700 print:p-0">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-md text-xs font-bold inline-block border bg-red-50 text-red-700 border-red-200 print:bg-transparent print:border-none print:text-red-700 print:p-0">
                                        Gagal
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-extrabold text-slate-800 text-right print:text-xs">
                                Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl block mb-2 opacity-40">payments</span>
                                Tidak ditemukan rekaman data transaksi kas untuk kriteria filter periode ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="hidden print:block mt-16 text-xs text-slate-600">
            <div class="flex justify-between items-end">
                <div>
                    <p class="font-medium">Sumber Baru Motor - Repair Management System</p>
                    <p class="text-[10px] text-slate-400 mt-1">Berkas digenerate secara resmi pada {{ now()->translatedFormat('d F Y, H:i') }} WIB</p>
                </div>
                <div class="text-center w-52 border-t border-transparent">
                    <p class="mb-16 text-slate-700">Yogyakarta, {{ now()->translatedFormat('d F Y') }}</p>
                    <p class="font-bold text-slate-900 border-b border-slate-400 pb-1 mx-2">Administrasi Bengkel</p>
                </div>
            </div>
        </div>

    </div>
</main>

<style>
    @media print {
        /* Sembunyikan seluruh komponen navigasi, tombol, header layout, dan background ikon */
        .no-print, sidebar, nav, header, .ml-64, .bg-slate-800, .bg-rose-700, .material-symbols-outlined { 
            display: none !important; 
        }
        /* Kembalikan margin content area ke titik nol halaman */
        main { 
            margin-left: 0 !important; 
            padding: 0 !important; 
            background: white !important; 
        }
        /* Penegasan border tabel agar terlihat jelas di media kertas cetak */
        table { 
            border: 1px solid #cbd5e1 !important; 
        }
    }
</style>
@endsection