@extends('admin.layout.layout')

@section('content')
<main class="pl-64 min-h-screen">
    @include('admin.layout.header')
    
    <div class="p-gutter max-w-container-max-width mx-auto space-y-8">
        
        <div>
            <nav class="flex items-center gap-2 mb-4 text-on-surface-variant font-label-md text-label-md">
                <a class="hover:text-primary transition-colors" href="#">Dashboard</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a class="hover:text-primary transition-colors" href="{{ route('admin.kendaraan.index') }}">Manajemen Kendaraan</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-bold">Tambah Kendaraan</span>
            </nav>
            
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.kendaraan.index') }}" class="material-symbols-outlined text-on-surface-variant cursor-pointer active:scale-95 flex items-center justify-center p-2 rounded-full hover:bg-surface-container-low transition-colors">arrow_back</a>
                <h2 class="font-headline-md text-headline-md font-Montserrat font-bold text-primary">Detail Kendaraan</h2>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-8 bg-white border border-outline-variant rounded-xl overflow-hidden shadow-sm flex flex-col md:flex-row">
                <div class="md:w-1/2 relative bg-surface-container-highest group h-64 md:h-auto overflow-hidden">
                    <img alt="{{ $kendaraan->merk_kendaraan }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCw7ysS8_K-L5187fKQ0KdVMlYukK14P-9DbmGbPSaMR_Ald7vIF5r0FrKb-a_HX4rCtbl1qAfkVrDmhJPDalXT3-WWaE6RXiNBQTeH0Viy17KniMPBkEDYW3wquuWPpKs4CGygMlpmXb1pdQOHO72d22m733f4pMwBxpdkNmkKvm4SiKOUL_B3bBzhig8dgEgqgagDaaKdJsW9XptKOpxDKyXRdJaaryLgI2QKRRpTXiKNwmuKxIawz1llCSL5n1Z2W6Sf0gKPkyN2"/>
                    <div class="absolute top-4 left-4">
                        <span class="bg-secondary text-white px-3 py-1 rounded-full font-label-sm shadow-lg uppercase tracking-wider">Premium Service</span>
                    </div>
                </div>
                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-headline-md text-headline-md text-primary">{{ $kendaraan->merk_kendaraan }} {{ $kendaraan->model_kendaraan }}</h3>
                            <span class="bg-surface-container text-primary px-3 py-1 rounded-lg font-bold border border-outline-variant font-mono">{{ $kendaraan->nomor_plat }}</span>
                        </div>
                        <p class="text-on-surface-variant mb-6 font-body-md">Tahun Pembuatan: <strong>{{ $kendaraan->tahun_pembuatan }}</strong></p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <p class="text-xs text-outline font-bold uppercase tracking-tighter">No. Mesin</p>
                                <p class="font-label-md text-primary font-mono text-sm">{{ $kendaraan->nomor_mesin }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-xs text-outline font-bold uppercase tracking-tighter">Status Registrasi</p>
                                <p class="font-label-md text-green-700 font-bold uppercase text-xs bg-green-100 px-2 py-0.5 rounded inline-block">Terverifikasi</p>
                            </div>
                            <div class="space-y-1 mt-2">
                                <p class="text-xs text-outline font-bold uppercase tracking-tighter">Kategori</p>
                                <p class="font-label-md text-primary">Milik Perusahaan / Umum</p>
                            </div>
                            <div class="space-y-1 mt-2">
                                <p class="text-xs text-outline font-bold uppercase tracking-tighter">Bahan Bakar</p>
                                <p class="font-label-md text-primary">Standar / Rekomendasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 flex gap-3">
                        <button class="flex-1 bg-secondary text-white py-3 rounded-lg font-bold hover:brightness-110 active:scale-95 transition-all flex items-center justify-center gap-2 shadow-md shadow-secondary/20">
                            <span class="material-symbols-outlined text-lg">calendar_month</span>
                            Book Service
                        </button>
                        <a href="{{ route('admin.kendaraan.edit', $kendaraan->id) }}" class="p-3 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-all text-on-surface-variant flex items-center justify-center" title="Edit Data">
                            <span class="material-symbols-outlined">edit</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-span-12 lg:col-span-4 bg-white border border-outline-variant rounded-xl p-8 shadow-sm flex flex-col">
                <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">person</span>
                    Informasi Pemilik
                </h3>
                @if($bookingTerakhir)

                <div class="w-16 h-16 rounded-full bg-primary-container flex items-center justify-center text-white text-xl font-bold">
                    {{ strtoupper(substr($bookingTerakhir->pelanggan->nama,0,1)) }}
                </div>

                <div>
                    <p class="font-headline-md text-lg text-primary">
                        {{ $bookingTerakhir->pelanggan->nama }}
                    </p>
                    <p class="text-on-surface-variant text-sm">
                        Pelanggan Bengkel
                    </p>
                </div>

                @else

                <div>
                    <p class="font-headline-md text-lg text-primary">
                        Belum ada data pemilik
                    </p>
                </div>

                @endif
                <div class="space-y-4 flex-1">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-outline-variant">phone</span>
                        <div>
                            <p class="text-xs text-outline font-bold uppercase tracking-tighter">Nomor Telepon</p>
                            <p class="font-label-md text-primary">{{ $bookingTerakhir?->pelanggan?->nomor_telepon ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-outline-variant">mail</span>
                        <div>
                            <p class="text-xs text-outline font-bold uppercase tracking-tighter">Email</p>
                            <p class="font-label-md text-primary">{{ $bookingTerakhir?->pelanggan?->email ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-outline-variant">location_on</span>
                        <div>
                            <p class="text-xs text-outline font-bold uppercase tracking-tighter">Alamat</p>
                            <p class="font-label-md text-primary">{{ $bookingTerakhir?->pelanggan?->alamat ?? '-' }}</p>
                        </div>
                    </div>
                </div>
                <button class="mt-8 w-full py-3 rounded-lg border border-primary text-primary font-bold hover:bg-surface-container-low transition-all">
                    Hubungi Pemilik
                </button>
            </div>
        </div>
        
        <div class="bg-white border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="border-b border-outline-variant px-8 pt-6 relative">
                <div class="flex gap-10">
                    <button class="pb-4 font-label-md text-secondary font-bold relative transition-colors" id="tab-service" onclick="switchTab('service')">
                        Riwayat Servis
                        <div class="active-tab-indicator w-full" id="indicator-service"></div>
                    </button>
                    <button class="pb-4 font-label-md text-on-surface-variant opacity-60 hover:opacity-100 transition-colors relative" id="tab-transaction" onclick="switchTab('transaction')">
                        Riwayat Transaksi
                        <div class="active-tab-indicator w-0" id="indicator-transaction"></div>
                    </button>
                </div>
            </div>
            
            <div class="p-2">
                <div class="block overflow-x-auto" id="content-service">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container text-primary">
                            <tr>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Jenis Servis</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Mekanik</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">KM</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">

                        @forelse($riwayatServis as $booking)

                        <tr class="hover:bg-surface-container-low transition-colors">

                            <td class="px-6 py-4 font-label-md">
                                {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <p class="font-label-md text-primary">
                                    Booking Servis
                                </p>

                                <p class="text-xs text-on-surface-variant">
                                    {{ $booking->keluhan }}
                                </p>
                            </td>

                            <td class="px-6 py-4 font-label-md">
                                -
                            </td>

                            <td class="px-6 py-4 font-label-md">
                                -
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($booking->status == 'Selesai')
                                    bg-green-100 text-green-800
                                @elseif($booking->status == 'Diproses')
                                    bg-blue-100 text-blue-800
                                @else
                                    bg-yellow-100 text-yellow-800
                                @endif">
                                    {{ $booking->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.booking.show',$booking->id) }}"
                                class="text-secondary hover:underline font-bold text-sm">
                                    Lihat Detail
                                </a>
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Belum ada riwayat servis
                            </td>
                        </tr>

                        @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="hidden overflow-x-auto" id="content-transaction">
                    <table class="w-full text-left">
                        <thead class="bg-surface-container text-primary">
                            <tr>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">No. Invoice</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Kategori</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Total Pembayaran</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider">Metode</th>
                                <th class="px-6 py-4 font-label-sm uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-bold text-primary">INV/2023/X/102</td>
                                <td class="px-6 py-4 font-label-md">15 Okt 2023</td>
                                <td class="px-6 py-4 font-label-md">Servis</td>
                                <td class="px-6 py-4 font-bold text-primary">Rp 1.250.000</td>
                                <td class="px-6 py-4 font-label-md">QRIS - BCA</td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-secondary hover:underline font-bold text-sm flex items-center justify-end gap-1 ml-auto">
                                        <span class="material-symbols-outlined text-sm">download</span> Unduh
                                    </button>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-low transition-colors bg-surface-container-lowest">
                                <td class="px-6 py-4 font-bold text-primary">INV/2023/IX/045</td>
                                <td class="px-6 py-4 font-label-md">02 Sep 2023</td>
                                <td class="px-6 py-4 font-label-md">Suku Cadang</td>
                                <td class="px-6 py-4 font-bold text-primary">Rp 2.400.000</td>
                                <td class="px-6 py-4 font-label-md">Transfer Bank</td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-secondary hover:underline font-bold text-sm flex items-center justify-end gap-1 ml-auto">
                                        <span class="material-symbols-outlined text-sm">download</span> Unduh
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="px-8 py-4 bg-surface-container-low flex justify-between items-center border-t border-outline-variant">
                <p class="text-sm text-on-surface-variant">Menampilkan 1-10 dari 45 entri</p>
                <div class="flex gap-2">
                    <button class="p-2 rounded-lg border border-outline-variant bg-white opacity-50 cursor-not-allowed">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button class="p-2 rounded-lg border border-outline-variant bg-white hover:bg-surface-container-high">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection