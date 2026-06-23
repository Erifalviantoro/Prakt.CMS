@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <div class="flex-1 p-gutter">
        
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary">Catat Penggunaan Sparepart</h2>
            <p class="text-on-surface-variant font-body-md">Tambahkan log baru untuk komponen yang digunakan.</p>
        </div>

        <div class="max-w-2xl bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-outline-variant bg-primary text-on-primary">
                <span class="font-headline-md text-lg">Form Pengisian</span>
            </div>
            
            <form action="{{ route('admin.penggunaan-sparepart.store') }}" method="POST" class="p-6 space-y-6">
                @csrf
<div class="flex flex-col gap-2">
    <label for="detail_servis_id" class="font-label-md text-primary font-bold">
        Pilih Detail Servis
    </label>

    <select
        id="detail_servis_id"
        name="detail_servis_id"
        class="w-full bg-surface-container-high border border-outline-variant rounded-lg px-4 py-3"
        required
    >
        <option value="">-- Pilih Detail Servis --</option>

        @foreach($detailServis as $detail)
            <option value="{{ $detail->id }}">
    Detail Servis #{{ $detail->id }}
    - {{ $detail->booking->pelanggan->nama ?? '-' }}
</option>
        @endforeach
    </select>
</div>
<div class="flex flex-col gap-2">
    <label for="id_sparepart" class="font-label-md text-primary font-bold">
        Pilih Sparepart
    </label>

    <select
        id="id_sparepart"
        name="id_sparepart"
        class="w-full bg-surface-container-high border border-outline-variant rounded-lg px-4 py-3"
        required
    >
        <option value="">-- Pilih Sparepart --</option>

        @foreach($spareparts as $sparepart)
            <option
                value="{{ $sparepart->id }}"
                data-harga="{{ $sparepart->harga }}"
            >
                {{ $sparepart->nama }}
                - Rp {{ number_format($sparepart->harga,0,',','.') }}
                (Stok: {{ $sparepart->stok }})
            </option>
        @endforeach
    </select>
</div>
                <div class="flex flex-col gap-2">
                    <label for="jumlah" class="font-label-md text-primary font-bold">Jumlah Digunakan</label>
                    <input type="number" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" min="1" placeholder="Masukkan angka kuantitas..." 
                        class="w-full bg-surface-container-high text-on-surface border @error('jumlah') border-error @else border-outline-variant @enderror rounded-lg px-4 py-3 outline-none focus:border-primary transition-all">
                    @error('jumlah')
                        <span class="text-error text-xs flex items-center gap-1 mt-1">
                            <span class="material-symbols-outlined text-sm">error</span> {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="flex flex-col gap-2">
                    <label class="font-label-md text-primary font-bold">Subtotal</label>
                    <input type="text" id="subtotal" readonly value="Rp 0"
                        class="w-full bg-surface-container-high border border-outline-variant rounded-lg px-4 py-3">
                </div>

                <div class="flex items-center justify-end gap-4 border-t border-outline-variant pt-6">
                    <a href="{{ route('admin.penggunaan-sparepart.index') }}" class="px-5 py-2.5 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container transition-all font-semibold">
                        Batal
                    </a>
                    <button type="submit" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-lg font-bold shadow-md transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">save</span>
                        Simpan Log
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