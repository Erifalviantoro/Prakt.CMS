<!DOCTYPE html>
<html class="light" lang="id">
    <head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sumber Baru Motor | Repair Management System</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script id="tailwind-config"> ... </script>

    <style> ... </style>

    @include('admin.layout.script')
    @include('admin.layout.style')
    
    </head>
    <body class="bg-background text-on-surface">
        <!-- Dashboard Layout Wrapper -->
<div class="flex min-h-screen">
        
    @include('admin.layout.sidebar')

    <div class="flex-1 flex flex-col min-w-0">

        @yield('content')

        @include('admin.layout.footer')
        
    </div>
</div>
        <!-- Floating Action Button (Optional contextual) -->
        <script>
            // Revenue Chart Configuration
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Revenue (dalam Juta)',
                        data: [85, 92, 110, 105, 128, 142],
                        borderColor: '#041627',
                        backgroundColor: 'rgba(4, 22, 39, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3
                    }, {
                        label: 'Jumlah Booking',
                        data: [420, 480, 510, 490, 580, 620],
                        borderColor: '#b7102a',
                        backgroundColor: 'transparent',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        yAxisID: 'y1',
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top', labels: { font: { family: 'Inter', weight: 'bold' } } } },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false } },
                        y1: { position: 'right', beginAtZero: true, grid: { display: false } }
                    }
                }
            });
            
            // Service Chart Configuration
            const ctxService = document.getElementById('serviceChart').getContext('2d');
            new Chart(ctxService, {
                type: 'doughnut',
                data: {
                    labels: ['Servis Rutin', 'Ganti Oli', 'Tune Up', 'Lainnya'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: ['#041627', '#b7102a', '#38485a', '#e1e3e4'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: { legend: { display: false } }
                }
            });
        </script>
    </body>
</html>