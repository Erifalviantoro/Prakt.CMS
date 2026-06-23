@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col bg-gray-50">
    @include('admin.layout.header')

    <div class="flex-1 p-8 max-w-7xl mx-auto w-full">

        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Manajemen Transaksi
                </h2>
                <p class="text-gray-500 text-sm mt-1">
                    Kelola seluruh invoice dan riwayat pembayaran servis pelanggan.
                </p>
            </div>

            <a href="{{ route('admin.transaksi.create') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white font-semibold text-sm rounded-xl shadow-md shadow-red-600/10 hover:bg-red-700 transition-all active:scale-95">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Tambah Transaksi
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 text-sm font-medium">
                <span class="material-symbols-outlined text-green-600 text-[22px]">check_circle</span>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                <ul class="space-y-1 font-medium">
                    @foreach ($errors->all() as $error)
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-red-600 text-[18px]">error</span>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[26px]">payments</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Pendapatan</p>
                    <h3 class="font-extrabold text-2xl text-gray-900 mt-1">
                        Rp {{ number_format($totalPendapatan,0,',','.') }}
                    </h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[26px]">pending_actions</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Belum Lunas</p>
                    <div class="flex items-baseline gap-2 mt-1">
                        <h3 class="font-extrabold text-2xl text-gray-900">{{ $jumlahPending }}</h3>
                        <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-md">Transaksi</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[26px]">receipt_long</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jumlah Transaksi</p>
                    <h3 class="font-extrabold text-2xl text-gray-900 mt-1">{{ $jumlahTransaksi }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center mb-4">
                    <span class="material-symbols-outlined text-[26px]">analytics</span>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Rata-rata Transaksi</p>
                    <h3 class="font-extrabold text-2xl text-gray-900 mt-1">
                        Rp {{ number_format($rataRata,0,',','.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50">
                <h3 class="font-bold text-gray-800 text-lg">
                    Riwayat Transaksi
                </h3>
                <form method="GET" class="w-full sm:w-auto">
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-[20px]">search</span>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari transaksi..."
                            class="w-full sm:w-64 border border-gray-200 rounded-xl pl-10 pr-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600/20 focus:border-red-600 transition-colors">
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead>
                        <tr class="bg-[#0f172a] text-white text-sm font-semibold border-b border-gray-100">
                            <th class="px-6 py-4 text-left rounded-tl-2xl">No. Invoice</th>
                            <th class="px-6 py-4 text-left">Pelanggan</th>
                            <th class="px-6 py-4 text-left">Kendaraan</th>
                            <th class="px-6 py-4 text-left">Tanggal</th>
                            <th class="px-6 py-4 text-left">Total Biaya</th>
                            <th class="px-6 py-4 text-left">Status</th>
                            <th class="px-6 py-4 text-center rounded-tr-2xl">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                        @forelse($transaksi as $item)
                            <tr class="hover:bg-gray-50/70 transition-colors">
                                <td class="px-6 py-4 font-mono font-bold text-xs text-gray-500">
                                    #TRX-{{ optional($item->created_at)->format('Ymd') }}-{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                                </td>
                                
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $item->detailServis->booking->pelanggan->nama ?? 'Umum / Tanpa Nama' }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-gray-900 block">
                                        {{ $item->detailServis->booking->kendaraan->model ?? 'Beat 125' }}
                                    </span>
                                    <span class="text-xs text-gray-400 font-mono tracking-wide mt-0.5 block">
                                        {{ $item->detailServis->booking->kendaraan->no_polisi ?? $item->detailServis->booking->kendaraan->nomor_plat ?? 'AB 2414 EA' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-gray-600">
                                    {{ optional($item->created_at)->format('d-m-Y') }}
                                </td>
                                
                                <td class="px-6 py-4 font-bold text-gray-900">
                                    Rp {{ number_format($item->total_biaya,0,',','.') }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    @if(in_array(strtolower($item->status_pembayaran), ['lunas', 'sukses']))
                                        <span class="inline-flex items-center gap-1 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                            Lunas
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-amber-50 text-amber-700 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Belum Lunas
                                        </span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex justify-center items-center gap-1.5">
                                        <a href="{{ route('admin.transaksi.show',$item->id) }}"
                                            class="p-2 text-blue-600 bg-blue-50/50 hover:bg-blue-100/80 rounded-xl transition-colors" title="Lihat Invoice">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </a>

                                        <a href="{{ route('admin.transaksi.edit',$item->id) }}"
                                            class="p-2 text-amber-600 bg-amber-50/50 hover:bg-amber-100/80 rounded-xl transition-colors" title="Edit Transaksi">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>

                                        <button type="button" 
                                                onclick="openDeleteModal('{{ route('admin.transaksi.destroy', $item->id) }}')" 
                                                class="p-2 text-red-600 bg-red-50/50 hover:bg-red-100/80 rounded-xl transition-colors" 
                                                title="Hapus Catatan">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-12 text-gray-400 font-medium">
                                    <span class="material-symbols-outlined text-[40px] block mb-2 text-gray-300">layers_clear</span>
                                    Belum ada data transaksi tersimpan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-gray-100 bg-gray-50/50">
                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
</main>

{{-- Custom Elegant Delete Modal Confirmation --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl transform scale-95 transition-transform duration-200 border border-gray-100">
        <div class="flex items-center gap-3 text-red-600 mb-3">
            <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-[22px]">warning</span>
            </div>
            <h3 class="font-bold text-lg text-gray-900">Hapus Data Transaksi</h3>
        </div>
        <p class="text-sm text-gray-500 line-height-relaxed mb-6">Apakah Anda yakin ingin menghapus data transaksi ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex items-center justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-all active:scale-95">
                    Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('opacity-0');
        modal.querySelector('.transform').classList.remove('scale-100');
        modal.querySelector('.transform').classList.add('scale-95');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 200);
    }
</script>
@endsection