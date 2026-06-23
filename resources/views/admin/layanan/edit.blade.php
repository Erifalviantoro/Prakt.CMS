@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <div class="mb-8">
            <h2 class="font-headline-lg text-primary">
                Edit Layanan
            </h2>

            <p class="text-on-surface-variant">
                Perbarui informasi layanan.
            </p>
        </div>

        <div class="bg-white rounded-xl border shadow-sm p-8">

            <form action="{{ route('admin.layanan.update',$layanan->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium">
                            Nama Layanan
                        </label>

                        <input type="text"
                               name="nama_layanan"
                               value="{{ $layanan->nama_layanan }}"
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Harga
                        </label>

                        <input type="number"
                               name="harga"
                               value="{{ $layanan->harga }}"
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Estimasi Waktu
                        </label>

                        <input type="number"
                               name="estimasi_waktu"
                               value="{{ $layanan->estimasi_waktu }}"
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">
                            Status
                        </label>

                        <select name="status"
                                class="w-full border rounded-lg px-4 py-3">

                            <option value="Aktif"
                                {{ $layanan->status == 'Aktif' ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="Nonaktif"
                                {{ $layanan->status == 'Nonaktif' ? 'selected' : '' }}>
                                Nonaktif
                            </option>

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
                            Kosongkan jika tidak ingin mengganti gambar.
                        </small>
                    </div>
                </div>

                <div class="mt-6">

                    <label class="block mb-2 font-medium">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                              rows="5"
                              class="w-full border rounded-lg px-4 py-3">{{ $layanan->deskripsi }}</textarea>

                </div>

                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('admin.layanan.index') }}"
                       class="px-5 py-3 border rounded-lg">
                        Kembali
                    </a>

                    <button type="submit"
                            class="bg-primary text-white px-6 py-3 rounded-lg flex items-center gap-2">

                        <span class="material-symbols-outlined">
                            save
                        </span>

                        Update

                    </button>

                </div>

            </form>

        </div>

    </div>

</main>
@endsection