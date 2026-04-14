{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500">Selamat datang di panel admin HIMAYALA</p>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Artikel --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Artikel</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_artikel'] }}</p>
            </div>
            <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                <i class="fas fa-newspaper text-xl"></i>
            </div>
        </div>
    </div>

    {{-- Total Galeri --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Galeri</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_galeri'] }}</p>
            </div>
            <div class="p-3 bg-purple-100 rounded-xl text-purple-600">
                <i class="fas fa-images text-xl"></i>
            </div>
        </div>
    </div>

    {{-- Total Anggota --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Anggota</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_anggota'] }}</p>
            </div>
            <div class="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>
    </div>

    {{-- Total Kegiatan --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Kegiatan</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_kegiatans'] }}</p>
            </div>
            <div class="p-3 bg-orange-100 rounded-xl text-orange-600">
                <i class="fas fa-mountain text-xl"></i>
            </div>
        </div>
    </div>
</div>

{{-- Charts & Recent Activity --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Chart --}}
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Statistik Kegiatan Tahunan</h3>
        <canvas id="kegiatansChart" height="120"></canvas>
    </div>

    {{-- Recent Activities --}}
    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Aksi Terbaru</h3>
        <div class="space-y-4">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Artikel baru ditambahkan</p>
                    <p class="text-xs text-gray-500">2 jam yang lalu</p>
                </div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <div class="p-2 bg-emerald-100 rounded-lg text-emerald-600">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Anggota baru terdaftar</p>
                    <p class="text-xs text-gray-500">5 jam yang lalu</p>
                </div>
            </div>
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <div class="p-2 bg-purple-100 rounded-lg text-purple-600">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <p class="text-sm font-medium">Foto galeri diupload</p>
                    <p class="text-xs text-gray-500">1 hari yang lalu</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('kegiatansChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Jumlah Kegiatan',
                data: {{ json_encode($chartData) }},
                backgroundColor: 'rgba(16, 185, 129, 0.8)',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: '#f3f4f6' } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endpush