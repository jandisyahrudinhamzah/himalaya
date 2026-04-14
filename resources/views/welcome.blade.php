@extends('layouts.app')

@section('content')

{{-- Hero Section with Parallax Effect --}}
<div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-900">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
        <div class="absolute top-20 left-10 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
        <div class="text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6 border border-white/20">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                <span class="text-sm font-medium text-emerald-100">Perhimpunan Pegiat Alam Dan Penempuh Rimba Yayasan Fatahillah</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-white tracking-tight mb-6">
                HIMAYALA
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 max-w-2xl mx-auto mb-10">
                JUJUR | DISIPLIN | TANGGUH
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#kegiatans" class="inline-flex items-center justify-center px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:-translate-y-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Lihat Kegiatan
                </a>
                <a href="#" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all duration-300 border border-white/20 backdrop-blur-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tentang Kami
                </a>
            </div>
        </div>
    </div>

    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
        <svg class="relative block w-full h-[60px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-gray-50"></path>
        </svg>
    </div>
</div>

{{-- Activities Section --}}
<div id="kegiatans" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    
    {{-- Section Header --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
        <div>
            <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full mb-4">✦ Aktivitas</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900"> kegiatan Terbaru</h2>
            <p class="text-gray-500 mt-2">Ikuti petualangan terbaru kami menjelajahi alam Indonesia</p>
        </div>
        <a href="#" class="hidden md:inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700 transition">
            Lihat Semua 
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
        </a>
    </div>

    {{-- Activities Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($kegiatans as $kegiatan)
        <a href="{{ route('kegiatan.show', $kegiatan->id) }}" class="group">
            <article class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl hover:shadow-gray-200/50 transition-all duration-500 hover:-translate-y-2">
                {{-- Image Container --}}
                <div class="relative h-56 overflow-hidden">
                    @if($kegiatan->foto)
                        <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="{{ $kegiatan->judul }}">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white/50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    
                    {{-- Overlay & Badge --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-white/90 backdrop-blur-sm text-gray-800 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Gunung
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-6">
                    <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                        <span class="mx-1">•</span>
                        <span class="text-emerald-600 font-medium">Aktif</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 group-hover:text-emerald-600 transition-colors duration-300 line-clamp-2">
                        {{ $kegiatan->judul }}
                    </h3>
                    <p class="text-gray-500 text-sm mt-3 line-clamp-3">
                        {{ $kegiatan->deskripsi ?? 'Deskripsi kegiatan akan segera diperbarui. Mari kita eksplorasi keindahan alam bersama HIMAYALA!' }}
                    </p>
                    
                    {{-- Footer --}}
                    <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            50 Partisipan
                        </div>
                        <span class="inline-flex items-center text-emerald-600 font-semibold text-sm group-hover:translate-x-1 transition-transform">
                            Baca Selengkapnya
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </div>
            </article>
        </a>
        @empty
        {{-- Empty State --}}
        <div class="col-span-full text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Kegiatan</h3>
            <p class="text-gray-500">Segera hadir berbagai kegiatan menarik dari HIMAYALA</p>
        </div>
        @endforelse
    </div>

    {{-- Mobile "Lihat Semua" --}}
    <div class="mt-10 text-center md:hidden">
        <a href="#" class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-xl">
            Lihat Semua Kegiatan
        </a>
    </div>
</div>

{{-- CTA Section --}}
<div class="bg-gray-900 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-blue-600 opacity-20"></div>
    <div class="relative max-w-4xl mx-auto px-4 py-16 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Berpetualang?</h2>
        <p class="text-gray-300 mb-8 text-lg">Bergabunglah dengan komunitas pecinta alam dan rasakan pengalaman tak terlupakan</p>
        <a href="#" class="inline-flex items-center px-8 py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-full transition-all duration-300 hover:shadow-lg hover:shadow-emerald-500/30 hover:scale-105">
            Gabung Sekarang
        </a>
    </div>
</div>

@endsection