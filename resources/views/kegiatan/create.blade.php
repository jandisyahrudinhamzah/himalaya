@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Tambah Kegiatan</h1>

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

<form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-2">Judul</label>
            <input type="text" name="judul"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400"></textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Tanggal</label>
            <input type="date" name="tanggal"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>

        <div class="mb-6">
            <label class="block font-semibold mb-2">Lokasi</label>
            <input type="text" name="lokasi"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-orange-400">
        </div>
        <div class="mb-6">
    <label class="block font-semibold mb-2">Foto</label>
    <input type="file" name="foto"
        class="w-full border rounded-lg p-3">
</div>

        <div class="flex justify-end">
            <a href="{{ route('kegiatan.index') }}" 
               class="mr-4 text-gray-600 hover:underline">Batal</a>

            <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg">
                Simpan
            </button>
        </div>

    </form>

</div>

@endsection