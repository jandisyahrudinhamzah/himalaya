@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Detail Kegiatan</h1>
    <p class="text-gray-500">Informasi lengkap kegiatan</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            @if($kegiatan->foto)
                <img src="{{ asset('storage/'.$kegiatan->foto) }}"
                     class="w-full rounded-xl shadow-md">
            @else
                <div class="bg-gray-100 h-64 flex items-center justify-center rounded-xl">
                    <span class="text-gray-400">Tidak ada foto</span>
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold mb-4">
                {{ $kegiatan->judul }}
            </h2>

            <div class="space-y-3 text-gray-600">

                <p>
                    <strong>Tanggal:</strong>
                    {{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y') }}
                </p>

                <p>
                    <strong>Lokasi:</strong>
                    {{ $kegiatan->lokasi }}
                </p>

                <p>
                    <strong>Kuota:</strong>
                    {{ $kegiatan->kuota ?? '-' }}
                </p>

                <p>
                    <strong>Status:</strong>
                    <span class="px-3 py-1 rounded-full text-sm
                        @if($kegiatan->status == 'Upcoming') bg-blue-100 text-blue-600
                        @elseif($kegiatan->status == 'Ongoing') bg-yellow-100 text-yellow-600
                        @else bg-green-100 text-green-600
                        @endif">
                        {{ $kegiatan->status }}
                    </span>
                </p>

                <p class="mt-4">
                    <strong>Deskripsi:</strong><br>
                    {{ $kegiatan->deskripsi }}
                </p>

            </div>

            <div class="mt-6 flex gap-4">
                <a href="{{ route('admin.kegiatans.edit', $kegiatan->id) }}"
                   class="px-6 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-xl">
                    Edit
                </a>

                <a href="{{ route('admin.kegiatans.index') }}"
                   class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl">
                    Kembali
                </a>
            </div>

        </div>

    </div>
</div>
@endsection