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
                    <span class="material-symbols-outlined text-3xl block">analytics</span>
                </div>
                
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Dokumen Rekapitulasi Booking
                    </h2>
                    <p class="text-sm text-slate-500 mt-1 flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs">info</span>
                        Modul khusus pelaporan berkala aktivitas bengkel (Read-Only)
                    </p>
                </div>
            </div>
            
            <button onclick="window.print()" class="no-print flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-medium shadow-sm transition-all duration-150">
                <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                Export / Print PDF
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Record</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $data->count() }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-slate-400 bg-slate-100 p-2 rounded-lg">
                        description
                    </span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-amber-600 font-bold uppercase tracking-wider">Antrean Menunggu</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $data->where('status', 'Menunggu')->count() }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-amber-500 bg-amber-50 p-2 rounded-lg">
                        hourglass_empty
                    </span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-blue-600 font-bold uppercase tracking-wider">Disetujui Admin</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $data->where('status', 'Dikonfirmasi')->count() }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-blue-500 bg-blue-50 p-2 rounded-lg">
                        verified
                    </span>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-green-600 font-bold uppercase tracking-wider">Selesai Servis</p>
                        <h3 class="text-3xl font-extrabold text-slate-800 mt-1">
                            {{ $data->where('status', 'Selesai')->count() }}
                        </h3>
                    </div>
                    <span class="material-symbols-outlined text-2xl text-green-500 bg-green-50 p-2 rounded-lg">
                        trending_up
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
                            <th class="px-6 py-4 font-semibold">DOKUMEN ID</th>
                            <th class="px-6 py-4 font-semibold">NAMA PELANGGAN</th>
                            <th class="px-6 py-4 font-semibold">IDENTITAS KENDARAAN</th>
                            <th class="px-6 py-4 font-semibold">JADWAL BOOKING</th>
                            <th class="px-6 py-4 font-semibold text-center w-40">STATUS AKHIR</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse ($data as $index => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors print:hover:bg-transparent">
                            <td class="px-6 py-4 text-center font-medium text-slate-400">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-slate-400 text-lg print:hidden">draft</span>
                                    <span class="font-mono font-bold text-slate-800">
                                        BKG-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-800">
                                {{ $item->pelanggan->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="font-semibold text-slate-700 block">{{ $item->kendaraan->nomor_plat ?? '-' }}</span>
                                <span class="text-xs text-slate-400">{{ $item->kendaraan->merk_kendaraan ?? '-' }}</span>
                            </td>
                            <td class="px-6 py-4 font-medium text-slate-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_booking)->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php
                                $warna = match($item->status) {
                                    'Menunggu' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    'Dikonfirmasi' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'Diproses' => 'bg-purple-50 text-purple-700 border-purple-200',
                                    'Selesai' => 'bg-green-50 text-green-700 border-green-200',
                                    'Dibatalkan' => 'bg-red-50 text-red-700 border-red-200',
                                    default => 'bg-slate-50 text-slate-700 border-slate-200'
                                };
                                @endphp
                                <span class="px-3 py-1 rounded-md text-xs font-semibold inline-block border {{ $warna }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                                <span class="material-symbols-outlined text-5xl block mb-2 opacity-40">folder_open</span>
                                Belum ada riwayat berkas transaksi laporan yang terekam.
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
        .no-print, sidebar, nav, header, .ml-64, .bg-slate-800 {
            display: none !important;
        }
        main {
            margin-left: 0 !important;
            padding: 0 !important;
            background: white !important;
        }
        table {
            border: 1px solid #cbd5e1 !important;
        }
    }
</style>
@endsection