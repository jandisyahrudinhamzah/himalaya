{{-- resources/views/admin/struktur/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Struktur Organisasi')

@section('content')
<div class="space-y-8">
    
    {{-- Header --}}
    <div class="bg-white rounded-3xl shadow-lg border border-gray-200 p-8">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-3">Struktur Organisasi</h1>
                <p class="text-lg text-gray-600">Kelola pengurus HIMALAYA</p>
            </div>
            <a href="{{ route('admin.struktur.create') }}" 
               class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Tambah Pengurus
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Total</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $data->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-users text-emerald-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Ketua</p>
                    <p class="text-3xl font-bold text-emerald-600">{{ $data->where('jabatan', 'ketua')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-crown text-emerald-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:shadow-md transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-gray-600 uppercase tracking-wide mb-2">Aktif</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $data->where('status', 'aktif')->count() }}</p>
                </div>
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
        <form method="GET" class="flex flex-col lg:flex-row gap-4 items-end">
            <div class="flex-1 relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari nama atau jabatan..."
                       class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            </div>
            <select name="jabatan" class="flex-1 px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500">
                <option value="">Semua Jabatan</option>
                <option value="ketua" {{ request('jabatan') == 'ketua' ? 'selected' : '' }}>Ketua</option>
                <option value="waketum" {{ request('jabatan') == 'waketum' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="sekretaris" {{ request('jabatan') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="bendahara" {{ request('jabatan') == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
            </select>
            <button type="submit" class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pengurus</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Jabatan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($data as $struktur)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                @if($struktur->foto)
                                    <img src="{{ asset('storage/' . $struktur->foto) }}" 
                                         class="w-12 h-12 rounded-xl object-cover ring-2 ring-gray-200" alt="">
                                @else
                                    <div class="w-12 h-12 bg-gray-200 rounded-xl flex items-center justify-center text-xs font-semibold text-gray-600">
                                        {{ substr($struktur->nama, 0, 2) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $struktur->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $struktur->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-semibold rounded-full">
                                {{ ucwords(str_replace('_', ' ', $struktur->jabatan)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 
                                @if($struktur->status == 'aktif') bg-green-100 text-green-800 
                                                                @elseif($struktur->status == 'alumni') bg-blue-100 text-blue-800 
                                @else bg-gray-100 text-gray-800 @endif
                                text-xs font-semibold rounded-full">
                                {{ ucfirst($struktur->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.struktur.edit', $struktur) }}" 
                               class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.struktur.destroy', $struktur) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus {{ $struktur->nama }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="py-12">
                                <div class="w-24 h-24 bg-gray-100 rounded-2xl mx-auto flex items-center justify-center mb-4">
                                    <i class="fas fa-users text-3xl text-gray-400"></i>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum ada pengurus</h3>
                                <p class="text-gray-500 mb-6">Mulai tambahkan struktur organisasi</p>
                                <a href="{{ route('admin.struktur.create') }}" 
                                   class="inline-flex items-center px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($data->hasPages())
        <div class="px-6 py-6 bg-gray-50 border-t border-gray-200">
            {{ $data->appends(request()->query())->links() }}
        </div>
        @endif
    </div>

</div>
@endsection