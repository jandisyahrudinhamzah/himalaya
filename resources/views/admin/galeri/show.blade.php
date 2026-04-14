@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        {{-- Breadcrumb --}}
        <nav class="flex mb-8 backdrop-blur-xl bg-white/60 rounded-3xl px-6 py-4 shadow-xl border border-white/40">
            <ol class="flex items-center space-x-4 text-sm font-bold text-gray-700">
                <li><a href="{{ route('dashboard') }}" class="hover:text-indigo-600 flex items-center"><i class="fas fa-home mr-2"></i>Dashboard</a></li>
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('galeri.index') }}" class="hover:text-indigo-600">Galeri</a></li>
                <li><span class="mx-2">/</span></li>
                <li class="text-gray-900 font-bold">#{{ $galeri->id }}</li>
            </ol>
        </nav>

        {{-- Main Card --}}
        <div class="bg-white/80 backdrop-blur-xl shadow-2xl border border-white/20 rounded-3xl overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-8 py-12">
                <div class="flex flex-col lg:flex-row lg:items-center gap-6">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="p-4 bg-white/20 rounded-3xl backdrop-blur-sm shadow-2xl">
                            <i class="fas fa-image text-white text-3xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl lg:text-5xl font-black text-white leading-tight drop-shadow-2xl">
                                {{ $galeri->judul ?? 'Foto Kegiatan #' . $galeri->id }}
                            </h1>
                            <div class="flex items-center gap-4 mt-4 text-indigo-100">
                                <span class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white font-bold rounded-2xl text-sm shadow-lg">
                                    <i class="fas fa-tag mr-1"></i>{{ $galeri->kategori ?? 'Umum' }}
                                </span>
                                <span class="flex items-center text-lg">
                                    <i class="fas fa-calendar mr-2"></i>{{ $galeri->created_at->format('d M Y, H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-12 lg:p-20">
                {{-- Hero Image --}}
                <div class="mb-16 overflow-hidden rounded-3xl shadow-3xl ring-2 ring-white/50 mx-auto max-w-4xl">
                    <img src="{{ asset('storage/' . $galeri->foto) }}" 
                         alt="{{ $galeri->judul ?? 'Foto kegiatan' }}"
                         class="w-full h-[500px] lg:h-[600px] object-cover hover:scale-105 transition-transform duration-700 rounded-2xl">
                </div>

                {{-- Details Grid --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-black text-gray-800 uppercase tracking-wide mb-4">Kategori</label>
                            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold rounded-3xl shadow-2xl">
                                <i class="fas fa-hashtag mr-2"></i>
                                {{ ucfirst($galeri->kategori ?? 'Umum') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-black text-gray-800 uppercase tracking-wide mb-4">Uploaded</label>
                            <p class="text-2xl font-black text-gray-900">{{ $galeri->created_at->format('d F Y, H:i') }}</p>
                            <p class="text-lg text-gray-600 mt-1">{{ $galeri->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-black text-gray-800 uppercase tracking-wide mb-4">File</label>
                            <div class="flex items-center gap-4 p-6 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200">
                                <i class="fas fa-image text-3xl text-indigo-500"></i>
                                <div>
                                    <p class="font-bold text-lg text-gray-900">{{ basename($galeri->foto) }}</p>
                                    <p class="text-sm text-gray-600">galeri/{{ $galeri->foto }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col lg:flex-row gap-6 pt-16 border-t-4 border-indigo-100/50">
                    <a href="{{ route('galeri.edit', $galeri->id) }}"
                       class="group flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-black py-5 px-10 rounded-3xl shadow-3xl hover:shadow-4xl hover:-translate-y-2 transition-all duration-500 text-xl flex items-center justify-center gap-3 border border-white/20">
                        <i class="fas fa-edit text-2xl group-hover:rotate-180 transition-transform duration-300"></i>
                        Edit Foto
                    </a>
                    
                    <a href="{{ route('galeri.index') }}"
                       class="group flex-1 lg:w-auto bg-white hover:bg-gray-50 border-2 border-gray-200 hover:border-gray-300 text-gray-900 font-black py-5 px-10 rounded-3xl shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 text-xl flex items-center justify-center gap-3">
                        <i class="fas fa-arrow-left text-2xl group-hover:-translate-x-2 transition-transform"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection