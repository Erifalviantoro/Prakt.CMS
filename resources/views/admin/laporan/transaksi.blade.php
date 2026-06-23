@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col bg-slate-50/50">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 border-b border-gray-200 pb-5">
            <div class="flex items-start gap-4">
                <a href="{{ route('admin.laporan.index') }}" class="no-print flex items-center justify-center bg-white hover:bg-slate-100 text-slate-600 border border-slate-200 p-3 rounded-xl shadow-sm transition-all duration-150 group" title="Kembali ke Pusat Laporan">
                    <span class="material-symbols-outlined text-xl transform group-hover:-translate-x-1 transition-transform">arrow_back</span>
                </a>
                <div class="bg-rose-700 text-white p-3 rounded-xl shadow-md print:hidden">
                    <span class="material-symbols-outlined text-3xl block">payments</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Laporan Finansial Kas Masuk
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        Dokumen rekapitulasi omzet, metode pembayaran invoice, dan pemantauan piutang.
                    </p>
                </div>
            </div>
            <button onclick="window.print()" class="no-print flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-150">
                <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                Export / Print PDF
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 no-print">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-green-600 font-bold uppercase tracking-wider">Total Pendapatan Bersih</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{-- FIX: Mengubah filter string pencarian status menjadi 'lunas' huruf kecil --}}
                            Rp {{ number_format($data->where('status_pembayaran', 'lunas')->sum('total_biaya'), 0, ',', '.') }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-green-600 bg-green-50 p-2 rounded-lg">
                        account_balance_wallet
                    </span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-red-600 font-bold uppercase tracking-wider">Total Transaksi Belum Lunas</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{-- FIX: Mengubah filter string pencarian status agar mengecek 'lunas' huruf kecil --}}
                            Rp {{ number_format($data->where('status_pembayaran', '!=', 'lunas')->sum('total_biaya'), 0, ',', '.') }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-red-600 bg-red-50 p-2 rounded-lg">
                        money_off
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden print:border-0 print:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-700 text-slate-100 print:bg-slate-100 print:text-black">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-12">NO</th>
                            <th class="px-6 py-4 font-semibold">TANGGAL SERVIS</th>
                            <th class="px-6 py-4 font-semibold">ENTITAS PELANGGAN</th>
                            <th class="px-6 py-4 font-semibold text-center">METODE BAYAR</th>
                            <th class="px-6 py-4 font-semibold text-center w-40">STATUS INVOICE</th>
                            <th class="px-6 py-4 font-semibold text-right">TOTAL PENDAPATAN</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors print:hover:bg-transparent">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_servis)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{-- FIX: Menggunakan jalur relasi berantai aman melalui detailServis dan booking --}}
                                <div class="font-bold text-slate-800">{{ $item->detailServis?->booking?->pelanggan?->nama ?? 'Tidak Ditemukan' }}</div>
                                <div class="text-xs text-slate-400 font-mono mt-0.5">{{ $item->detailServis?->booking?->kendaraan?->nomor_plat ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-center text-xs font-bold uppercase text-slate-500">
                                <span class="bg-slate-100 px-2 py-1 rounded border border-slate-200">
                                    {{ $item->metode_pembayaran }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{-- FIX: Pengecekan visual menggunakan value 'lunas' huruf kecil, namun teks tampil tetap kapital --}}
                                <span class="px-2.5 py-1 rounded-md text-xs font-bold inline-block border {{ $item->status_pembayaran == 'lunas' ? 'bg-green-50 text-green-700 border-green-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                    {{ $item->status_pembayaran == 'lunas' ? 'Lunas' : ($item->status_pembayaran == 'belum_lunas' ? 'Belum Lunas' : 'Gagal') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-extrabold text-slate-800 text-right">
                                Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl block mb-2 opacity-40">payments</span>
                                Belum ada data transaksi kas keuangan masuk yang tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<style>
    @media print {
        .no-print, sidebar, nav, header, .ml-64, .bg-slate-800, .bg-rose-700 { display: none !important; }
        main { margin-left: 0 !important; padding: 0 !important; background: white !important; }
        table { border: 1px solid #cbd5e1 !important; }
    }
</style>
@endsection