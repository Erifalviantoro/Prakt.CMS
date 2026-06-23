@extends('admin.layout.layout')
@section('content')
<main class="ml-64 min-h-screen flex flex-col">

    @include('admin.layout.header')

    <div class="px-8 pt-6">
        <a href="{{ route('admin.mekanik.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-surface-container rounded-lg border border-outline-variant hover:bg-surface-container-high transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            Kembali
        </a>
    </div>

    <div class="p-8 flex-1">
        <div class="max-w-container-max-width mx-auto">
            
            <div class="grid grid-cols-12 gap-6 mb-6">
                
                <div class="col-span-12 lg:col-span-4 bg-surface-container-lowest rounded-xl p-8 border border-outline-variant shadow-sm flex flex-col items-center text-center">
                    <div class="relative mb-6">
                        <div class="w-32 h-32 rounded-full border-4 border-primary p-1">
                            <img alt="Technician Profile" class="w-full h-full rounded-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD344wYEP9iuXQNVu9prAzuUtZnPaRd6bLFRADLdhZTjTUOzsryYMWMmLgLTZO8ZtETkksOP_eQgYtpZCXq5-uQcY-YwdkqF4OwTGcNF7m-kEoo75gk9djvBO0Ta2ihZY48k2-AaHQ73qvtICn-FJCyOSl6DYaFdwFcdVj4UR-_or4HRhoH8HeMq0Z6ufksoAGwloRBJsocUNpHH-4j8ZhBCTznRZ2NYfFBx6MNHpxahNnW5TlpcFGPkT0ciH_sYPUqOpb-PSK7k6_k"/>
                        </div>
                        <span class="absolute bottom-1 right-1 bg-green-500 w-6 h-6 rounded-full border-4 border-white" title="Active Now"></span>
                    </div>
                    
                    <h3 class="font-headline-md text-headline-md font-bold text-primary mb-1">
                        {{ $teknisi->nama }}
                    </h3>
                    <p class="font-label-md text-label-md text-on-surface-variant mb-4">
                        {{ $teknisi->spesialisasi }}
                    </p>
                    <div class="flex items-center gap-2 mb-6">
                        <span class="px-3 py-1 bg-primary text-on-primary rounded-full text-label-sm">ID: SBM-TEC-{{ str_pad($teknisi->id, 4, '0', STR_PAD_LEFT) }}</span>
                        <span class="px-3 py-1 bg-surface-container-high text-on-surface-variant rounded-full text-label-sm">Joined May 2020</span>
                    </div>
                    
                    <div class="w-full grid grid-cols-2 gap-3 pt-6 border-t border-outline-variant">
                        <a href="{{ route('admin.mekanik.edit', $teknisi->id) }}"
                           class="py-2 bg-primary text-on-primary rounded-lg font-label-md hover:brightness-110 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">edit</span>
                            Edit Profil
                        </a>
                        <button class="py-2 border border-primary text-primary rounded-lg font-label-md hover:bg-primary/5 transition-all active:scale-95 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-base">mail</span> 
                            Message
                        </button>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-8 flex flex-col gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="stats-card-gradient rounded-xl p-6 text-white shadow-xl flex flex-col justify-between h-40">
                            <div class="flex justify-between items-start">
                                <span class="material-symbols-outlined p-2 bg-white/10 rounded-lg">build</span>
                                <span class="text-label-sm bg-green-500/20 text-green-300 px-2 py-0.5 rounded-full">+12% MoM</span>
                            </div>
                            <div>
                                <p class="text-4xl font-bold font-headline-xl">1,284</p>
                                <p class="font-label-md opacity-80">Total Jobs Completed</p>
                            </div>
                        </div>
                        
                        <div class="bg-white rounded-xl p-6 border border-outline-variant shadow-sm flex flex-col justify-between h-40">
                            <div class="flex justify-between items-start">
                                <span class="material-symbols-outlined p-2 bg-primary/10 text-primary rounded-lg">star</span>
                                <div class="flex gap-0.5">
                                    <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 1;">star</span>
                                    <span class="material-symbols-outlined text-yellow-400 text-sm" style="font-variation-settings: 'FILL' 0;">star</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-4xl font-bold font-headline-xl text-primary">4.8</p>
                                <p class="font-label-md text-on-surface-variant">Avg. Customer Rating</p>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl p-6 border border-outline-variant shadow-sm flex flex-col justify-between h-40">
                            <div class="flex justify-between items-start">
                                <span class="material-symbols-outlined p-2 bg-secondary/10 text-secondary rounded-lg">check_circle</span>
                                <span class="text-label-sm bg-blue-500/10 text-blue-600 px-2 py-0.5 rounded-full">Top Performer</span>
                            </div>
                            <div>
                                <p class="text-4xl font-bold font-headline-xl text-primary">99.2%</p>
                                <p class="font-label-md text-on-surface-variant">Service Success Rate</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-surface-container-lowest rounded-xl p-8 border border-outline-variant shadow-sm flex-1">
                        <h4 class="font-headline-md text-headline-md font-bold text-primary mb-6">Informasi Teknisi</h4>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-on-surface-variant">Nama</p>
                                <p class="font-bold">{{ $teknisi->nama }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-on-surface-variant">Spesialisasi</p>
                                <p class="font-bold">{{ $teknisi->spesialisasi }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-on-surface-variant">Nomor Telepon</p>
                                <p class="font-bold">{{ $teknisi->nomor_telepon }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-on-surface-variant">Alamat</p>
                                <p>{{ $teknisi->alamat }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-on-surface-variant">Tanggal Dibuat</p>
                                <p>{{ $teknisi->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden mb-8">
                <div class="px-8 py-6 border-b border-outline-variant flex flex-col md:flex-row justify-between items-center gap-4">
                    <div>
                        <h4 class="font-headline-md text-headline-md font-bold text-primary">Daftar Servis Terbaru</h4>
                        <p class="font-body-md text-body-md text-on-surface-variant">Riwayat pengerjaan 10 order terakhir</p>
                    </div>
                    <div class="flex gap-2">
                        <select class="rounded-lg border-outline-variant text-label-md py-2 px-4 focus:ring-primary focus:border-primary">
                            <option>All Months</option>
                            <option>October 2024</option>
                            <option>September 2024</option>
                        </select>
                        <button class="px-4 py-2 bg-surface-container-high text-on-surface font-label-md rounded-lg hover:bg-surface-container-highest transition-colors">
                            Export CSV
                        </button>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-primary text-on-primary">
                            <tr>
                                <th class="px-8 py-4 font-label-md text-label-md">Order ID</th>
                                <th class="px-8 py-4 font-label-md text-label-md">Date</th>
                                <th class="px-8 py-4 font-label-md text-label-md">Vehicle</th>
                                <th class="px-8 py-4 font-label-md text-label-md">Service Type</th>
                                <th class="px-8 py-4 font-label-md text-label-md">Status</th>
                                <th class="px-8 py-4 font-label-md text-label-md text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant">
                            <tr class="hover:bg-surface-container-low transition-colors group">
                                <td class="px-8 py-5 font-label-md font-bold text-primary">#WO-9821</td>
                                <td class="px-8 py-5 text-on-surface-variant">24 Oct 2024, 09:15</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-on-surface-variant">motorcycle</span>
                                        <div>
                                            <p class="font-label-md font-bold text-on-surface">Yamaha MT-25</p>
                                            <p class="text-xs text-on-surface-variant">B 1234 ABC</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-xs font-bold uppercase">Engine Overhaul</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="text-label-md text-on-surface">Completed</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-secondary font-label-md hover:underline active:scale-95 transition-transform">Details</button>
                                </td>
                            </tr>
                            <tr class="bg-surface-container-low/30 hover:bg-surface-container-low transition-colors group">
                                <td class="px-8 py-5 font-label-md font-bold text-primary">#WO-9815</td>
                                <td class="px-8 py-5 text-on-surface-variant">23 Oct 2024, 14:30</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-on-surface-variant">motorcycle</span>
                                        <div>
                                            <p class="font-label-md font-bold text-on-surface">Yamaha NMAX 155</p>
                                            <p class="text-xs text-on-surface-variant">D 4567 XYZ</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-xs font-bold uppercase">Periodic Service</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                        <span class="text-label-md text-on-surface">Completed</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-secondary font-label-md hover:underline active:scale-95 transition-transform">Details</button>
                                </td>
                            </tr>
                            <tr class="hover:bg-surface-container-low transition-colors group">
                                <td class="px-8 py-5 font-label-md font-bold text-primary">#WO-9810</td>
                                <td class="px-8 py-5 text-on-surface-variant">23 Oct 2024, 10:00</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-on-surface-variant">motorcycle</span>
                                        <div>
                                            <p class="font-label-md font-bold text-on-surface">Yamaha XSR 155</p>
                                            <p class="text-xs text-on-surface-variant">F 9012 DEF</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-xs font-bold uppercase">Electrical Check</span>
                                end</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 bg-secondary rounded-full"></span>
                                        <span class="text-label-md text-on-surface">Pending</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-secondary font-label-md hover:underline active:scale-95 transition-transform">Details</button>
                                </td>
                            </tr>
                            <tr class="bg-surface-container-low/30 hover:bg-surface-container-low transition-colors group">
                                <td class="px-8 py-5 font-label-md font-bold text-primary">#WO-9799</td>
                                <td class="px-8 py-5 text-on-surface-variant">22 Oct 2024, 16:45</td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-on-surface-variant">motorcycle</span>
                                        <div>
                                            <p class="font-label-md font-bold text-on-surface">Yamaha R25</p>
                                            <p class="text-xs text-on-surface-variant">B 8888 SBM</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed-variant rounded-full text-xs font-bold uppercase">Brake System</span>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                                        <span class="text-label-md text-on-surface">In Progress</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5 text-right">
                                    <button class="text-secondary font-label-md hover:underline active:scale-95 transition-transform">Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="px-8 py-4 bg-surface-container-low flex justify-between items-center">
                    <p class="text-label-sm text-on-surface-variant">Showing 4 of 1,284 service records</p>
                    <div class="flex gap-1">
                        <button class="p-2 bg-white border border-outline-variant rounded hover:bg-surface-container-high transition-colors"><span class="material-symbols-outlined text-base">chevron_left</span></button>
                        <button class="p-2 bg-primary text-on-primary rounded">1</button>
                        <button class="p-2 bg-white border border-outline-variant rounded hover:bg-surface-container-high transition-colors">2</button>
                        <button class="p-2 bg-white border border-outline-variant rounded hover:bg-surface-container-high transition-colors">3</button>
                        <button class="p-2 bg-white border border-outline-variant rounded hover:bg-surface-container-high transition-colors"><span class="material-symbols-outlined text-base">chevron_right</span></button>
                    </div>
                </div>
            </section>

        </div>
    </div>
</main>
@endsection