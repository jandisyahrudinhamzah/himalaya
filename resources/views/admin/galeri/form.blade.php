{{-- resources/views/admin/galeri/create.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold">Tambah Foto Galeri</h1>
</div>

@if($errors->any())
<div class="bg-red-50 border border-red-200 p-4 rounded mb-6">
    @foreach($errors->all() as $error)
        <p class="text-red-600 text-sm">{{ $error }}</p>
    @endforeach
</div>
@endif

<form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="bg-white p-8 rounded-2xl shadow">
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-bold mb-2">Judul</label>
                <input type="text" name="judul" value="{{ old('judul') }}" 
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2">Kategori *</label>
                <select name="kategori" class="w-full p-3 border rounded-lg" required>
                    <option value="">Pilih</option>
                    <option value="kegiatans" {{ old('kategori') == 'kegiatans' ? 'selected' : '' }}>Kegiatans</option>
                    <option value="pendakian" {{ old('kategori') == 'pendakian' ? 'selected' : '' }}>Pendakian</option>
                    <option value="outing" {{ old('kategori') == 'outing' ? 'selected' : '' }}>Outing</option>
                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        </div>

        {{-- UPLOAD FOTO SIMPLE --}}
        <div class="mb-6">
            <label class="block text-sm font-bold mb-2">Foto *</label>
            <input type="file" name="foto" accept="image/*" required 
                   class="w-full p-3 border border-dashed rounded-lg hover:border-blue-400 cursor-pointer">
            <small class="text-gray-500">Max 5MB (JPG, PNG)</small>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-bold">
            Upload Foto
        </button>
    </div>
</form>
@endsection