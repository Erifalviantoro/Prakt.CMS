@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">

            <div>
                <h2 class="font-headline-lg text-primary">
                    Manajemen Layanan
                </h2>

                <p class="text-on-surface-variant">
                    Kelola seluruh data layanan servis bengkel.
                </p>
            </div>

            <a href="{{ route('admin.layanan.create') }}"
               class="bg-primary hover:bg-primary-container text-white px-5 py-3 rounded-xl flex items-center gap-2 shadow">

                <span class="material-symbols-outlined">
                    add
                </span>

                Tambah Layanan
            </a>

        </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl border shadow-sm">

                <div class="flex items-center gap-4">

                    <span class="material-symbols-outlined text-4xl text-primary">
                        build
                    </span>

                    <div>
                        <p>Total Layanan</p>

                        <h3 class="text-2xl font-bold">
                            {{ $totalLayanan }}
                        </h3>
                    </div>

                </div>

            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">

                <div class="flex items-center gap-4">

                    <span class="material-symbols-outlined text-4xl text-green-600">
                        check_circle
                    </span>

                    <div>
                        <p>Layanan Aktif</p>

                        <h3 class="text-2xl font-bold">
                            {{ $layananAktif }}
                        </h3>
                    </div>

                </div>

            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">

                <div class="flex items-center gap-4">

                    <span class="material-symbols-outlined text-4xl text-red-600">
                        cancel
                    </span>

                    <div>
                        <p>Layanan Nonaktif</p>

                        <h3 class="text-2xl font-bold">
                            {{ $layananNonaktif }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

        <!-- Search -->
        <div class="bg-white p-4 rounded-xl border shadow-sm mb-6">

            <input type="text"
                   placeholder="Cari layanan..."
                   class="w-full border rounded-lg px-4 py-3">

        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-primary text-white">

                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Gambar</th>
                        <th class="px-6 py-4 text-left">Nama Layanan</th>
                        <th class="px-6 py-4 text-left">Harga</th>
                        <th class="px-6 py-4 text-left">Estimasi</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($layanans as $layanan)

                    <tr class="border-b">

                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            @if($layanan->gambar)
                                <img
                                    src="{{ asset('storage/'.$layanan->gambar) }}"
                                    alt="{{ $layanan->nama_layanan }}"
                                    class="w-20 h-16 object-cover rounded-lg border">
                            @else
                                <div class="w-20 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-gray-400">
                                        image
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ $layanan->nama_layanan }}
                        </td>
                        <td class="px-6 py-4">
                            Rp {{ number_format($layanan->harga,0,',','.') }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $layanan->estimasi_waktu }} Menit
                        </td>

                        <td class="px-6 py-4">

                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $layanan->status == 'Aktif'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">

                                {{ $layanan->status }}

                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-3">

                                <a href="{{ route('admin.layanan.show',$layanan->id) }}">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </a>

                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}">
                                <span class="material-symbols-outlined">
                                    edit
                                </span>
                            </a>

                            <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <!-- CHANGED $item->id TO $layanan->id BELOW -->
                                <button type="button" onclick="openDeleteModal('{{ route('admin.layanan.destroy', $layanan->id) }}')" class="p-2 text-error hover:bg-error/10 rounded-xl transition-all flex items-center justify-center" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-6 text-gray-500">

                            Data layanan belum tersedia

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>
{{-- Tempatkan ini di paling bawah file sebelum @endsection --}}

{{-- Custom Elegant Delete Modal Confirmation --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm opacity-0 transition-opacity duration-200">
    <div class="bg-white rounded-2xl max-w-sm w-full p-6 shadow-xl transform scale-95 transition-transform duration-200">
        <div class="flex items-center gap-3 text-error mb-4">
            <div class="w-10 h-10 rounded-xl bg-error/10 flex items-center justify-center">
                <span class="material-symbols-outlined">warning</span>
            </div>
            <h3 class="font-bold text-label-lg text-on-surface">Hapus Data Layanan</h3>
        </div>
        <p class="text-label-md text-on-surface-variant mb-6">Apakah Anda yakin ingin menghapus data layanan ini? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="flex items-center justify-end gap-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 border border-outline-variant rounded-xl font-label-md text-on-surface-variant hover:bg-surface-container-low transition-colors">
                Batal
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-error hover:bg-error-container text-white font-label-md rounded-xl shadow-sm transition-all active:scale-95">
                    Hapus Data
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Modal Control Script --}}
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