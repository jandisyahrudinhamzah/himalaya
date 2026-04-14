@extends('layouts.admin')

@section('title', isset($struktur) ? 'Edit Struktur' : 'Tambah Struktur')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-3xl shadow-lg border border-gray-200 p-8 mb-8">
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.struktur.index') }}" class="p-2 text-gray-500 hover:bg-gray-100 rounded-xl">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ isset($struktur) ? 'Edit' : 'Tambah' }} Pengurus
                </h1>
                <p class="text-gray-600">Kelola data struktur organisasi</p>
            </div>
        </div>
    </div>

    <form method="POST" 
          action="{{ isset($struktur) ? route('admin.struktur.update', $struktur) : route('admin.struktur.store') }}" 
          enctype="multipart/form-data" 
          class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8 space-y-6">
        
        @csrf
        @if(isset($struktur))
            @method('PUT')
        @endif

        {{-- Foto --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Foto Profil</label>
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    @if(isset($struktur) && $struktur->foto)
                        <img src="{{ asset('storage/' . $struktur->foto) }}" 
                             class="w-24 h-24 object-cover rounded-2xl ring-2 ring-gray-200" alt="">
                        <p class="text-xs text-gray-500 mt-2">Ganti foto baru</p>
                    @else
                        <div class="w-24 h-24 bg-gray-100 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-300">
                            <i class="fas fa-camera text-2xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <input type="file" 
                           name="foto" 
                           accept="image/*"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    @error('foto')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Nama --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Nama Lengkap *</label>
            <input type="text" 
                   name="nama" 
                   value="{{ old('nama', $struktur->nama ?? '') }}"
                   required 
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama') border-red-300 @enderror">
            @error('nama')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jabatan --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Jabatan *</label>
            <select name="jabatan" required 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('jabatan') border-red-300 @enderror">
                <option value="">Pilih Jabatan</option>
                <option value="ketua" {{ old('jabatan', $struktur->jabatan ?? '') == 'ketua' ? 'selected' : '' }}>Ketua</option>
                <option value="waketum" {{ old('jabatan', $struktur->jabatan ?? '') == 'waketum' ? 'selected' : '' }}>Wakil Ketua</option>
                <option value="sekretaris" {{ old('jabatan', $struktur->jabatan ?? '') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
                <option value="bendahara" {{ old('jabatan', $struktur->jabatan ?? '') == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
                <option value="peralatan" {{ old('jabatan', $struktur->jabatan ?? '') == 'peralatan' ? 'selected' : '' }}>Peralatan</option>

            </select>
            @error('jabatan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bio --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Bio (Opsional)</label>
            <textarea name="bio" rows="4" 
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('bio') border-red-300 @enderror">{{ old('bio', $struktur->bio ?? '') }}</textarea>
            @error('bio')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-3">Status *</label>
            <select name="status" required 
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('status') border-red-300 @enderror">
                <option value="aktif" {{ old('status', $struktur->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="alumni" {{ old('status', $struktur->status ?? '') == 'alumni' ? 'selected' : '' }}>Alumni</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex gap-4 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.struktur.index') }}" 
               class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-900 font-semibold rounded-xl text-center transition-all">
                Batal
            </a>
            <button type="submit" 
                    class="flex-1 px-6 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2">
                <i class="fas fa-save"></i>
                {{ isset($struktur) ? 'Update' : 'Simpan' }}
            </button>
        </div>
    </form>
</div>
@endsection