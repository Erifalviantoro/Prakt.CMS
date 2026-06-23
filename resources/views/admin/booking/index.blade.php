@extends('admin.layout.layout')

@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="flex-1 p-margin-desktop">

        <!-- Header -->
        <div>
                <nav class="flex items-center gap-2 text-outline mb-2 font-label-sm text-label-sm">
                    <a class="hover:text-primary" href="#">Dashboard</a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-on-surface-variant font-semibold">Manajemen Booking</span>
                </nav>
                <h2 class="font-headline-lg text-headline-lg font-bold text-primary">Manajemen Booking</h2>
                <p class="text-on-surface-variant mt-1">Kelola dan pantau seluruh data booking bengkel Sumber Baru Motor.</p>
            </div>

        <!-- Statistik -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-4xl text-primary">
                        event_note
                    </span>

                    <div>
                        <p>Total Booking</p>
                        <h3 class="text-2xl font-bold">
                            {{ $totalBooking }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-4xl text-amber-600">
                        pending_actions
                    </span>

                    <div>
                        <p>Menunggu</p>
                        <h3 class="text-2xl font-bold">
                            {{ $bookingMenunggu }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-4xl text-green-600">
                        check_circle
                    </span>

                    <div>
                        <p>Dikonfirmasi</p>
                        <h3 class="text-2xl font-bold">
                            {{ $bookingDikonfirmasi }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">
                    <span class="material-symbols-outlined text-4xl text-blue-600">
                        today
                    </span>

                    <div>
                        <p>Hari Ini</p>
                        <h3 class="text-2xl font-bold">
                            {{ $bookingHariIni }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">

                    <span class="material-symbols-outlined text-4xl text-green-700">
                        task_alt
                    </span>

                    <div>
                        <p>Selesai</p>
                        <h3 class="text-2xl font-bold">
                            {{ $bookingSelesai }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="flex items-center gap-4">

                    <span class="material-symbols-outlined text-4xl text-red-600">
                        cancel
                    </span>

                    <div>
                        <p>Dibatalkan</p>
                        <h3 class="text-2xl font-bold">
                            {{ $bookingDibatalkan }}
                        </h3>
                    </div>

                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="bg-white p-4 rounded-xl border shadow-sm mb-6">

            <div class="flex flex-col md:flex-row gap-4">

                <input type="text"
                       placeholder="Cari pelanggan..."
                       class="flex-1 border rounded-lg px-4 py-3">

                <select class="border rounded-lg px-4 py-3">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Dikonfirmasi</option>
                    <option>Selesai</option>
                    <option>Dibatalkan</option>
                </select>

            </div>

        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">

            <table class="w-full">

                <thead class="bg-primary text-white">

                    <tr>
                        <th class="px-6 py-4 text-left">Kode</th>
                        <th class="px-6 py-4 text-left">Pelanggan</th>
                        <th class="px-6 py-4 text-left">Kendaraan</th>
                        <th class="px-6 py-4 text-left">Tanggal</th>
                        <th class="px-6 py-4 text-left">Keluhan</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                    <tr class="border-b">

                        <td class="px-6 py-4">
                            BK-{{ str_pad($booking->id,4,'0',STR_PAD_LEFT) }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $booking->pelanggan->nama }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $booking->kendaraan->nomor_plat }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $booking->tanggal_booking }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $booking->keluhan }}
                        </td>

                        <td class="px-6 py-4">

                                                        @php
                            $warna = match($booking->status) {
                                'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                'Dikonfirmasi' => 'bg-blue-100 text-blue-700',
                                'Diproses' => 'bg-purple-100 text-purple-700',
                                'Selesai' => 'bg-green-100 text-green-700',
                                'Dibatalkan' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-700'
                            };
                            @endphp

                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $warna }}">
                                {{ $booking->status }}
                            </span>

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('admin.booking.show',$booking->id) }}">
                                    <span class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </a>

                                <a href="{{ route('admin.booking.edit',$booking->id) }}">
                                    <span class="material-symbols-outlined">
                                        edit
                                    </span>
                                </a>


                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center py-6">
                            Data booking belum tersedia
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
</main>
@endsection