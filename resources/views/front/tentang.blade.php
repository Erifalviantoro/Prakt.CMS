@extends('front.layout.app')

@section('title', 'Tentang')

@section('content')
<main class="overflow-x-hidden w-full"> <section class="bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 h-[500px] flex items-center justify-center text-center px-4">
        <div class="max-w-3xl">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Dedikasi Performa Terbaik Sejak 1982</h1>
            <p class="text-lg text-white/80 max-w-2xl mx-auto">Membangun kepercayaan melalui kualitas layanan dan integritas dalam dunia otomotif roda dua di Indonesia.</p>
        </div>
    </section>

    <section class="py-24 px-4 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-7 space-y-8">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Tentang Kami</h2>
                <p class="text-slate-600 leading-relaxed text-lg">
                    Sumber Baru Motor lahir dari visi sederhana untuk menyediakan solusi transportasi yang handal dan layanan purna jual yang unggul. Selama lebih dari empat dekade, kami telah bertransformasi dari bengkel lokal menjadi salah satu jaringan dealer dan pusat servis terkemuka.
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Warisan</h3>
                        <p class="text-slate-600">42 tahun pengalaman mendalam dalam perawatan dan distribusi sepeda motor.</p>
                    </div>
                    <div class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Integritas</h3>
                        <p class="text-slate-600">Menjunjung tinggi transparansi dalam setiap transaksi dan perbaikan mekanis.</p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-5 h-[400px] rounded-2xl overflow-hidden relative group shadow-lg">
                <div class="absolute inset-0 bg-slate-900/40 z-10"></div>
                <img alt="Team professional" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqx659opeKQ_g7cv9n3O7kyC2NKBjJpZwrIWJXRQVxto4s1NblHtJX2Y7wInsdg10Iwnb8lRWEfPcG10z6tBBH9Vqh7aqL-1SFU5pEZxZZ3492HO2YFMtgXVm-yFFz56x7Yk2067GAd-5P-0FChFRfNtamKjdhAOJ03JTdMO29GHUong39WUzqhAVKFTJ-M5qHl_9tsfnWb6XurtYfG6gRycTQDpelr1YxS3447yriEvXd6GXzWkIR8lSJCX4F8SFOQl61xL0gs2va">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent flex items-end p-8 z-20">
                    <p class="text-white text-xl italic">"Mesin yang sehat adalah janji kami kepada setiap pengendara."</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-900 py-24 px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-12">
                <div>
                    <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-4">
                        <span class="w-12 h-1 bg-amber-500 inline-block"></span> Visi Kami
                    </h2>
                    <p class="text-xl text-slate-300 leading-relaxed font-light">
                        Menjadi mitra otomotif terpercaya nomor satu di Indonesia yang mengedepankan inovasi teknologi dan kepuasan pelanggan yang berkelanjutan.
                    </p>
                </div>
                <div class="space-y-6">
                    <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-4">
                        <span class="w-12 h-1 bg-amber-500 inline-block"></span> Misi Kami
                    </h2>
                    <ul class="space-y-4">
                        <li class="flex gap-4 text-slate-300">
                            <span class="text-amber-500">✓</span>
                            <span>Memberikan layanan servis berstandar pabrikan dengan teknisi bersertifikat.</span>
                        </li>
                        <li class="flex gap-4 text-slate-300">
                            <span class="text-amber-500">✓</span>
                            <span>Menyediakan suku cadang asli untuk menjamin keamanan dan kenyamanan berkendara.</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="h-80 bg-slate-800 rounded-2xl overflow-hidden shadow-2xl">
                <img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJv7I41f-3IR3R0WXOzgdQAqcWi-57IuE3DsEciKbT1Y8vfxdJexrFuiX9cayLI9oh8z3OX9b1hIY9-7v65HdulDqkkkMtc5iS4jW0bNW2Kat2c1WVog3U19qLjFzNN1PWBCsMv6cONGJiMwjdeQNomtgqxg-am2evHxsZgehTW_omEuK8LFoU3pFay9ePu_VPNubSZ4T_VMYsDa0o8O0nL-7714dYmTnbo3ulakRKD4cDXOlW53t6Re5D6sFKYrh79NXf2PBmp1YN">
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Pencapaian Kami</h2>
                <p class="text-slate-600">Kepercayaan pelanggan yang telah kami bangun selama puluhan tahun.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-8 rounded-xl text-center shadow-sm border border-slate-100">
                    <h3 class="text-4xl font-bold text-amber-500 mb-2">{{ $totalBooking ?? '10.000+' }}</h3>
                    <p class="text-slate-600">Motor Diservis</p>
                </div>
                <div class="bg-white p-8 rounded-xl text-center shadow-sm border border-slate-100">
                    <h3 class="text-4xl font-bold text-amber-500 mb-2">{{ $totalPelanggan ?? '5.000+' }}</h3>
                    <p class="text-slate-600">Pelanggan Aktif</p>
                </div>
                <div class="bg-white p-8 rounded-xl text-center shadow-sm border border-slate-100">
                    <h3 class="text-4xl font-bold text-amber-500 mb-2">{{ $totalMekanik ?? '15+' }}</h3>
                    <p class="text-slate-600">Mekanik Profesional</p>
                </div>
                <div class="bg-white p-8 rounded-xl text-center shadow-sm border border-slate-100">
                    <h3 class="text-4xl font-bold text-amber-500 mb-2">42</h3>
                    <p class="text-slate-600">Tahun Pengalaman</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Mengapa Memilih Kami?</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-3">Sparepart Original</h3>
                    <p class="text-slate-600">Menggunakan suku cadang asli dan berkualitas tinggi.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-3">Harga Transparan</h3>
                    <p class="text-slate-600">Tidak ada biaya tersembunyi dalam setiap layanan servis kami.</p>
                </div>
                <div class="bg-slate-50 p-8 rounded-xl shadow-sm border border-slate-100">
                    <h3 class="font-bold text-slate-900 mb-3">Garansi Servis</h3>
                    <p class="text-slate-600">Memberikan jaminan kualitas hasil pengerjaan mekanik kami.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<script>
    // Simple scroll interaction for header
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (header) {
            if (window.scrollY > 20) {
                header.classList.add('shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
            } else {
                header.classList.remove('shadow-lg', 'bg-white/95', 'backdrop-blur-sm');
            }
        }
    });
</script>
@endsection