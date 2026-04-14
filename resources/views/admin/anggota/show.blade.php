{{-- resources/views/admin/anggota/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    {{-- Profile Header --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 mb-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start lg:items-center">
            {{-- Avatar --}}
            <div class="flex-shrink-0">
                @if($anggota->foto)
                    <img src="{{ asset('storage/' . $anggota->foto) }}" 
                         alt="{{ $anggota->nama }}"
                         class="w-28 h-28 lg:w-36 lg:h-36 rounded-2xl object-cover ring-4 ring-gray-100 shadow-md">
                @else
                    <div class="w-28 h-28 lg:w-36 lg:h-36 bg-gray-100 rounded-2xl flex items-center justify-center ring-4 ring-gray-200 shadow-md">
                        <span class="text-2xl font-semibold text-gray-600">
                            {{ substr(strtoupper($anggota->nama), 0, 2) }}
                        </span>
                    </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $anggota->nama }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    {{-- Jabatan --}}
                    <span class="px-4 py-2 bg-emerald-100 text-emerald-800 text-sm font-semibold rounded-lg">
                        {{ ucwords(str_replace('_', ' ', $anggota->jabatan)) }}
                    </span>
                    
                    {{-- Status --}}
                    <span class="px-3 py-1 
                        @if($anggota->status == 'aktif') bg-green-100 text-green-800 
                        @elseif($anggota->status == 'alumni') bg-blue-100 text-blue-800 
                        @else bg-gray-100 text-gray-800 @endif
                        rounded-md text-xs font-medium">
                        {{ ucfirst($anggota->status) }}
                    </span>
                </div>

                {{-- Quick Stats --}}
                <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                    @if($anggota->nim)
                    <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl">
                        <i class="fas fa-id-card text-gray-400"></i>
                        <div>
                            <div class="font-mono text-xs text-gray-500">NIM</div>
                            <div class="font-semibold text-gray-900">{{ $anggota->nim }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if($anggota->no_hp)
                    <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl">
                        <i class="fas fa-phone text-gray-400"></i>
                        <div>
                            <div class="text-xs text-gray-500">Telepon</div>
                            <a href="tel:{{ $anggota->no_hp }}" class="font-semibold text-emerald-600 hover:text-emerald-700">
                                {{ $anggota->no_hp }}
                            </a>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-center gap-2 p-3 bg-gray-50 rounded-xl">
                        <i class="fas fa-calendar text-gray-400"></i>
                        <div>
                            <div class="text-xs text-gray-500">Bergabung</div>
                            <div class="font-semibold text-gray-900">{{ $anggota->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-2">
        {{-- Kontak --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                <i class="fas fa-address-book text-emerald-500"></i>
                Kontak
            </h2>
            <div class="space-y-4">
                <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-envelope text-emerald-600"></i>
                    </div>
                    <div class="flex-1">
                        <div class="font-medium text-gray-700 mb-1">Email</div>
                        <a href="mailto:{{ $anggota->email }}" class="text-emerald-600 hover:text-emerald-700 font-semibold">
                            {{ $anggota->email }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bio --}}
        @if($anggota->bio)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 lg:col-span-2">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-user text-emerald-500"></i>
                Tentang {{ $anggota->nama }}
            </h2>
            <div class="bg-gray-50 p-6 rounded-xl prose prose-sm">
                {!! nl2br(e($anggota->bio)) !!}
            </div>
        </div>
        @endif
    </div>

    {{-- Action Buttons --}}
    <div class="mt-12 bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-wrap gap-3 justify-center lg:justify-end">
        <a href="{{ route('admin.anggota.edit', $anggota->id) }}" 
           class="px-6 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-medium rounded-xl shadow-sm hover:shadow-md transition-all flex items-center gap-2">
            <i class="fas fa-edit"></i>
            Edit
        </a>
        <a href="{{ route('admin.anggota.index') }}" 
           class="px-6 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-xl shadow-sm hover:shadow-md transition-all flex items-center gap-2">
            <i class="fas fa-list"></i>
            Daftar
        </a>
    </div>
</div>
@endsection