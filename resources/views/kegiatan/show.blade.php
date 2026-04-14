@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-16 px-6">

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        @if($kegiatan->foto)
            <img src="{{ asset('storage/' . $kegiatan->foto) }}"
                 class="w-full h-80 object-cover">
        @endif

        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">
                {{ $kegiatan->judul }}
            </h1>

            <p class="text-gray-500 mb-6">
                {{ $kegiatan->tanggal }} • {{ $kegiatan->lokasi }}
            </p>

            <div class="text-gray-700 leading-relaxed">
                {{ $kegiatan->deskripsi }}
            </div>

            <a href="{{ route('kegiatan.index') }}"
               class="inline-block mt-8 bg-blue-900 text-white px-6 py-2 rounded-xl hover:bg-blue-700 transition">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection