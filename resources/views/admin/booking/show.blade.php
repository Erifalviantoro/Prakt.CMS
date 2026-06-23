@extends('admin.layout.layout')

@section('content')

<main class="ml-64 min-h-screen flex flex-col">

```
@include('admin.layout.header')

<div class="flex-1 p-margin-desktop">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-primary">
            Detail Booking
        </h2>

        <p class="text-on-surface-variant">
            Informasi lengkap booking pelanggan.
        </p>
    </div>

    <div class="bg-white rounded-xl border border-outline-variant shadow-sm p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold text-primary">
                    Kode Booking
                </label>

                <p>
                    BK-{{ str_pad($booking->id,4,'0',STR_PAD_LEFT) }}
                </p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Tanggal Booking
                </label>

                <p>{{ $booking->tanggal_booking }}</p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Nama Pelanggan
                </label>

                <p>{{ $booking->pelanggan->nama }}</p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Nomor Telepon
                </label>

                <p>{{ $booking->pelanggan->nomor_telepon }}</p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Kendaraan
                </label>

                <p>
                    {{ $booking->kendaraan->merk_kendaraan }}
                    {{ $booking->kendaraan->model_kendaraan }}
                </p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Nomor Plat
                </label>

                <p>{{ $booking->kendaraan->nomor_plat }}</p>
            </div>

            <div class="md:col-span-2">
                <label class="font-semibold text-primary">
                    Keluhan
                </label>

                <p>
                    {{ $booking->keluhan }}
                </p>
            </div>

            <div>
                <label class="font-semibold text-primary">
                    Status
                </label>

                <p>{{ $booking->status }}</p>
            </div>

        </div>

        <div class="flex justify-end gap-4 mt-8">

            <a href="{{ route('admin.booking.index') }}"
               class="px-5 py-2 border rounded-lg">
                Kembali
            </a>

            <a href="{{ route('admin.booking.edit',$booking->id) }}"
               class="px-5 py-2 bg-primary text-white rounded-lg">
                Edit Status
            </a>

        </div>

    </div>

</div>
```

</main>
@endsection
