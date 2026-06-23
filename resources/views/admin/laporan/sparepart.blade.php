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
                <div class="bg-slate-800 text-white p-3 rounded-xl shadow-md print:hidden">
                    <span class="material-symbols-outlined text-3xl block">inventory_2</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Laporan Inventaris Gudang Sparepart
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        Pemantauan sisa kuantitas stok suku cadang gudang, nominal aset, dan indikator kritis restock.
                    </p>
                </div>
            </div>
            <button onclick="window.print()" class="no-print flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-150">
                <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                Export / Print PDF
            </button>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden print:border-0 print:shadow-none">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-700 text-slate-100 print:bg-slate-100 print:text-black">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-12">NO</th>
                            <th class="px-6 py-4 font-semibold">NAMA KOMPONEN / SUKU CADANG</th>
                            <th class="px-6 py-4 font-semibold text-center w-40">SISA VOLUME STOK</th>
                            <th class="px-6 py-4 font-semibold">HARGA JUAL SATUAN</th>
                            <th class="px-6 py-4 font-semibold text-center w-48">STATUS LOGISTIK GUDANG</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors print:hover:bg-transparent">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="font-semibold px-2 py-1 rounded {{ $item->stok <= 5 ? 'text-rose-600 bg-rose-50 font-bold' : 'text-slate-700' }}">
                                    {{ $item->stok }} Unit
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($item->stok > 5)
                                <span class="bg-green-50 text-green-700 border border-green-200 px-3 py-1 rounded-md text-xs font-semibold inline-block">Aman / Tersedia</span>
                                @elseif($item->stok > 0)
                                <span class="bg-amber-50 text-amber-700 border border-amber-200 px-3 py-1 rounded-md text-xs font-semibold inline-block">Stok Menipis</span>
                                @else
                                <span class="bg-red-50 text-red-700 border border-red-200 px-3 py-1 rounded-md text-xs font-bold inline-block">Habis / Kosong</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl block mb-2 opacity-40">inventory_2</span>
                                Data gudang kosong. Belum ada item suku cadang terarsip.
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
        .no-print, sidebar, nav, header, .ml-64, .bg-slate-800 { display: none !important; }
        main { margin-left: 0 !important; padding: 0 !important; background: white !important; }
        table { border: 1px solid #cbd5e1 !important; }
    }
</style>
@endsection