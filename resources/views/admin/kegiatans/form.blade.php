{{-- resources/views/admin/kegiatans/form.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">{{ $page_title }}</h1>
    <p class="text-gray-500">Isi detail kegiatan dengan lengkap</p>
</div>

{{-- ALERTS --}}
@if (session('success'))
<div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-xl mb-6">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
    <div class="font-medium mb-2">Ada kesalahan:</div>
    <ul class="list-disc list-inside space-y-1">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ $action_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($kegiatan))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Kegiatan <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="judul"
                       value="{{ old('judul', $kegiatan->judul ?? '') }}"
                       class="w-full px-4 py-3 border @error('judul') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('judul') focus:ring-red-500 @enderror"
                       placeholder="Contoh: Pendakian Gunung Semeru 2024"
                       required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal <span class="text-red-500">*</span>
                </label>
                <input type="date" 
                       name="tanggal"
                       value="{{ old('tanggal', $kegiatan->tanggal ?? '') }}"
                       class="w-full px-4 py-3 border @error('tanggal') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('tanggal') focus:ring-red-500 @enderror"
                       required>
                @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Lokasi <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="lokasi"
                       value="{{ old('lokasi', $kegiatan->lokasi ?? '') }}"
                       class="w-full px-4 py-3 border @error('lokasi') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('lokasi') focus:ring-red-500 @enderror"
                       placeholder="Contoh: Basecamp Ranu Pani"
                       required>
                @error('lokasi')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kuota Peserta</label>
                <input type="number" 
                       name="kuota"
                       value="{{ old('kuota', $kegiatan->kuota ?? '') }}"
                       min="1" max="1000"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                       placeholder="0 = Tidak terbatas">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent"
                        required>
                    <option value="Upcoming" {{ old('status', $kegiatan->status ?? 'Upcoming') == 'Upcoming' ? 'selected' : '' }}>📅 Upcoming</option>
                    <option value="Ongoing" {{ old('status', $kegiatan->status ?? '') == 'Ongoing' ? 'selected' : '' }}>🔥 Ongoing</option>
                    <option value="Selesai" {{ old('status', $kegiatan->status ?? '') == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                </select>
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Kegiatan</label>
            <textarea name="deskripsi" 
                      rows="6"
                      class="w-full px-4 py-3 border @error('deskripsi') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent @error('deskripsi') focus:ring-red-500 @enderror resize-vertical"
                      placeholder="Jelaskan detail kegiatan, rundown, persiapan yang diperlukan, dll...">{{ old('deskripsi', $kegiatan->deskripsi ?? '') }}</textarea>
            @error('deskripsi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- FOTO UPLOAD --}}
        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-3 @error('foto') text-red-600 @enderror">
                Foto Kegiatan @error('foto')<span class="text-red-500">*</span>@enderror
            </label>
            <div class="relative">
                <div class="border-2 @error('foto') border-red-300 bg-red-50 @else border-dashed border-gray-200 hover:border-emerald-400 @enderror rounded-2xl p-8 text-center transition-all duration-300 cursor-pointer group hover:shadow-md"
                     id="dropzone">
                    <input type="file" 
                           name="foto" 
                           id="foto" 
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                           accept="image/*">
                    
                    <div id="preview-container">
                        @if(isset($kegiatan) && $kegiatan->foto)
                            <div class="space-y-3">
                                <img src="{{ $kegiatan->foto_url }}" 
                                     alt="{{ $kegiatan->judul }}"
                                     class="max-h-64 max-w-full mx-auto rounded-xl shadow-lg object-cover border-4 border-emerald-100">
                                <div class="text-center">
                                    <p class="text-sm font-medium text-gray-700">Foto saat ini</p>
                                    <p class="text-xs text-gray-500">Klik untuk ganti</p>
                                </div>
                            </div>
                        @else
                            <div id="preview">
                                <i class="fas fa-cloud-upload-alt text-5xl text-gray-300 mb-4 group-hover:text-emerald-400 transition-colors"></i>
                                <p class="text-lg font-semibold text-gray-700 mb-1 group-hover:text-emerald-600">Upload foto kegiatan</p>
                                <p class="text-sm text-gray-500 mb-2">Klik atau drag & drop</p>
                                <p class="text-xs text-gray-400 bg-gray-100 px-3 py-1 rounded-full inline-block">JPG, PNG, GIF • Max 5MB</p>
                            </div>
                        @endif
                    </div>
                </div>
                @error('foto')
                    <p class="text-red-500 text-sm mt-2 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-100">
            <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 text-white font-semibold rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center">
                <i class="fas fa-save mr-2"></i>
                {{ isset($kegiatan) ? 'Update Kegiatan' : 'Simpan Kegiatan' }}
            </button>

            <a href="{{ route('admin.kegiatans.index') }}"
               class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>Batal
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('foto');
    const previewContainer = document.getElementById('preview-container');

    // Click to upload
    dropzone.addEventListener('click', () => fileInput.click());

    // Drag & Drop
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.add('bg-emerald-50', 'border-emerald-400', 'ring-4', 'ring-emerald-100');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
                        dropzone.classList.remove('bg-emerald-50', 'border-emerald-400', 'ring-4', 'ring-emerald-100');
        }, false);
    });

    dropzone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            handleFiles(files[0]);
        }
    });

    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFiles(e.target.files[0]);
        }
    });

    function handleFiles(file) {
        // VALIDASI
        if (!file.type.startsWith('image/')) {
            alert('❌ Hanya file gambar yang diperbolehkan!');
            return;
        }
        if (file.size > 5 * 1024 * 1024) {
            alert('❌ Ukuran file maksimal 5MB!');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            previewContainer.innerHTML = `
                <div class="space-y-3">
                    <img src="${e.target.result}" 
                         class="max-h-64 max-w-full mx-auto rounded-xl shadow-lg object-cover border-4 border-emerald-100">
                    <div class="text-center space-y-1">
                        <p class="text-sm font-medium text-emerald-700">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(1)} KB</p>
                        <p class="text-xs text-gray-400">✅ Siap diupload</p>
                    </div>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection