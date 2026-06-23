@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <form action="{{ route('admin.transaksi.store') }}" method="POST">
        @csrf

        <div class="flex items-center gap-4 mb-8">
            <a class="p-2 bg-surface hover:bg-surface-container-high border border-outline-variant rounded-lg transition-all" href="{{ route('admin.transaksi.index') }}">
                <span class="material-symbols-outlined align-middle">arrow_back</span>
            </a>
            <div>
                <h2 class="font-headline-lg text-headline-lg text-primary font-bold">Tambah Transaksi Baru</h2>
                <p class="font-body-md text-on-surface-variant">Pilih detail pekerjaan servis yang telah rampung untuk memproses invoice otomatis.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 border-b border-outline-variant pb-4">
                        <span class="material-symbols-outlined text-primary">receipt_long</span>
                        <h3 class="font-headline-md text-headline-md text-primary font-semibold">Informasi Dasar</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant font-medium">Nomor Transaksi (Auto)</label>
                            <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg px-4 py-3 font-mono text-primary font-bold cursor-not-allowed focus:outline-none" readonly type="text" value="TRX-{{ date('Ymd') }}-{{ str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) }}"/>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant font-medium">Tanggal Transaksi <span class="text-error">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">calendar_today</span>
                                <input name="tanggal_servis" value="{{ old('tanggal_servis', date('Y-m-d')) }}" class="w-full border @error('tanggal_servis') border-error focus:ring-error/20 @else border-outline-variant focus:ring-primary/20 @enderror rounded-lg px-4 py-3 focus:ring-2 transition-all" type="date" required/>
                            </div>
                            @error('tanggal_servis')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 border-b border-outline-variant pb-4">
                        <span class="material-symbols-outlined text-primary">build_circle</span>
                        <h3 class="font-headline-md text-headline-md text-primary font-semibold">Data Pelayanan Bengkel</h3>
                    </div>

                    <div class="space-y-2">
                        <label class="font-label-md text-label-md text-on-surface-variant font-medium">
                            Pilih Servis yang Sudah Selesai <span class="text-error">*</span>
                        </label>

                        <select name="detail_servis_id" id="detail_servis_id"
                                class="w-full border @error('detail_servis_id') border-error focus:ring-error/20 @else border-outline-variant focus:ring-primary/20 @enderror rounded-lg px-4 py-3 focus:ring-2 appearance-none bg-no-repeat bg-[right_1rem_center] bg-[length:1.25rem_1.25rem] bg-white" 
                                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2224%22%20height%3D%2224%22%20viewBox%3D%220%200%2024%2024%22%20fill%3D%22none%22%20stroke%3D%22%2374777d%22%20stroke-width%3D%222%22%20stroke-linecap%3D%22round%22%20stroke-linejoin%3D%22round%22%3E%3Cpolyline%20points%3D%226%209%2012%2015%2018%209%22%3E%3C%2Fpolyline%3E%3C%2Fsvg%3E');"
                                required>

                            <option value="" disabled selected>-- Pilih Dokumen Servis Selesai --</option>

                            @foreach($detailServis as $d)
                                <option value="{{ $d->id }}" {{ old('detail_servis_id') == $d->id ? 'selected' : '' }}>
                                    #{{ $d->id }} - {{ $d->booking->pelanggan->nama ?? 'No Name' }} - {{ $d->jenis_servis }}
                                </option>
                            @endforeach

                        </select>
                        
                        @error('detail_servis_id')
                            <p class="text-xs text-error mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="bg-amber-50 border border-amber-200 p-4 rounded-lg mt-4 flex items-start gap-3">
                        <span class="material-symbols-outlined text-amber-700 mt-0.5">warning</span>
                        <p class="text-sm text-amber-800 leading-relaxed font-medium">
                            Total biaya penagihan tidak perlu diisi secara manual. Sistem kasir akan menghitung kalkulasi nominal penagihan secara otomatis yang diakumulasikan dari akumulasi harga <strong>Biaya Jasa Servis + Penggunaan Sparepart</strong> terdaftar.
                        </p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-xl border border-outline-variant p-6 shadow-sm sticky top-6">
                    <div class="flex items-center gap-2 mb-6 border-b border-outline-variant pb-4">
                        <span class="material-symbols-outlined text-primary">payments</span>
                        <h3 class="font-headline-md text-headline-md text-primary font-semibold">Detail Pembayaran</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant font-medium">Metode Pembayaran</label>
                            <div class="grid grid-cols-1 gap-2">
                                <label class="flex items-center gap-3 p-3 border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-low transition-colors">
                                    <input class="text-primary focus:ring-primary/20 h-5 w-5" name="metode_pembayaran" type="radio" value="Cash" {{ old('metode_pembayaran', 'Cash') == 'Cash' ? 'checked' : '' }}/>
                                    <span class="font-label-md text-label-md">Cash / Tunai</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-low transition-colors">
                                    <input class="text-primary focus:ring-primary/20 h-5 w-5" name="metode_pembayaran" type="radio" value="Transfer" {{ old('metode_pembayaran') == 'Transfer' ? 'checked' : '' }}/>
                                    <span class="font-label-md text-label-md">Bank Transfer</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 border border-outline-variant rounded-lg cursor-pointer hover:bg-surface-container-low transition-colors">
                                    <input class="text-primary focus:ring-primary/20 h-5 w-5" name="metode_pembayaran" type="radio" value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'checked' : '' }}/>
                                    <span class="font-label-md text-label-md">QRIS / E-Wallet</span>
                                </label>
                            </div>
                            @error('metode_pembayaran')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant font-medium">Status Pembayaran</label>
<select name="status_pembayaran">

    <option value="Menunggu Pembayaran" selected>
        Menunggu Pembayaran
    </option>

    <option value="Belum Lunas">
        Belum Lunas
    </option>

    <option value="Lunas">
        Lunas
    </option>

    <option value="Gagal">
        Gagal
    </option>

</select>
                            @error('status_pembayaran')
                                <p class="text-xs text-error mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-4 border-t border-outline-variant">
                            <a href="{{ route('admin.transaksi.index') }}" class="px-6 py-4 border border-primary text-primary font-bold rounded-lg hover:bg-surface-container-low transition-all active:scale-95 text-center flex items-center justify-center">
                                Batal
                            </a>
                            <button class="px-6 py-4 bg-secondary text-on-secondary font-bold rounded-lg shadow-lg shadow-secondary/20 hover:brightness-110 transition-all active:scale-95 flex items-center justify-center" type="submit">
                                Simpan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-primary/5 rounded-xl border border-primary/10 p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="material-symbols-outlined text-primary text-[20px]">info</span>
                        <h4 class="font-label-md text-label-md text-primary font-bold uppercase tracking-wider">Tip Admin</h4>
                    </div>
                    <p class="font-label-sm text-label-sm text-on-surface-variant italic">
                        Struk nota kasir / invoice digital berformat PDF akan otomatis digenerate secara real-time sesaat setelah tombol "Simpan" ditekan.
                    </p>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection