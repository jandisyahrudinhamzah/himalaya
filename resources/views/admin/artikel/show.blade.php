@extends('layouts.admin')

@section('title', 'Detail Artikel - ' . $artikel->judul)

@section('content')
<!-- Premium Header -->
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-indigo-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        
        <!-- Breadcrumb Premium -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm font-medium text-gray-500">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </li>
                <li>
                    <a href="{{ route('admin.artikel.index') }}" class="hover:text-indigo-600 transition-colors">
                        Artikel
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </li>
                <li class="text-gray-900 font-semibold">{{ Str::limit($artikel->judul, 30) }}</li>
            </ol>
        </nav>

        <!-- Main Card Premium -->
        <div class="bg-white/80 backdrop-blur-xl shadow-2xl border border-white/20 rounded-3xl overflow-hidden">
            
            <!-- Header Glassmorphism -->
            <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-indigo-700 px-8 py-8 md:py-12">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-2">
                            {{ $artikel->judul }}
                        </h1>
                        <div class="flex items-center space-x-4 text-indigo-100">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 backdrop-blur-sm ring-1 ring-white/30">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    @if($artikel->status === 'published')
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    @else
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    @endif
                                </svg>
                                {{ $artikel->status }}
                            </span>
                            <span class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $artikel->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-indigo-100 text-sm">Oleh: {{ $artikel->user->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12 lg:p-16">
                
                <!-- Featured Image -->
                @if($artikel->gambar)
                <div class="mb-12 overflow-hidden rounded-2xl shadow-xl ring-1 ring-black/5">
                    <img src="{{ asset('storage/' . $artikel->gambar) }}" 
                         alt="{{ $artikel->judul }}" 
                         class="w-full h-[400px] md:h-[500px] object-cover hover:scale-105 transition-transform duration-1000">
                </div>
                @endif

                <!-- Content Premium -->
                <div class="prose prose-lg md:prose-xl prose-headings:font-bold prose-headings:text-gray-900 prose-a:text-indigo-600 max-w-none mb-12">
                    {!! $artikel->konten !!}
                </div>

                <!-- Meta Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 p-8 rounded-2xl border border-indigo-100 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 11H4l1-1h7.414l-1.707 1.707A1 1 0 0010.586 16z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h4 class="ml-4 text-xl font-bold text-gray-900">Slug</h4>
                        </div>
                        <p class="text-2xl font-mono font-bold text-indigo-700 bg-indigo-100 px-4 py-2 rounded-xl">
                            {{ $artikel->slug }}
                        </p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-8 rounded-2xl border border-emerald-100 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h4 class="ml-4 text-xl font-bold text-gray-900">Dibuat</h4>
                        </div>
                        <p class="text-xl font-semibold text-emerald-700">{{ $artikel->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 p-8 rounded-2xl border border-blue-100 hover:shadow-xl transition-all duration-300">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="ml-4 text-xl font-bold text-gray-900">Diupdate</h4>
                        </div>
                        <p class="text-xl font-semibold text-blue-700">{{ $artikel->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>

                <!-- Action Buttons Premium -->
                <div class="flex flex-col sm:flex-row gap-4 pt-12 border-t border-gray-100">
                    <a href="{{ route('admin.artikel.edit', $artikel->id) }}"
                       class="group flex-1 sm:flex-none bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-2xl text-lg shadow-2xl hover:shadow-3xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-3 border-0">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1.5-3l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Edit Artikel</span>
                    </a>
                    
                    <a href="{{ route('admin.artikel.index') }}"
                       class="group flex-1 sm:w-auto bg-white/60 hover:bg-white backdrop-blur-sm border-2 border-gray-200 hover:border-gray-300 text-gray-800 font-bold py-4 px-8 rounded-2xl text-lg shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex items-center justify-center space-x-3">
                        <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection