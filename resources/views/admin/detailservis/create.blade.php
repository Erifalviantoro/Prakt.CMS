@extends('admin.layout.layout')
@section('content')
<main class="pl-64 pt-16 min-h-screen">
    @include('admin.layout.header')
    <div class="p-gutter max-w-container-max-width mx-auto">
        
        <nav class="flex items-center gap-2 mb-8 text-on-surface-variant">
            <a class="font-label-md hover:text-primary transition-colors" href="#">Dashboard</a>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="{{ route('admin.detailservis.index') }}">Detail Servis</a>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="font-label-md text-primary font-bold">Tambah Detail Servis</span>
        </nav>

        <div class="mb-8">
            <h3 class="font-headline-lg text-headline-lg text-primary">Tambah Detail Servis</h3>
            <p class="font-body-md text-on-surface-variant">Isi informasi servis kendaraan pelanggan secara detail.</p>
        </div>

        <form action="{{ route('admin.detailservis.store') }}" method="POST" class="space-y-gutter pb-24">
            @csrf
            
            <div class="grid grid-cols-12 gap-6">
                
                <div class="col-span-12 lg:col-span-7 space-y-6">
                    
                    <div class="bg-white p-8 rounded-xl border border-outline-variant shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined" data-icon="info">info</span>
                            </div>
                            <h4 class="font-headline-md text-headline-md text-primary">Informasi Dasar</h4>
                        </div>
                        
                        {{-- Perbaikan Struktur Grid di Sini --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Pilih Booking</label>
                                <select name="booking_id" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4" required>
                                    <option value="">Pilih Booking</option>
                                    @foreach($booking as $item)
                                        <option value="{{ $item->id }}" {{ old('booking_id') == $item->id ? 'selected' : '' }}>
                                            Booking #{{ $item->id }} - {{ $item->pelanggan->nama ?? 'Tanpa Nama' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Pilih Teknisi</label>
                                <select name="teknisi_id" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4" required>
                                    <option value="">Pilih Teknisi</option>
                                    @foreach($teknisi as $item)
                                        <option value="{{ $item->id }}" {{ old('teknisi_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="space-y-2 md:col-span-2">
                                <label class="font-label-md text-primary block">Jenis Servis</label>
                                <input type="text" name="jenis_servis" value="{{ old('jenis_servis') }}" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4" placeholder="Contoh: Ganti Oli" required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl border border-outline-variant shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined" data-icon="description">description</span>
                            </div>
                            <h4 class="font-headline-md text-headline-md text-primary">Konten Servis</h4>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Deskripsi Servis</label>
                                <textarea name="deskripsi" class="w-full rounded-lg border-outline-variant bg-surface-container-low p-4" rows="4" placeholder="Jelaskan pengerjaan yang dilakukan...">{{ old('deskripsi') }}</textarea>
                            </div>
                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Catatan Teknisi</label>
                                <textarea name="catatan" class="w-full rounded-lg border-outline-variant bg-surface-container-low p-4" rows="3" placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-5 space-y-6">
                    
                    <div class="bg-white p-8 rounded-xl border border-outline-variant shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined" data-icon="schedule">schedule</span>
                            </div>
                            <h4 class="font-headline-md text-headline-md text-primary">Waktu Pengerjaan</h4>
                        </div>
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Waktu Mulai</label>
                                <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4">
                            </div>

                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Waktu Selesai</label>
                                <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4">
                            </div>

                            <div class="space-y-2">
                                <label class="font-label-md text-primary block">Estimasi Selesai</label>
                                <input type="datetime-local" name="estimasi_selesai" value="{{ old('estimasi_selesai') }}" class="w-full h-12 rounded-lg border-outline-variant bg-surface-container-low px-4">
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl border border-outline-variant shadow-sm space-y-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-primary/5 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
                            </div>
                            <h4 class="font-headline-md text-headline-md text-primary">Logistik &amp; Biaya</h4>
                        </div>
                        
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
                            <p class="text-sm text-yellow-700">Total biaya transaksi akan dihitung otomatis dari:</p>
                            <ul class="list-disc ml-5 text-sm mt-2 text-yellow-700">
                                <li>Biaya jasa servis</li>
                                <li>Penggunaan sparepart</li>
                            </ul>
                        </div>

                        <div class="space-y-2">
                            <label class="font-label-md text-primary block">Biaya Jasa (IDR)</label>
                            <p class="text-xs text-gray-500">Total transaksi akan diperbarui otomatis setelah sparepart ditambahkan.</p>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-primary">Rp</span>
                                <input type="number" name="biaya_jasa" value="{{ old('biaya_jasa') }}" min="0" class="w-full h-12 pl-12 pr-4 rounded-lg border-outline-variant bg-surface-container-low focus:ring-2 focus:ring-primary/50 focus:border-primary transition-all" placeholder="0" required>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="fixed bottom-0 right-0 left-64 bg-white/80 backdrop-blur-md border-t border-outline-variant px-8 py-4 flex items-center justify-end gap-4 shadow-up z-40">
                <a href="{{ route('admin.detailservis.index') }}" class="px-8 py-3 rounded-lg border border-outline text-primary font-bold hover:bg-surface-container transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-10 py-3 rounded-lg bg-orange-500 text-white font-bold hover:brightness-110 shadow-lg shadow-orange-500/20 transition-all flex items-center gap-2">
                    <span class="material-symbols-outlined">save</span>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</main>
@endsection