{{-- resources/views/admin/artikel/form.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }}</h1>
    <p class="text-gray-500">Isi form berikut dengan benar</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ $action_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($artikel))
            @method('PUT')
        @endif

        {{-- Judul & Status --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel</label>
                <input type="text" name="judul" 
                       value="{{ isset($artikel) ? $artikel->judul : old('judul') }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                       placeholder="Masukkan judul artikel">

                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    <option value="draft" 
                        {{ (isset($artikel) && $artikel->status == 'draft') ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="published" 
                        {{ (isset($artikel) && $artikel->status == 'published') ? 'selected' : '' }}>
                        Published
                    </option>
                </select>
            </div>

        </div>

        {{-- Upload Gambar --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Cover</label>

            <div id="dropzone" 
                 class="border-2 border-dashed border-gray-200 rounded-xl p-8 text-center hover:border-emerald-400 transition cursor-pointer">

                    <input type="file" name="gambar" id="gambar" accept="image/*">
                <div id="preview-container">
                    @if(isset($artikel) && $artikel->gambar)
                        <img src="{{ asset('storage/'.$artikel->gambar) }}" 
                             class="max-h-64 mx-auto rounded-lg mb-4">
                        <p class="text-sm text-gray-500">Klik untuk ganti gambar</p>
                    @else
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Klik atau drag & drop gambar di sini</p>
                        <p class="text-sm text-gray-400">JPG, PNG max 2MB</p>
                    @endif
                </div>

            </div>
        </div>

        {{-- Konten --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Konten Artikel</label>
            <textarea name="konten" id="editor" rows="10"
                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">{{ isset($artikel) ? $artikel->konten : old('konten') }}</textarea>
        </div>

        {{-- Button --}}
        <div class="flex gap-4">
            <button type="submit" 
                class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan
            </button>

            <a href="{{ route('admin.artikel.index') }}" 
               class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition">
                Batal
            </a>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
    // CKEditor
    ClassicEditor.create(document.querySelector('#editor'));

    // Klik dropzone = buka file
    document.getElementById('dropzone').addEventListener('click', () => {
        document.getElementById('gambar').click();
    });

    // Preview gambar
    document.getElementById('gambar').addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('preview-container').innerHTML = `
                    <img src="${e.target.result}" class="max-h-64 mx-auto rounded-lg mb-4">
                    <p class="text-sm text-gray-500">Klik untuk ganti gambar</p>
                `;
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endpush