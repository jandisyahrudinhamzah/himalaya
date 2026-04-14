{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="min-h-screen">

    {{-- WELCOME --}}
    <div class="mb-5">
        <h1 class="text-lg font-bold text-gray-900">Selamat Datang di Dashboard Admin Himalaya!</h1>
    </div>

    {{-- FLASH --}}
    @if(session('success'))
    <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2.5 text-sm">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    {{-- STAT CARDS (5) --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-5">

        {{-- Artikel --}}
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-newspaper text-blue-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total_artikel'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Artikel</p>
            </div>
        </div>

        {{-- Kegiatan --}}
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-calendar-alt text-emerald-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total_kegiatans'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Kegiatan</p>
            </div>
        </div>

        {{-- Anggota --}}
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-orange-500 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total_anggota'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Anggota</p>
            </div>
        </div>

        {{-- Galeri --}}
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-images text-purple-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total_galeri'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Galeri</p>
            </div>
        </div>

        {{-- Struktur --}}
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-rose-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-sitemap text-rose-500 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none">{{ $stats['total_struktur'] ?? 0 }}</p>
                <p class="text-xs text-gray-500 mt-0.5">Struktur</p>
            </div>
        </div>

    </div>

    {{-- ROW 1: Artikel + Kegiatan --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">

        {{-- Artikel Terbaru --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Artikel Terbaru</h3>
                <a href="{{ route('admin.artikel.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse(\App\Models\Artikel::latest()->take(4)->get() as $artikel)
                <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="text-sm font-medium text-gray-800 truncate max-w-[70%]">{{ $artikel->judul }}</span>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $artikel->created_at->format('d M Y') }}</span>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada artikel</div>
                @endforelse
            </div>
        </div>

        {{-- Kegiatan Mendatang --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Kegiatan Mendatang</h3>
                <a href="{{ route('admin.kegiatans.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse(\App\Models\Kegiatan::where('status','Upcoming')->latest()->take(4)->get() as $kegiatan)
                <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="text-sm font-medium text-gray-800 truncate max-w-[60%]">{{ $kegiatan->judul }}</span>
                    <a href="{{ route('admin.kegiatans.show', $kegiatan->id) }}"
                       class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md font-medium transition-colors flex-shrink-0">
                        Lihat ›
                    </a>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-sm text-gray-400">Tidak ada kegiatan mendatang</div>
                @endforelse
            </div>
        </div>

    </div>

    {{-- ROW 2: Anggota + Galeri + Struktur --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        {{-- Daftar Anggota --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Daftar Anggota</h3>
                <a href="{{ route('admin.anggota.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse(\App\Models\Anggota::latest()->take(4)->get() as $anggota)
                <div class="px-4 py-2.5 flex items-center gap-3 hover:bg-gray-50 transition-colors">
                    {{-- Avatar --}}
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0
                        {{ ['bg-blue-100 text-blue-700','bg-pink-100 text-pink-700','bg-green-100 text-green-700','bg-yellow-100 text-yellow-700'][($loop->index) % 4] }}">
                        @if($anggota->foto)
                            <img src="{{ asset('storage/'.$anggota->foto) }}" class="w-8 h-8 rounded-full object-cover">
                        @else
                            {{ strtoupper(substr($anggota->nama, 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 truncate">{{ $anggota->nama }}</p>
                        <p class="text-[10px] text-gray-500">{{ ucfirst($anggota->jabatan) }}</p>
                    </div>
                    <a href="{{ route('admin.anggota.show', $anggota->id) }}"
                       class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-2.5 py-1 rounded-md font-medium transition-colors flex-shrink-0">
                        Lihat ›
                    </a>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada anggota</div>
                @endforelse
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="{{ route('admin.anggota.index') }}" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

        {{-- Galeri Foto --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Galeri Foto</h3>
                <a href="{{ route('admin.galeri.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="p-3 grid grid-cols-2 gap-2">
                @forelse(\App\Models\Galeri::latest()->take(4)->get() as $galeri)
                <div class="aspect-video rounded-lg overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/'.$galeri->foto) }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                         onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-gray-400\'><i class=\'fas fa-image text-xl\'></i></div>'">
                </div>
                @empty
                <div class="col-span-2 py-8 text-center text-sm text-gray-400">Belum ada foto</div>
                @endforelse
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="{{ route('admin.galeri.index') }}" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

        {{-- Struktur Organisasi --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Struktur Organisasi</h3>
                <a href="{{ route('admin.struktur.index') }}" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse(\App\Models\Struktur::latest()->take(4)->get() as $struktur)
                <div class="px-4 py-2.5 flex items-center gap-3 hover:bg-gray-50 transition-colors">
                    {{-- Avatar --}}
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-semibold flex-shrink-0
                        {{ ['bg-amber-100 text-amber-700','bg-violet-100 text-violet-700','bg-pink-100 text-pink-700','bg-green-100 text-green-700'][($loop->index) % 4] }}">
                        @if($struktur->foto)
                            <img src="{{ asset('storage/'.$struktur->foto) }}" class="w-8 h-8 rounded-lg object-cover">
                        @else
                            {{ strtoupper(substr($struktur->nama, 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 truncate">{{ $struktur->nama }}</p>
                        <p class="text-[10px] text-gray-500">{{ ucwords(str_replace('_',' ',$struktur->jabatan)) }}</p>
                    </div>
                    @php
                        $jabatanColor = match($struktur->jabatan) {
                            'ketua'      => 'bg-amber-100 text-amber-700',
                            'waketum'    => 'bg-blue-100 text-blue-700',
                            'sekretaris' => 'bg-violet-100 text-violet-700',
                            'bendahara'  => 'bg-pink-100 text-pink-700',
                            default      => 'bg-green-100 text-green-700',
                        };
                    @endphp
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full flex-shrink-0 {{ $jabatanColor }}">
                        {{ ucfirst($struktur->jabatan) }}
                    </span>
                </div>
                @empty
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada data struktur</div>
                @endforelse
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="{{ route('admin.struktur.index') }}" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

    </div>

</div>
@endsection