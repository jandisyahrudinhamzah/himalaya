{{-- resources/views/admin/artikel/index.blade.php --}}
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
                            <i class="fas fa-newspaper text-white text-lg"></i>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                            Artikel HIMAYALA
                        </h1>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Kelola konten dan artikel organisasi</p>
                </div>
                
                <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Tulis Artikel
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Total Artikel</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $artikels->total() }}</p>
                    </div>
                    <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                        <i class="fas fa-newspaper text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Published</p>
                        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $artikels->where('status', 'published')->count() }}</p>
                    </div>
                    <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Draft</p>
                        <p class="text-2xl font-bold text-yellow-600 mt-1">{{ $artikels->where('status', 'draft')->count() }}</p>
                    </div>
                    <div class="p-2 bg-yellow-50 rounded-lg text-yellow-600">
                        <i class="fas fa-pen text-sm"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filter & Search Toolbar --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 mb-6">
            <form method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-gray-50 focus:bg-white transition-colors">
                </div>
                
                <select name="status" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request()->status == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request()->status == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Judul Artikel
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Gambar
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($artikels as $key => $artikel)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-500 font-medium">{{ $key + 1 }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-gray-900 text-sm">{{ $artikel->judul }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $artikel->slug }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($artikel->gambar)
                                <img src="{{ asset('storage/'.$artikel->gambar) }}" class="w-16 h-12 object-cover rounded-lg shadow-sm">
                                @else
                                <div class="w-16 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-sm"></i>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    {{ $artikel->status == 'published' ? 'bg-emerald-50 text-emerald-700' : 'bg-yellow-50 text-yellow-700' }}">
                                    {{ ucfirst($artikel->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600">{{ $artikel->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-400">{{ $artikel->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.artikel.show', $artikel->id) }}" class="p-2 text-gray-400 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}" class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Edit Artikel">
                                        <i class="fas fa-pen-to-square text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.artikel.destroy', $artikel->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-newspaper text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada artikel</h3>
                                    <p class="text-sm text-gray-500 mb-4">Mulai dengan membuat artikel baru untuk HIMAYALA.</p>
                                    <a href="{{ route('artikel.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                                        <i class="fas fa-plus mr-2"></i> Tulis Artikel
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Footer --}}
            @if($artikels->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $artikels->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection