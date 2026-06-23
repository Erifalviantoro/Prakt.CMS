@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col bg-slate-50/50">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4">
                <div class="bg-slate-800 text-white p-3 rounded-2xl shadow-md">
                    <span class="material-symbols-outlined text-3xl block">analytics</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                        Pusat Laporan & Analisis
                    </h1>
                    <p class="text-sm text-slate-500 mt-1">
                        Pilih jenis data di bawah ini untuk melihat rekapitulasi, statistik, dan cetak dokumen berkala.
                    </p>
                </div>
            </div>
            
            <div class="text-right text-xs text-slate-400 font-medium">
                <span class="flex items-center gap-1.5 justify-end bg-white border border-slate-200 px-3 py-1.5 rounded-xl shadow-sm text-slate-600">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Sistem Pemantauan Aktif
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <a href="{{ route('admin.laporan.booking') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-blue-50 text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">event_note</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Berkala</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-blue-600 transition-colors">Laporan Booking</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Rekapitulasi reservasi antrean servis, status kedatangan, dan histori keluhan pelanggan.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-blue-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.pelanggan') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-emerald-50 text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">group</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Biodata</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-emerald-600 transition-colors">Laporan Pelanggan</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Daftar member aktif, total kunjungan konsumen, serta riwayat interaksi pelanggan.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-emerald-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.kendaraan') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-amber-50 text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">motorcycle</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Aset</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-amber-600 transition-colors">Laporan Kendaraan</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Data sebaran tipe kendaraan, nomor plat teregistrasi, dan rekam riwayat servis unit.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-amber-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.layanan') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">design_services</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Produk</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-indigo-600 transition-colors">Laporan Layanan</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Statistik jenis jasa servis paling diminati dan performa katalog paket penanganan.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-indigo-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.mekanik') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-teal-50 text-teal-600 group-hover:bg-teal-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">engineering</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">SDM</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-teal-600 transition-colors">Laporan Mekanik</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Produktivitas montir, pembagian beban kerja, serta performa penyelesaian tugas.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-teal-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.detail_servis') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-cyan-50 text-cyan-600 group-hover:bg-cyan-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">assignment</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Log</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-cyan-600 transition-colors">Laporan Detail Servis</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Catatan teknis mendalam per pengerjaan unit, durasi bongkar, dan penanggung jawab.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-cyan-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.sparepart') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-orange-50 text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">inventory_2</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Stok</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-orange-600 transition-colors">Laporan Sparepart</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Arsip ketersediaan suku cadang, batas minimum stok gudang, dan nilai inventaris barang.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-orange-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.penggunaan_sparepart') }}" class="group bg-white p-6 rounded-2xl border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-purple-50 text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">build_circle</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-slate-100 text-slate-600 rounded-md">Logistik</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-purple-600 transition-colors">Laporan Penggunaan Sparepart</h3>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">Audit pengeluaran komponen terpasang pada mesin pelanggan untuk memantau penyusutan.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-slate-300 group-hover:text-purple-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

            <a href="{{ route('admin.laporan.transaksi') }}" class="group bg-rose-50/20 p-6 rounded-2xl border border-rose-200/60 shadow-sm hover:shadow-md hover:border-rose-300 transition-all duration-200 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 rounded-xl bg-rose-100 text-rose-600 group-hover:bg-rose-600 group-hover:text-white transition-all duration-200">
                            <span class="material-symbols-outlined text-2xl block">payments</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-1 bg-rose-200 text-rose-700 rounded-md">Finansial</span>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg group-hover:text-rose-600 transition-colors">Laporan Transaksi</h3>
                    <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Omzet pendapatan kotor, rekap kas masuk, pembayaran lunas, dan status piutang bengkel.</p>
                </div>
                <div class="flex items-center justify-end mt-6 text-rose-300 group-hover:text-rose-600 transition-colors">
                    <span class="material-symbols-outlined text-xl transform group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </div>
            </a>

        </div>

    </div>
</main>
@endsection