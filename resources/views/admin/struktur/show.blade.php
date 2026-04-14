{{-- resources/views/admin/struktur/show.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Header --}}
    <div class="mb-12">
        <div class="flex items-center gap-6 mb-8">
            @if($struktur->foto)
                <div class="w-28 h-28 rounded-3xl overflow-hidden shadow-2xl ring-4 ring-white/50 bg-gradient-to-br from-orange-400 to-orange-500">
                    <img src="{{ asset('storage/' . $struktur->foto) }}" 
                         alt="{{ $struktur->nama }}" 
                         class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-28 h-28 bg-gradient-to-br from-orange-400 to-orange-500 rounded-3xl flex items-center justify-center shadow-2xl ring-4 ring-white/50">
                    <span class="text-3xl font-black text-white">{{ strtoupper(substr($struktur->nama, 0, 2)) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-5xl font-black bg-gradient-to-r from-gray-900 to-gray-700 bg-clip-text text-transparent">
                    {{ $struktur->nama }}
                </h1>
                <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-bold rounded-2xl shadow-xl mt-4">
                    <i class="fas fa-briefcase mr-2"></i>
                    {{ $struktur->jabatan }}
                </div>
            </div>
        </div>
        <div class="w-32 h-1 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full shadow-md"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-orange-100 p-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center gap-4">
                    <i class="fas fa-info-circle text-orange-500"></i>
                    Tentang {{ $struktur->nama }}
                </h2>
                
                @if($struktur->bio)
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($struktur->bio)) !!}
                    </div>
                @else
                    <div class="text-center py-16">
                        <i class="fas fa-quote-left text-6xl text-gray-300 mb-6"></i>
                        <p class="text-2xl text-gray-500">Belum ada bio</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Sidebar Actions --}}
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-2xl border border-orange-100 p-8 sticky top-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-8">Aksi Cepat</h3>
                
                <div class="space-y-4">
                    <a href="{{ route('admin.struktur.edit', $struktur) }}" 
                       class="w-full block bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white py-5 px-8 rounded-2xl font-bold shadow-xl hover:shadow-2xl focus:ring-4 focus:ring-orange-200 transition-all duration-300 flex items-center justify-center gap-4 transform hover:-translate-y-1">
                        <i class="fas fa-edit text-xl"></i>
                        Edit Profil
                    </a>
                    
                    <a href="{{ route('admin.struktur.index') }}" 
                       class="w-full block bg-gradient-to-r from-gray-100 to-gray-200 hover:from-gray-200 hover:to-gray-300 text-gray-800 py-5 px-8 rounded-2xl font-bold border-2 border-gray-200 hover:border-gray-300 shadow-xl hover:shadow-2xl focus:ring-4 focus:ring-gray-200 transition-all duration-300 flex items-center justify-center gap-4">
                        <i class="fas fa-arrow-left text-xl"></i>
                        Kembali ke Daftar
                    </a>
                    
                    <form action="{{ route('admin.struktur.destroy', $struktur) }}" method="POST" class="w-full"
                          onsubmit="return confirm('Yakin hapus {{ $struktur->nama }}?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white py-5 px-8 rounded-2xl font-bold shadow-xl hover:shadow-2xl focus:ring-4 focus:ring-red-200 transition-all duration-300 flex items-center justify-center gap-4 transform hover:-translate-y-1">
                            <i class="fas fa-trash text-xl"></i>
                            Hapus Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection