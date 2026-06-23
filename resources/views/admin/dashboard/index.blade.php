@extends('admin.layout.layout')
@section('content')
<main class="ml-64 flex-1 flex flex-col bg-background">
    @include('admin.layout.header')
    
    <div class="p-gutter space-y-8 max-w-[1400px] mx-auto w-full">
         <div>
                <nav class="flex items-center gap-2 text-on-surface-variant mb-2">
                    <a class="font-label-sm text-label-sm hover:text-secondary" href="#">Dashboard</a>
                </nav>
                <h2 class="font-headline-lg text-headline-lg text-primary">Dashboard</h2>
            </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-bl-full -mr-8 -mt-8 group-hover:scale-110 transition-transform"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <span class="{{ $kenaikanPelanggan >= 0 ? 'text-green-600' : 'text-red-600' }} text-label-sm font-bold flex items-center">
                        <span class="material-symbols-outlined text-sm">{{ $kenaikanPelanggan >= 0 ? 'trending_up' : 'trending_down' }}</span> 
                        {{ $kenaikanPelanggan >= 0 ? '+' : '' }}{{ $kenaikanPelanggan }}%
                    </span>
                </div>
                <h3 class="text-on-surface-variant text-label-md">Total Pelanggan</h3>
                <p class="text-headline-md font-bold text-primary">{{ number_format($totalPelanggan) }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-secondary/5 rounded-bl-full -mr-8 -mt-8 group-hover:scale-110 transition-transform"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-secondary/10 rounded-lg text-secondary">
                        <span class="material-symbols-outlined">calendar_today</span>
                    </div>
                    <span class="text-label-sm font-bold text-primary">Hari Ini</span>
                </div>
                <h3 class="text-on-surface-variant text-label-md">Booking Hari Ini</h3>
                <p class="text-headline-md font-bold text-primary">{{ $bookingAktif }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="flex justify-between items-start mb-4">
                <div class="p-2 bg-primary-container/10 rounded-lg text-primary-container">
                    <span class="material-symbols-outlined">payments</span>
                </div>

                <span class="text-label-sm font-bold text-primary">
                    {{ now()->format('d M Y') }}
                </span>
            </div>
                <h3 class="text-on-surface-variant text-label-md">Pendapatan Hari Ini</h3>
                <p class="text-headline-md font-bold text-primary">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white p-6 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-error/5 rounded-bl-full -mr-8 -mt-8 group-hover:scale-110 transition-transform"></div>
                <div class="flex justify-between items-start mb-4">
                    <div class="p-2 bg-error/10 rounded-lg text-error">
                        <span class="material-symbols-outlined">inventory</span>
                    </div>
                    <span class="{{ $stokKritisCount > 0 ? 'bg-red-100 text-red-700 px-2 py-0.5 rounded-full' : 'text-green-600' }} text-label-sm font-bold">
                        {{ $stokKritisCount }} Kritis
                    </span>
                </div>
                <h3 class="text-on-surface-variant text-label-md">Stok Sparepart</h3>
                <p class="text-headline-md font-bold text-primary">{{ number_format($totalSparepartItem) }} <span class="text-body-md font-normal text-outline">items</span></p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
            <div class="lg:col-span-2 bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-headline-md font-bold text-primary flex items-center gap-2">
                        <span class="material-symbols-outlined">engineering</span> Monitoring Servis Real-time
                    </h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-primary">
                        <p class="text-outline text-label-sm uppercase font-bold">Antrian</p>
                        <p class="text-headline-md font-bold mt-1">{{ sprintf("%02d", $statusServis['antrian']) }}</p>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-yellow-500">
                        <p class="text-outline text-label-sm uppercase font-bold">Pengerjaan</p>
                        <p class="text-headline-md font-bold mt-1">{{ sprintf("%02d", $statusServis['proses']) }}</p>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-error">
                        <p class="text-outline text-label-sm uppercase font-bold">Dikonfirmasi</p>
                        <p class="text-headline-md font-bold mt-1">{{ sprintf("%02d", $statusServis['pending']) }}</p>
                    </div>
                    <div class="p-4 bg-surface-container-low rounded-lg border-l-4 border-green-600">
                        <p class="text-outline text-label-sm uppercase font-bold">Selesai</p>
                        <p class="text-headline-md font-bold mt-1">{{ sprintf("%02d", $statusServis['selesai']) }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-primary text-white rounded-xl p-6 shadow-lg flex flex-col justify-between overflow-hidden relative">
                <div class="relative z-10">
                    <h2 class="text-headline-md font-bold mb-6">Aksi Cepat</h2>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('admin.pelanggan.create') }}"class="flex flex-col items-center justify-center p-4 bg-white/10 hover:bg-white/20 rounded-xl">
                            <span class="material-symbols-outlined mb-2 text-secondary-container">person_add</span>
                            <span class="text-label-sm">Pelanggan</span>
                        </a>
                        <a href="{{ route('admin.kendaraan.create') }}"class="flex flex-col items-center justify-center p-4 bg-white/10 hover:bg-white/20 rounded-xl transition-all border border-white/10 active:scale-95">
                            <span class="material-symbols-outlined mb-2 text-secondary-container">directions_car</span>
                            <span class="text-label-sm">Kendaraan</span>
                        </a>
                        <a href="{{ route('admin.sparepart.create') }}"class="flex flex-col items-center justify-center p-4 bg-white/10 hover:bg-white/20 rounded-xl">
                            <span class="material-symbols-outlined mb-2 text-secondary-container">build</span>
                            <span class="text-label-sm">Tambah Part</span>
                        </button>
                       <a href="{{ route('admin.layanan.create') }}"class="flex flex-col items-center justify-center p-4 bg-white/10 hover:bg-white/20 rounded-xl transition-all border border-white/10 active:scale-95">
                            <span class="material-symbols-outlined mb-2 text-secondary-container">build</span>
                            <span class="text-label-sm">Layanan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
            <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-headline-md font-bold text-primary">Tren Pendapatan Bulanan</h2>
                </div>
                <canvas height="200" id="revenueChart"></canvas>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm flex flex-col items-center">
                    <h3 class="text-label-md font-bold text-primary mb-4 w-full">Layanan Terlaris</h3>
                    <canvas height="150" id="serviceChart" width="150"></canvas>
                </div>
                
                <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                    <h3 class="text-label-md font-bold text-primary mb-4">Mekanik Terproduktif</h3>
                    <div class="space-y-4">
                        @forelse($mekanikProduktif as $mekanik)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr($mekanik->nama_mekanik, 0, 2)) }}
                            </div>
                            <div class="flex-1">
                                <p class="text-label-md font-bold text-slate-800">{{ $mekanik->nama_mekanik }}</p>
                                <div class="w-full bg-slate-100 h-2 rounded-full mt-1 overflow-hidden">
                                    <div class="bg-[#0f172a] h-full rounded-full transition-all duration-500" style="width: {{ $mekanik->produktivitas }}%"></div>
                                </div>
                            </div>
                            <span class="text-label-sm font-bold text-slate-700">{{ $mekanik->produktivitas }}%</span>
                        </div>
                        @empty
                        <p class="text-label-sm text-outline text-center py-4">Belum ada data performa mekanik.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-gutter">
            <div class="xl:col-span-2 bg-white rounded-xl border border-outline-variant overflow-hidden shadow-sm">
                <div class="p-6 border-b border-outline-variant flex justify-between items-center">
                    <h2 class="text-headline-md font-bold text-primary">Aktivitas & Booking Terbaru</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="px-6 py-3 text-label-sm font-bold uppercase">ID Booking</th>
                                <th class="px-6 py-3 text-label-sm font-bold uppercase">Pelanggan</th>
                                <th class="px-6 py-3 text-label-sm font-bold uppercase">Kendaraan</th>
                                <th class="px-6 py-3 text-label-sm font-bold uppercase">Status</th>
                                <th class="px-6 py-3 text-label-sm font-bold uppercase">Waktu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            @forelse($bookingTerbaru as $booking)
                            <tr class="hover:bg-surface-container-low transition-colors">
                                <td class="px-6 py-4 font-bold text-primary">#BK-{{ $booking->id }}</td>
                                <td class="px-6 py-4">
                                    <span class="text-body-md font-bold">{{ $booking->pelanggan->nama ?? 'No Name' }}</span>
                                </td>
                                <td class="px-6 py-4 text-body-md">{{ $booking->kendaraan->nama_kendaraan ?? '-' }}</td>
                                <td class="px-6 py-4">
                                    @if($booking->status == 'Menunggu')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-label-sm font-bold uppercase">Menunggu</span>
                                    @elseif($booking->status == 'Diproses')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-label-sm font-bold uppercase">Proses</span>
                                    @elseif($booking->status == 'Selesai')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-label-sm font-bold uppercase">Selesai</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-label-sm font-bold uppercase">{{ $booking->status }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-label-sm text-outline">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_booking)->format('d M Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-outline">Belum ada aktivitas booking.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                <h2 class="text-label-md font-bold text-primary mb-4 flex items-center justify-between">
                    Stok Kritis 
                    <span class="bg-error text-white text-[10px] px-2 py-0.5 rounded-full">{{ $stokKritisCount }} Items</span>
                </h2>
                <div class="space-y-3">
                    @forelse($daftarStokKritis as $part)
                    <div class="flex justify-between items-center p-3 {{ $part->stok <= 2 ? 'bg-red-50' : 'bg-surface-container-low' }} rounded-lg">
                        <div>
                            <p class="text-body-md font-bold text-primary">{{ $part->nama_sparepart }}</p>
                            <p class="text-label-sm text-error font-bold">Sisa {{ $part->stok }} item</p>
                        </div>
                        <button class="px-3 py-1 bg-error text-white text-label-sm font-bold rounded">Pesan</button>
                    </div>
                    @empty
                    <p class="text-label-sm text-green-600 text-center py-4">Semua stok sparepart aman!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Line Chart (Tren Pendapatan Bulanan)
    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartRevenue['bulan']) !!}, // Array nama bulan asli
            datasets: [{
                label: 'Revenue (Rp)',
                data: {!! json_encode($chartRevenue['data']) !!}, // Nilai sum transaksi asli
                borderColor: '#1E3A8A', 
                backgroundColor: 'rgba(30, 58, 138, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // 2. Doughnut Chart (Layanan Terlaris Berdasarkan Hitungan Booking)
    const ctxService = document.getElementById('serviceChart').getContext('2d');
    new Chart(ctxService, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($chartLayanan['nama']) !!},
            datasets: [{
                data: {!! json_encode($chartLayanan['jumlah']) !!},
                backgroundColor: ['#0f172a', '#3b82f6', '#10b981', '#f59e0b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection