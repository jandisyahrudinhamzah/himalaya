{{-- resources/views/admin/kegiatans/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div class="p-2 bg-gray-900 rounded-lg">
                            <i class="fas fa-layer-group text-white text-lg"></i>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                            Program Kegiatan
                        </h1>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Kelola agenda dan kegiatan HIMAYALA secara terpusat</p>
                </div>
                
                <a href="{{ route('admin.kegiatans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Kegiatan Baru
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Quick Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Total Kegiatan</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $kegiatans->total() }}</p>
                    </div>
                    <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                        <i class="fas fa-list text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Upcoming</p>
                        <p class="text-2xl font-bold text-sky-600 mt-1">{{ $kegiatans->where('status', 'Upcoming')->count() }}</p>
                    </div>
                    <div class="p-2 bg-sky-50 rounded-lg text-sky-600">
                        <i class="fas fa-clock text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Ongoing</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $kegiatans->where('status', 'Ongoing')->count() }}</p>
                    </div>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <i class="fas fa-fire text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="bg-white p-1.5 rounded-xl shadow-sm border border-gray-200 inline-flex w-full sm:w-auto">
                <a href="{{ route('admin.kegiatans.index') }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-all {{ !request()->status ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Semua</a>
                <a href="{{ route('admin.kegiatans.index', ['status' => 'Upcoming']) }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->status == 'Upcoming' ? 'bg-sky-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Upcoming</a>
                <a href="{{ route('admin.kegiatans.index', ['status' => 'Ongoing']) }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->status == 'Ongoing' ? 'bg-orange-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Ongoing</a>
                <a href="{{ route('admin.kegiatans.index', ['status' => 'Selesai']) }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->status == 'Selesai' ? 'bg-gray-700 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Selesai</a>
            </div>
            
            {{-- Search Bar --}}
            <div class="relative w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 text-sm"></i>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-gray-50 focus:bg-white transition-colors" placeholder="Cari kegiatan...">
            </div>
        </div>

        {{-- Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kegiatans as $kegiatan)
            <div class="group bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200 flex flex-col h-full">
                
                {{-- Image Area --}}
                <div class="relative h-48 overflow-hidden">
                    @if($kegiatan->foto)
                    <img src="{{ asset('storage/'.$kegiatan->foto) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <i class="fas fa-mountain text-4xl text-gray-400"></i>
                    </div>
                    @endif
                    
                    {{-- Status Badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                            {{ $kegiatan->status == 'Upcoming' ? 'bg-sky-100 text-sky-700' : 
                               ($kegiatan->status == 'Ongoing' ? 'bg-orange-100 text-orange-700' : 'bg-gray-100 text-gray-600') }}">
                            {{ $kegiatan->status }}
                        </span>
                    </div>
                </div>

                {{-- Content Body --}}
                <div class="p-5 flex-1 flex flex-col">
                    <h3 class="font-bold text-lg text-gray-900 mb-3 line-clamp-2 group-hover:text-sky-600 transition-colors">
                        {{ $kegiatan->judul }}
                    </h3>
                    
                    {{-- Meta Info --}}
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-calendar-alt text-gray-400 w-5 text-sm"></i>
                            <span>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-gray-400 w-5 text-sm"></i>
                            <span class="truncate">{{ $kegiatan->lokasi }}</span>
                        </div>
                        @if($kegiatan->kuota)
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-users text-gray-400 w-5 text-sm"></i>
                            <span>Kuota: {{ $kegiatan->kuota }} orang</span>
                        </div>
                        @endif
                    </div>

                    <p class="text-gray-500 text-sm line-clamp-3 mb-4 flex-1 leading-relaxed">
                        {{ $kegiatan->deskripsi }}
                    </p>

                    {{-- Actions Footer --}}
                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between gap-2">
                        <a href="{{ route('admin.kegiatans.show', $kegiatan->id) }}" class="flex-1 text-center px-3 py-2 bg-gray-50 hover:bg-sky-50 text-gray-700 hover:text-sky-700 font-medium rounded-lg text-sm transition-colors">
                            Lihat Detail
                        </a>
                        
                        <div class="flex gap-1">
                            <a href="{{ route('admin.kegiatans.edit', $kegiatan->id) }}" class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 hover:border-orange-500 hover:text-orange-600 text-gray-600 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-pen-to-square text-sm"></i>
                            </a>
                            <form action="{{ route('admin.kegiatans.destroy', $kegiatan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-9 h-9 flex items-center justify-center bg-white border border-gray-200 hover:border-red-500 hover:text-red-600 text-gray-600 rounded-lg transition-colors" title="Hapus">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-xl border border-dashed border-gray-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                        <i class="fas fa-folder-open text-2xl text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada kegiatan</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan membuat program kerja baru untuk HIMAYALA.</p>
                    <a href="{{ route('kegiatans.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i> Buat Kegiatan Sekarang
                    </a>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($kegiatans->hasPages())
        <div class="mt-8 flex justify-center">
            {{ $kegiatans->links('pagination::tailwind') }}
        </div>
        @endif

    </div>
</div>
@endsection