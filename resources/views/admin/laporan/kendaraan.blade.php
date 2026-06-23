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
                    <span class="material-symbols-outlined text-3xl block">directions_car</span>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Laporan Registrasi Kendaraan
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        Arsip identitas kendaraan konsumen, nomor plat, dan spesifikasi mesin.
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
                            <th class="px-6 py-4 font-semibold">NOMOR PLAT</th>
                            <th class="px-6 py-4 font-semibold">MERK KENDARAAN</th>
                            <th class="px-6 py-4 font-semibold">MODEL UNIT</th>
                            <th class="px-6 py-4 font-semibold">NOMOR MESIN</th>
                            <th class="px-6 py-4 font-semibold text-center w-32">TAHUN BUAT</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors print:hover:bg-transparent">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-mono font-bold text-slate-800 bg-slate-100 border border-slate-200 px-2.5 py-1 rounded-md text-sm">
                                    {{ $item->nomor_plat }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $item->merk_kendaraan }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->model_kendaraan }}
                            </td>
                            <td class="px-6 py-4 font-mono text-xs tracking-wider">
                                {{ $item->nomor_mesin }}
                            </td>
                            <td class="px-6 py-4 text-center font-medium text-slate-700">
                                {{ $item->tahun_pembuatan }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl block mb-2 opacity-40">folder_open</span>
                                Belum ada riwayat berkas kendaraan yang terekam.
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