{{-- resources/views/admin/anggota/form.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">{{ $page_title ?? 'Form Anggota' }}</h1>
    <p class="text-gray-500">Isi data anggota dengan lengkap</p>
</div>

@if(session('error'))
<div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
    <form action="{{ $action_url }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($anggota)) @method('PUT') @endif

        <!-- Error Messages -->
        @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" 
                       name="nama" 
                       value="{{ old('nama', $anggota->nama ?? '') }}" 
                       class="w-full px-4 py-3 border @error('nama') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 @error('nama') focus:ring-red-500 @enderror" 
                       required>
                @error('nama')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email <span class="text-red-500">*</span></label>
                <input type="email" 
                       name="email" 
                       value="{{ old('email', $anggota->email ?? '') }}" 
                       class="w-full px-4 py-3 border @error('email') border-red-300 bg-red-50 @else border-gray-200 @enderror rounded-xl focus:ring-2 focus:ring-emerald-500 @error('email') focus:ring-red-500 @enderror" 
                       required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">NIM</label>
                <input type="text" 
                       name="nim" 
                       value="{{ old('nim', $anggota->nim ?? '') }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">No. HP</label>
                <input type="text" 
                       name="no_hp" 
                       value="{{ old('no_hp', $anggota->no_hp ?? '') }}" 
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500">
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jabatan <span class="text-red-500">*</span></label>
                <select name="jabatan" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500" required>
    <option value="">Pilih Jabatan</option>
    <option value="anggota" {{ old('jabatan', $anggota->jabatan ?? '') == 'anggota' ? 'selected' : '' }}>Anggota</option>
    <option value="ketua" {{ old('jabatan', $anggota->jabatan ?? '') == 'ketua' ? 'selected' : '' }}>Ketua</option>
    <option value="waketum" {{ old('jabatan', $anggota->jabatan ?? '') == 'waketum' ? 'selected' : '' }}>Wakil Ketua</option>
    <option value="sekretaris" {{ old('jabatan', $anggota->jabatan ?? '') == 'sekretaris' ? 'selected' : '' }}>Sekretaris</option>
    <option value="bendahara" {{ old('jabatan', $anggota->jabatan ?? '') == 'bendahara' ? 'selected' : '' }}>Bendahara</option>
    <option value="peralatan" {{ old('jabatan', $anggota->jabatan ?? '') == 'peralatan' ? 'selected' : '' }}>Peralatan</option>
    <option value="dokumentasi" {{ old('jabatan', $anggota->jabatan ?? '') == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
</select>
                @error('jabatan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                <select name="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500" required>
                    <option value="">Pilih Status</option>
                    <option value="aktif" {{ old('status', $anggota->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="alumni" {{ old('status', $anggota->status ?? '') == 'alumni' ? 'selected' : '' }}>Alumni</option>
                    <option value="nonaktif" {{ old('status', $anggota->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
            <div class="flex items-center gap-6">
                @if(isset($anggota) && $anggota->foto)
                <img src="{{ $anggota->foto_url }}" class="w-24 h-24 rounded-full object-cover border-4 border-emerald-100 shadow-md">
                @else
                <div class="w-24 h-24 rounded-full bg-gradient-to-br from-emerald-400 to-blue-500 flex items-center justify-center text-white text-3xl font-bold border-4 border-emerald-100 shadow-md">
                    {{ isset($anggota) ? strtoupper(substr($anggota->nama, 0, 2)) : 'NA' }}
                </div>
                @endif
                <div>
                    <input type="file" name="foto" accept="image/*" class="hidden" id="foto-input">
                    <label for="foto-input" class="px-6 py-3 bg-emerald-50 hover:bg-emerald-100 border-2 border-emerald-200 text-emerald-700 rounded-xl cursor-pointer transition-all duration-200 hover:shadow-md">
                        <i class="fas fa-camera mr-2"></i> Ganti Foto
                    </label>
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG (max 2MB) {{ isset($anggota) ? '(Opsional)' : '' }}</p>
                </div>
            </div>
            @error('foto')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Bio Singkat</label>
            <textarea name="bio" rows="4" 
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 resize-vertical"
                      placeholder="Ceritakan singkat tentang diri Anda...">{{ old('bio', $anggota->bio ?? '') }}</textarea>
            @error('bio')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-8 py-3 bg-emerald-500 hover:bg-emerald-600 text-white font-semibold rounded-xl transition-all duration-200 shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> {{ isset($anggota) ? 'Update' : 'Simpan' }}
            </button>
            <a href="{{ route('admin.anggota.index') }}" class="px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all duration-200">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('foto-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB!');
            e.target.value = '';
            return;
        }
        if (!file.type.startsWith('image/')) {
            alert('Hanya file gambar yang diperbolehkan!');
            e.target.value = '';
            return;
        }
    }
});
</script>
@endpush
@endsection