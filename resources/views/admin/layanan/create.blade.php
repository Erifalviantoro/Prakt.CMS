@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <div class="mb-8">
            <h2 class="font-headline-lg text-primary">
                Tambah Layanan
            </h2>

            <p class="text-on-surface-variant">
                Tambahkan layanan baru yang tersedia di bengkel.
            </p>
        </div>

        <div class="bg-white rounded-xl border shadow-sm p-8">

            <form action="{{ route('admin.layanan.store') }}"
            method="POST"
            enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama Layanan
                        </label>

                        <input type="text"
                               name="nama_layanan"
                               class="w-full border rounded-lg px-4 py-3"
                               required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Harga
                        </label>

                        <input type="number"
                               name="harga"
                               class="w-full border rounded-lg px-4 py-3"
                               required>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Estimasi Waktu (Menit)
                        </label>

                        <input type="number"
                               name="estimasi_waktu"
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Status
                        </label>

                        <select name="status"
                                class="w-full border rounded-lg px-4 py-3">

                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>

                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 font-medium">
                            Gambar Layanan
                        </label>

                        <input type="file"
                            name="gambar"
                            accept="image/*"
                            class="w-full border rounded-lg px-4 py-3">

                        <small class="text-gray-500">
                            Format: JPG, JPEG, PNG, WEBP (maks. 2MB)
                        </small>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block mb-2 font-medium">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                              rows="5"
                              class="w-full border rounded-lg px-4 py-3"></textarea>
                </div>

                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('admin.layanan.index') }}"
                       class="px-5 py-3 border rounded-lg">
                        Batal
                    </a>

                    <button type="submit"
                            class="bg-primary text-white px-6 py-3 rounded-lg flex items-center gap-2">

                        <span class="material-symbols-outlined">
                            save
                        </span>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</main>
@endsection