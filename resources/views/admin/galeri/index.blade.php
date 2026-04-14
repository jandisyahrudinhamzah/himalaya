{{-- resources/views/admin/galeri/index.blade.php --}}
@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-gray-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <div class="p-2 bg-gray-900 rounded-lg">
                            <i class="fas fa-images text-white text-lg"></i>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 tracking-tight">
                            Galeri Kegiatan
                        </h1>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">Kelola koleksi foto dan dokumentasi kegiatan HIMAYALA</p>
                </div>
                
                <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                    <i class="fas fa-plus mr-2"></i>
                    Upload Foto
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Stats Card --}}
        <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-medium text-gray-500 uppercase">Total Foto</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $galeris->total() }}</p>
                </div>
                <div class="p-2 bg-sky-50 rounded-lg text-sky-600">
                    <i class="fas fa-camera text-sm"></i>
                </div>
            </div>
        </div>

        {{-- Filter & Search Toolbar --}}
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-4 mb-6">
            <div class="flex flex-col sm:flex-row gap-4">
                {{-- Search --}}
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </div>
                    <input type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-gray-50 focus:bg-white transition-colors" placeholder="Cari foto...">
                </div>
                
                {{-- Category Filter --}}
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ !request()->kategori ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">Semua</a>
                    @foreach(['kegiatans', 'pendakian', 'outing', 'lainnya'] as $kategori)
                    <a href="{{ route('admin.galeri.index', ['kategori' => $kategori]) }}" class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ request()->kategori == $kategori ? 'bg-sky-500 text-white shadow-sm' : 'text-gray-500 hover:text-gray-900 hover:bg-gray-50' }}">
                        {{ ucfirst($kategori) }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Gallery Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @forelse($galeris as $item)
                <div class="group relative aspect-square bg-gray-100 rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300">
                    
                    {{-- Image --}}
                    <img src="{{ asset('storage/'.$item->foto) }}" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                         class="w-full h-full object-cover"
                         alt="Foto {{ ucfirst($item->kategori) }}">

                    {{-- Placeholder --}}
                    <div class="hidden absolute inset-0 items-center justify-center bg-gray-200">
                        <i class="fas fa-image text-gray-400 text-4xl"></i>
                    </div>

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold rounded-lg shadow-sm">
                            {{ ucfirst($item->kategori) }}
                        </span>
                    </div>
                    
                    {{-- Actions Overlay --}}
                    <div class="absolute inset-0 flex items-center justify-center gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{-- View --}}
                        <button onclick="showImage('{{ asset('storage/'.$item->foto) }}')" 
                                class="p-3 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white rounded-full transition-all hover:scale-110" 
                                title="Lihat Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        
                        {{-- Delete --}}
                        <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-3 bg-red-500/90 hover:bg-red-600 backdrop-blur-sm text-white rounded-full transition-all hover:scale-110" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-16 bg-white rounded-2xl border border-dashed border-gray-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4 mx-auto">
                            <i class="fas fa-images text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada foto di galeri</h3>
                        <p class="text-gray-500 mb-6 max-w-md mx-auto">Mulai dengan mengupload foto kegiatan terbaru untuk HIMAYALA.</p>
                        <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow-md">
                            <i class="fas fa-cloud-upload-alt mr-2"></i> Upload Foto
                        </a>
                    </div>
                </div>
            @endforelse

        </div>

        {{-- Pagination --}}
        @if($galeris->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $galeris->links('pagination::tailwind') }}
        </div>
        @endif

    </div>
</div>

{{-- Modal Preview --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/95 backdrop-blur-sm transition-opacity duration-300">
    <button onclick="closeModal()" class="absolute top-6 right-6 text-white/70 hover:text-white text-3xl transition-colors">
        <i class="fas fa-times"></i>
    </button>
    <div class="relative max-w-5xl w-full max-h-[90vh] flex items-center justify-center">
        <img id="modalImage" class="max-w-full max-h-[85vh] rounded-lg shadow-2xl border border-white/10">
    </div>
</div>

@push('scripts')
<script>
    function showImage(src) {
        document.getElementById('modalImage').src = src;
        const modal = document.getElementById('imageModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Close modal on Escape key or click outside
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
    
    document.getElementById('imageModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
@endsection