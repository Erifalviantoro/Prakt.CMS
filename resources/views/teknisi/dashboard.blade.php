@extends('admin.layout.layout')

@section('content')
<main class="pl-64 pt-16 min-h-screen bg-gray-50">

<div class="p-6">

        <!-- HEADER -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                Dashboard Teknisi
            </h1>

            <p class="text-gray-500">
                Halo, {{ $teknisi->nama }} - kelola pekerjaan Anda
            </p>
        </div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-xl shadow border">
            <p class="text-gray-500 text-sm">Total Pekerjaan</p>
            <h2 class="text-2xl font-bold">{{ $total }}</h2>
        </div>

        <div class="bg-yellow-50 p-4 rounded-xl shadow border">
            <p class="text-yellow-600 text-sm">Antrian</p>
            <h2 class="text-2xl font-bold text-yellow-700">{{ $antrian }}</h2>
        </div>

        <div class="bg-blue-50 p-4 rounded-xl shadow border">
            <p class="text-blue-600 text-sm">Proses</p>
            <h2 class="text-2xl font-bold text-blue-700">{{ $proses }}</h2>
        </div>

        <div class="bg-green-50 p-4 rounded-xl shadow border">
            <p class="text-green-600 text-sm">Selesai</p>
            <h2 class="text-2xl font-bold text-green-700">{{ $selesai }}</h2>
        </div>

    </div>
    <!-- GRID CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($servis as $s)

        <div class="bg-white rounded-xl shadow p-5 border">

            <!-- HEADER CARD -->
            <div class="flex justify-between items-center mb-3">

                <span class="text-sm text-gray-500">
                    Booking #{{ $s->booking_id }}
                </span>

                <!-- STATUS -->
                @if($s->status_servis == 'antrian')
                    <span class="px-3 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                        Antrian
                    </span>
                @elseif($s->status_servis == 'proses')
                    <span class="px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">
                        Proses
                    </span>
                @else
                    <span class="px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                        Selesai
                    </span>
                @endif

            </div>

            <!-- ISI -->
            <h2 class="font-semibold text-gray-800">
                {{ $s->jenis_servis }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                {{ $s->deskripsi ?? 'Tidak ada deskripsi' }}
            </p>

            <!-- INFO TAMBAHAN -->
            <div class="mt-3 text-sm text-gray-600">
                <p><b>Biaya:</b> Rp {{ number_format($s->biaya_jasa, 0, ',', '.') }}</p>
            </div>

            <!-- ACTION BUTTON -->
            <div class="mt-4 flex gap-2">

                @if($s->status_servis == 'antrian')
                <a href="{{ url('/admin/detailservis/mulai/'.$s->id) }}"
                   class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                    Mulai
                </a>
                @endif

                @if($s->status_servis == 'proses')
                <a href="{{ url('/admin/detailservis/selesai/'.$s->id) }}"
                   class="px-3 py-2 bg-green-500 text-white text-sm rounded hover:bg-green-600">
                    Selesai
                </a>
                @endif

            </div>

        </div>

        @endforeach

    </div>

</div>

</main>
@endsection