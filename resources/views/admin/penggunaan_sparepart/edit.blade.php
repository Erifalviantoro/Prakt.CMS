@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <div class="flex-1 p-gutter">
        
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary">Edit Log Penggunaan</h2>
            <p class="text-on-surface-variant font-body-md">Koreksi kesalahan entri pencatatan keluar suku cadang.</p>
        </div>

        <div class="max-w-2xl bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant bg-primary text-on-primary">
                <span class="font-headline-md text-lg">Form Update Log: LOG-PGN-{{ str_pad($penggunaan->id, 4, '0', STR_PAD_LEFT) }}</span>
            </div>
            
            <form action="{{ route('admin.penggunaan-sparepart.update', $penggunaan->id) }}" method="POST" class="p-6 space-y-6">
    @csrf
    @method('PUT')

    {{-- Sparepart --}}
    <div class="flex flex-col gap-2">
        <label for="id_sparepart">Pilih Sparepart</label>
        <select name="id_sparepart" id="id_sparepart">
            @foreach($spareparts as $sparepart)
                <option value="{{ $sparepart->id }}"
                    data-harga="{{ $sparepart->harga }}"
                    {{ old('id_sparepart', $penggunaan->id_sparepart) == $sparepart->id ? 'selected' : '' }}>
                    {{ $sparepart->nama }}
                    - Rp {{ number_format($sparepart->harga,0,',','.') }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Jumlah --}}
    <div class="flex flex-col gap-2">
        <label for="jumlah">Jumlah</label>
        <input type="number" name="jumlah" value="{{ old('jumlah', $penggunaan->jumlah) }}">
    </div>
    <div class="flex flex-col gap-2">
        <label class="font-label-md text-primary font-bold">
            Subtotal
        </label>

        <input
            type="text"
            id="subtotal"
            readonly
            value="Rp 0"
            class="w-full bg-surface-container-high border border-outline-variant rounded-lg px-4 py-3">
    </div>
    <div class="flex justify-end gap-4">
        <a href="{{ route('admin.penggunaan-sparepart.index') }}">Batal</a>

        <button type="submit"
            class="bg-primary text-white px-6 py-2 rounded">
            Perbarui Log
        </button>
    </div>
</form>
        </div>
        
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {

    const sparepart = document.getElementById('id_sparepart');
    const jumlah = document.getElementById('jumlah');
    const subtotal = document.getElementById('subtotal');

    function hitungSubtotal() {

        let harga = 0;

        if (sparepart.selectedIndex >= 0) {
            harga = parseFloat(
                sparepart.options[sparepart.selectedIndex].dataset.harga || 0
            );
        }

        let qty = parseInt(jumlah.value || 0);

        let total = harga * qty;

        subtotal.value = 'Rp ' + total.toLocaleString('id-ID');
    }

    sparepart.addEventListener('change', hitungSubtotal);
    jumlah.addEventListener('input', hitungSubtotal);

    hitungSubtotal();
});
</script>
@endsection