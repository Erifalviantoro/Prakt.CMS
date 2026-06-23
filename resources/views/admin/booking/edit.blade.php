@extends('admin.layout.layout')

@section('content')

<main class="ml-64 min-h-screen flex flex-col">

```
@include('admin.layout.header')

<div class="flex-1 p-margin-desktop">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary">
            Update Status Booking
        </h2>

        <p class="text-on-surface-variant">
            Ubah status booking pelanggan.
        </p>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant shadow-sm p-8">

        <form action="{{ route('admin.booking.update',$booking->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="font-semibold">
                        Pelanggan
                    </label>

                    <input type="text"
                           value="{{ $booking->pelanggan->nama }}"
                           readonly
                           class="w-full border rounded-lg px-4 py-3 bg-gray-100">
                </div>

                <div>
                    <label class="font-semibold">
                        Kendaraan
                    </label>

                    <input type="text"
                           value="{{ $booking->kendaraan->nomor_plat }}"
                           readonly
                           class="w-full border rounded-lg px-4 py-3 bg-gray-100">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">
                        Keluhan
                    </label>

                    <textarea readonly
                              class="w-full border rounded-lg px-4 py-3 bg-gray-100"
                              rows="4">{{ $booking->keluhan }}</textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">
                        Status Booking
                    </label>

                    <select name="status"
                            class="w-full border rounded-lg px-4 py-3">

                        <option value="Menunggu"
                            {{ $booking->status == 'Menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="Dikonfirmasi"
                            {{ $booking->status == 'Dikonfirmasi' ? 'selected' : '' }}>
                            Dikonfirmasi
                        </option>

                        <option value="Diproses"
                            {{ $booking->status == 'Diproses' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="Selesai"
                            {{ $booking->status == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="Dibatalkan"
                            {{ $booking->status == 'Dibatalkan' ? 'selected' : '' }}>
                            Dibatalkan
                        </option>

                    </select>
                </div>

            </div>

            <div class="flex justify-end gap-4 mt-8">

                <a href="{{ route('admin.booking.index') }}"
                   class="px-5 py-2 border rounded-lg">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-primary text-white rounded-lg">
                    Simpan Perubahan
                </button>

            </div>

        </form>

    </div>

</div>
```

</main>
@endsection
