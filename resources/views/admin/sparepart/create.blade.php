@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">
    @include('admin.layout.header')
    <header class="sticky top-0 z-50 flex items-center justify-between px-6 py-3 w-full bg-surface-container-lowest dark:bg-surface-container-low shadow-sm dark:shadow-none border-b border-outline-variant">
        <div class="flex items-center gap-4">
            <h2 class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed">Tambah Sparepart</h2>
            <div class="h-6 w-px bg-outline-variant mx-2"></div>
            <nav class="hidden md:flex gap-4">
                <span class="text-secondary dark:text-secondary-fixed-dim font-bold cursor-default">Inventory Management</span>
            </nav>
        </div>
        <div class="flex items-center gap-6">
            <div class="relative group">
                <span class="material-symbols-outlined text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full cursor-pointer transition-colors">notifications</span>
                <span class="absolute top-1 right-1 w-2 h-2 bg-secondary rounded-full"></span>
            </div>
            <span class="material-symbols-outlined text-on-surface-variant hover:bg-surface-container-high p-2 rounded-full cursor-pointer transition-colors">settings</span>
            <div class="flex items-center gap-3 pl-4 border-l border-outline-variant">
                <div class="text-right">
                    <p class="text-label-md font-bold text-primary">Admin Root</p>
                    <p class="text-label-sm text-on-surface-variant">Shop Manager</p>
                </div>
                <img alt="Shop Administrator Profile" class="w-10 h-10 rounded-full border-2 border-primary-fixed" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC2R6MzB1kei9I-HeDZR2h9s-yKf3BNsj-o7mNSPwmh_uHFMNrUOvrjXcixeReW09C1kS-B-evQdSaVwrnbk3U2np1BAtzAKxemDYyOkamTuauJZ-XTga7maMyKzwcfMP6L4AUmMp47xyzgh6tY_k8YeoqHQPsoJij2bC06ywt8vmoeCQtS-143TAFUSNmkqbit3pj8wZ--G-vAMyYLQ73-0noLfyGVryF3Uz2aLx1mZ2ttR5AdwFFqI1V-Us7LgGzQUhoRB01foib1"/>
            </div>
        </div>
    </header>

    <section class="p-8 flex-1">
        <div class="max-w-container-max-width mx-auto">
            <nav class="flex items-center gap-2 mb-8 text-on-surface-variant text-label-md">
                <a class="hover:text-primary" href="{{ route('admin.sparepart.index') }}">Inventory</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <a class="hover:text-primary" href="{{ route('admin.sparepart.index') }}">Spareparts</a>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-primary font-bold">Tambah Baru</span>
            </nav>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
                    <p class="font-bold mb-1">Terjadi kesalahan input:</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.sparepart.store') }}" class="bento-grid" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm transition-all hover:shadow-md">
                        <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined">inventory_2</span>
                            Informasi Utama
                        </h3>
                        
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-label-md font-bold text-primary" for="nama">Nama Sparepart</label>
                                    <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-low text-body-md focus:ring-2 focus:ring-primary/20 transition-all @error('nama') border-red-500 @enderror" id="nama" name="nama" placeholder="Contoh: Kampas Rem Depan Vario 125" required type="text" value="{{ old('nama') }}"/>
                                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-label-md font-bold text-primary" for="supplier">Supplier</label>
                                    <div class="relative">
                                        <select class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-low text-body-md appearance-none focus:ring-2 focus:ring-primary/20 transition-all" id="supplier" name="supplier">
                                            <option disabled selected value="">Pilih Supplier</option>
                                            <option value="1">AHM Genuine Parts</option>
                                            <option value="2">Indoparts Distribution</option>
                                            <option value="3">Federal Parts Center</option>
                                            <option value="4">PT Mitra Kencana</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-outline">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="block text-label-md font-bold text-primary" for="stok">Jumlah Stok</label>
                                    <div class="relative">
                                        <input class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-low text-body-md focus:ring-2 focus:ring-primary/20 transition-all @error('stok') border-red-500 @enderror" id="stok" min="0" name="stok" placeholder="0" required type="number" value="{{ old('stok', 0) }}"/>
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-label-sm text-on-surface-variant font-bold uppercase">Units</span>
                                    </div>
                                    @error('stok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                
                                <div class="space-y-2">
                                    <label class="block text-label-md font-bold text-primary" for="harga">Harga Jual (Rp)</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-body-md text-on-surface-variant font-bold">Rp</span>
                                        <input class="w-full pl-12 pr-4 py-3 rounded-lg border border-outline-variant bg-surface-container-low text-body-md focus:ring-2 focus:ring-primary/20 transition-all @error('harga') border-red-500 @enderror" id="harga" name="harga" placeholder="0" required type="number" min="0" value="{{ old('harga') }}"/>
                                    </div>
                                    @error('harga') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="block text-label-md font-bold text-primary" for="deskripsi">Deskripsi</label>
                                <textarea class="w-full px-4 py-3 rounded-lg border border-outline-variant bg-surface-container-low text-body-md focus:ring-2 focus:ring-primary/20 transition-all resize-none" id="deskripsi" name="deskripsi" placeholder="Berikan deskripsi detail sparepart, spesifikasi, dan kecocokan model motor..." rows="5">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-4 space-y-6">
                    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm transition-all hover:shadow-md">
                        <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined">image</span>
                            Foto Produk
                        </h3>
                        <div class="relative group cursor-pointer border-2 border-dashed border-outline-variant rounded-xl p-4 transition-all hover:border-primary hover:bg-primary/5">
                            <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" id="foto_produk" name="foto_produk" type="file" onchange="previewImage(this)"/>
                            <div class="aspect-square bg-surface-container-low rounded-lg overflow-hidden flex flex-col items-center justify-center gap-4 text-center p-6" id="upload-placeholder">
                                <span class="material-symbols-outlined text-[48px] text-outline group-hover:text-primary transition-colors">cloud_upload</span>
                                <div>
                                    <p class="text-label-md font-bold text-primary">Klik untuk upload foto</p>
                                    <p class="text-label-sm text-on-surface-variant mt-1">PNG, JPG, atau WebP (Maks. 2MB)</p>
                                </div>
                            </div>
                            <div class="hidden absolute inset-4 bg-surface-container-low rounded-lg overflow-hidden" id="preview-container">
                                <img alt="Preview" class="w-full h-full object-cover" id="image-preview" src="#"/>
                                <button class="absolute top-2 right-2 p-1 bg-error text-on-error rounded-full shadow-md hover:bg-error-container hover:text-on-error-container transition-colors z-20" onclick="removeImage(event)" type="button">
                                    <span class="material-symbols-outlined text-[20px]">close</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant shadow-sm">
                        <p class="text-label-sm text-on-surface-variant mb-6 italic">Pastikan semua data sudah benar sebelum menyimpan ke dalam sistem inventaris.</p>
                        <div class="flex flex-col gap-3">
                            <button class="w-full py-4 bg-primary text-on-primary rounded-lg font-bold text-label-md flex items-center justify-center gap-2 hover:brightness-125 active:scale-95 transition-all shadow-lg" type="submit">
                                <span class="material-symbols-outlined">save</span>
                                Simpan Sparepart
                            </button>
                            <a href="{{ route('admin.sparepart.index') }}" class="w-full py-4 bg-transparent text-primary border-2 border-primary/20 rounded-lg font-bold text-label-md flex items-center justify-center gap-2 hover:bg-surface-container-high active:scale-95 transition-all">
                                <span class="material-symbols-outlined">cancel</span>
                                Batal
                            </a>
                        </div>
                    </div>

                    <div class="p-6 bg-primary-fixed text-on-primary-fixed rounded-xl flex gap-4">
                        <span class="material-symbols-outlined text-primary">info</span>
                        <div>
                            <p class="text-label-md font-bold">Tip Profesional</p>
                            <p class="text-label-sm mt-1">Gunakan format nama yang konsisten agar mudah dicari oleh mekanik saat proses pengerjaan servis.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <footer class="w-full py-4 px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-4 ml-0 bg-surface dark:bg-surface-dim border-t border-outline-variant mt-auto">
        <p class="font-label-sm text-label-sm text-on-surface dark:text-on-surface-variant">© 2026 Sumber Baru Motor. High-Performance Maintenance Systems.</p>
        <div class="flex gap-6">
            <a class="text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Support</a>
        </div>
    </footer>
</main>

<script>
function previewImage(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').src = e.target.result;
            document.getElementById('preview-container').classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}

function removeImage(event) {
    event.preventDefault();
    document.getElementById('foto_produk').value = "";
    document.getElementById('preview-container').classList.add('hidden');
    document.getElementById('image-preview').src = "#";
}
</script>
@endsection