{{-- resources/views/admin/anggota/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                        Anggota HIMAYALA
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Kelola data keanggotaan secara terpusat</p>
                </div>
                
                <a href="{{ route('admin.anggota.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Anggota
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Stats Cards (Minimalist) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Total Anggota</p>
                        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $anggotas->total() }}</p>
                    </div>
                    <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                        <i class="fas fa-users text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Aktif</p>
                        <p class="text-2xl font-bold text-sky-600 mt-1">{{ $anggotas->where('status', 'aktif')->count() }}</p>
                    </div>
                    <div class="p-2 bg-sky-50 rounded-lg text-sky-600">
                        <i class="fas fa-check text-sm"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Alumni</p>
                        <p class="text-2xl font-bold text-orange-500 mt-1">{{ $anggotas->where('status', 'alumni')->count() }}</p>
                    </div>
                    <div class="p-2 bg-orange-50 rounded-lg text-orange-500">
                        <i class="fas fa-graduation-cap text-sm"></i>
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
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIM..." class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-gray-50 focus:bg-white transition-colors">
                </div>
                
                <select name="jabatan" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="">Semua Jabatan</option>
                    <option value="ketua" {{ request()->jabatan == 'ketua' ? 'selected' : '' }}>Ketua</option>
                    <option value="waketum" {{ request()->jabatan == 'waketum' ? 'selected' : '' }}>Waketum</option>
                    <option value="sekretaris" {{ request()->jabatan == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                    <option value="peralatan" {{ request()->jabatan == 'peralatan' ? 'selected' : '' }}>Peralatan</option>
                    <option value="bendahara" {{ request()->jabatan == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                    <option value="anggota" {{ request()->jabatan == 'anggota' ? 'selected' : '' }}>Anggota</option>
                    <option value="dokumentasi" {{ request()->jabatan == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>

                </select>

                <select name="status" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request()->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="alumni" {{ request()->status == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="nonaktif" {{ request()->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Anggota
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Jabatan
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Kontak
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($anggotas as $anggota)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="relative">
                                        @if($anggota->foto)
                                        <img src="{{ asset('storage/'.$anggota->foto) }}" class="w-12 h-12 rounded-full object-cover ring-2 ring-gray-100">
                                        @else
                                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-600 font-semibold text-sm">
                                            {{ substr($anggota->nama, 0, 1) }}
                                        </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $anggota->nama }}</p>
                                        <p class="text-xs text-gray-500 font-mono">{{ $anggota->nim }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ ucfirst($anggota->jabatan) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    <p class="mb-1">{{ $anggota->email }}</p>
                                    <p class="text-xs text-gray-400">{{ $anggota->no_hp }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $anggota->status == 'aktif' ? 'bg-sky-50 text-sky-700' : 
                                       ($anggota->status == 'alumni' ? 'bg-orange-50 text-orange-700' : 'bg-gray-100 text-gray-600') }}">
                                    {{ ucfirst($anggota->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.anggota.show', $anggota->id) }}" class="p-2 text-gray-400 hover:text-sky-600 hover:bg-sky-50 rounded-lg transition-colors" title="Lihat Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>
                                    <a href="{{ route('admin.anggota.edit', $anggota->id) }}" class="p-2 text-gray-400 hover:text-orange-600 hover:bg-orange-50 rounded-lg transition-colors" title="Edit Data">
                                        <i class="fas fa-pen-to-square text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.anggota.destroy', $anggota->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-users text-gray-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada data anggota</h3>
                                    <p class="text-sm text-gray-500 mb-4">Mulai dengan menambahkan anggota baru ke sistem.</p>
                                    <a href="{{ route('anggota.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors">
                                        <i class="fas fa-plus mr-2"></i> Tambah Anggota
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination Footer --}}
            @if($anggotas->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $anggotas->links('pagination::tailwind') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection