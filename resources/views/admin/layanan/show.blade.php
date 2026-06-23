@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <div class="mb-8">

            <h2 class="font-headline-lg text-primary">
                Detail Layanan
            </h2>

            <p class="text-on-surface-variant">
                Informasi lengkap layanan bengkel.
            </p>
        </div>

        <div class="bg-white rounded-xl border shadow-sm p-8">
            @if($layanan->gambar)
            <div class="mb-8">
                <p class="text-sm text-gray-500 mb-2">
                    Gambar Layanan
                </p>
                <img
                    src="{{ asset('storage/' . $layanan->gambar) }}"
                    alt="{{ $layanan->nama_layanan }}"
                    class="w-full max-w-md h-64 object-cover rounded-xl border shadow">

            </div>
            @endif
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Nama Layanan
                    </p>

                    <p class="font-medium text-lg">
                        {{ $layanan->nama_layanan }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Harga
                    </p>

                    <p class="font-medium text-lg">
                        Rp {{ number_format($layanan->harga,0,',','.') }}
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Estimasi Waktu
                    </p>

                    <p class="font-medium text-lg">
                        {{ $layanan->estimasi_waktu }} Menit
                    </p>

                </div>

                <div>

                    <p class="text-sm text-gray-500 mb-1">
                        Status
                    </p>

                    <span class="inline-flex px-4 py-2 rounded-full text-sm font-semibold
                        {{ $layanan->status == 'Aktif'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">
                        {{ $layanan->status }}
                    </span>

                </div>

            </div>

            <div class="mt-8">

                <p class="text-sm text-gray-500 mb-2">
                    Deskripsi
                </p>

                <div class="border rounded-lg p-4 bg-gray-50">
                    {{ $layanan->deskripsi }}
                </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Dibuat Pada
                    </p>
                    <p>
                        {{ $layanan->created_at->format('d M Y H:i') }}
                    </p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 mb-1">
                        Terakhir Diupdate
                    </p>
                    <p>
                        {{ $layanan->updated_at->format('d M Y H:i') }}
                    </p>
                </div>
            </div>
            <div class="flex justify-end mt-8">
                <a href="{{ route('admin.layanan.index') }}"
                   class="bg-primary text-white px-6 py-3 rounded-lg">
                    Kembali
                </a>
            </div>

        </div>

    </div>

</main>
@endsection