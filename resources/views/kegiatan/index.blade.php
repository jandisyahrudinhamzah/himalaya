<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                📌 Data Kegiatan
            </h1>

            <a href="{{ route('kegiatan.create') }}"
               class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-lg shadow-md transition">
                + Tambah Kegiatan
            </a>
        </div>

        @if($kegiatans->count() > 0)

        <!-- GRID -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @foreach($kegiatans as $kegiatan)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">

                <!-- Gambar -->
                <img src="{{ asset('storage/'.$kegiatan->foto) }}"
                     class="h-52 w-full object-cover">

                <!-- Content -->
                <div class="p-5">

                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ $kegiatan->judul }}
                    </h2>

                    <p class="text-sm text-gray-500 mb-1">
                        📅 {{ $kegiatan->tanggal }}
                    </p>

                    <p class="text-sm text-gray-500 mb-4">
                        📍 {{ $kegiatan->lokasi }}
                    </p>

                    <!-- Action -->
                    <div class="flex justify-between items-center">

                        <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                           class="text-blue-600 hover:underline font-medium">
                            Edit
                        </a>

                        <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus kegiatan ini?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="text-red-500 hover:text-red-700 font-medium">
                                Hapus
                            </button>
                        </form>

                    </div>

                </div>
            </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $kegiatans->links() }}
        </div>

        @else

        <div class="text-center py-20">
            <p class="text-gray-500 text-lg">Belum ada data kegiatan.</p>
        </div>

        @endif

    </div>
</x-app-layout>