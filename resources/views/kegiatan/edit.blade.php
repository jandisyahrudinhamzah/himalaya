@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Edit Kegiatan</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow max-w-2xl">

<form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Judul</label>
            <input type="text" name="judul" value="{{ $kegiatan->judul }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">{{ $kegiatan->deskripsi }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal" value="{{ $kegiatan->tanggal }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Lokasi</label>
            <input type="text" name="lokasi" value="{{ $kegiatan->lokasi }}"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>
        <div class="mb-6">
    <label class="block font-semibold mb-2">Foto</label>
    <input type="file" name="foto"
        class="w-full border rounded-lg p-3">

    @if($kegiatan->foto)
        <img src="{{ asset('storage/' . $kegiatan->foto) }}"
             class="mt-4 w-40 rounded-lg shadow">
    @endif
</div>

        <div class="flex justify-end">
            <a href="{{ route('kegiatan.index') }}" 
               class="mr-4 text-gray-600 hover:underline">Batal</a>

            <button type="submit"
                class="bg-blue-900 hover:bg-blue-800 text-white px-6 py-2 rounded-lg">
                Update
            </button>
        </div>

    </form>

</div>

@endsection