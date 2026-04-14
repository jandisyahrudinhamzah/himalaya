


<?php $__env->startSection('content'); ?>
<div class="min-h-screen">

    
    <div class="mb-5">
        <h1 class="text-lg font-bold text-gray-900">Selamat Datang di Dashboard Admin Himalaya!</h1>
    </div>

    
    <?php if(session('success')): ?>
    <div class="mb-5 p-3.5 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-center gap-2.5 text-sm">
        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

    </div>
    <?php endif; ?>

    
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-5">

        
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-newspaper text-blue-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none"><?php echo e($stats['total_artikel'] ?? 0); ?></p>
                <p class="text-xs text-gray-500 mt-0.5">Artikel</p>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-calendar-alt text-emerald-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none"><?php echo e($stats['total_kegiatans'] ?? 0); ?></p>
                <p class="text-xs text-gray-500 mt-0.5">Kegiatan</p>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-users text-orange-500 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none"><?php echo e($stats['total_anggota'] ?? 0); ?></p>
                <p class="text-xs text-gray-500 mt-0.5">Anggota</p>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-images text-purple-600 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none"><?php echo e($stats['total_galeri'] ?? 0); ?></p>
                <p class="text-xs text-gray-500 mt-0.5">Galeri</p>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 p-4 flex items-center gap-3 hover:shadow-md transition-shadow">
            <div class="w-10 h-10 rounded-lg bg-rose-50 flex items-center justify-center flex-shrink-0">
                <i class="fas fa-sitemap text-rose-500 text-sm"></i>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-900 leading-none"><?php echo e($stats['total_struktur'] ?? 0); ?></p>
                <p class="text-xs text-gray-500 mt-0.5">Struktur</p>
            </div>
        </div>

    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">

        
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Artikel Terbaru</h3>
                <a href="<?php echo e(route('admin.artikel.index')); ?>" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = \App\Models\Artikel::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artikel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="text-sm font-medium text-gray-800 truncate max-w-[70%]"><?php echo e($artikel->judul); ?></span>
                    <span class="text-xs text-gray-400 flex-shrink-0"><?php echo e($artikel->created_at->format('d M Y')); ?></span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada artikel</div>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Kegiatan Mendatang</h3>
                <a href="<?php echo e(route('admin.kegiatans.index')); ?>" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = \App\Models\Kegiatan::where('status','Upcoming')->latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kegiatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-5 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                    <span class="text-sm font-medium text-gray-800 truncate max-w-[60%]"><?php echo e($kegiatan->judul); ?></span>
                    <a href="<?php echo e(route('admin.kegiatans.show', $kegiatan->id)); ?>"
                       class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-md font-medium transition-colors flex-shrink-0">
                        Lihat ›
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-5 py-8 text-center text-sm text-gray-400">Tidak ada kegiatan mendatang</div>
                <?php endif; ?>
            </div>
        </div>

    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

        
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Daftar Anggota</h3>
                <a href="<?php echo e(route('admin.anggota.index')); ?>" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = \App\Models\Anggota::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-4 py-2.5 flex items-center gap-3 hover:bg-gray-50 transition-colors">
                    
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-semibold flex-shrink-0
                        <?php echo e(['bg-blue-100 text-blue-700','bg-pink-100 text-pink-700','bg-green-100 text-green-700','bg-yellow-100 text-yellow-700'][($loop->index) % 4]); ?>">
                        <?php if($anggota->foto): ?>
                            <img src="<?php echo e(asset('storage/'.$anggota->foto)); ?>" class="w-8 h-8 rounded-full object-cover">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr($anggota->nama, 0, 2))); ?>

                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 truncate"><?php echo e($anggota->nama); ?></p>
                        <p class="text-[10px] text-gray-500"><?php echo e(ucfirst($anggota->jabatan)); ?></p>
                    </div>
                    <a href="<?php echo e(route('admin.anggota.show', $anggota->id)); ?>"
                       class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-2.5 py-1 rounded-md font-medium transition-colors flex-shrink-0">
                        Lihat ›
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada anggota</div>
                <?php endif; ?>
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="<?php echo e(route('admin.anggota.index')); ?>" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Galeri Foto</h3>
                <a href="<?php echo e(route('admin.galeri.index')); ?>" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="p-3 grid grid-cols-2 gap-2">
                <?php $__empty_1 = true; $__currentLoopData = \App\Models\Galeri::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galeri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="aspect-video rounded-lg overflow-hidden bg-gray-100">
                    <img src="<?php echo e(asset('storage/'.$galeri->foto)); ?>"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                         onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-gray-400\'><i class=\'fas fa-image text-xl\'></i></div>'">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-2 py-8 text-center text-sm text-gray-400">Belum ada foto</div>
                <?php endif; ?>
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="<?php echo e(route('admin.galeri.index')); ?>" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

        
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
            <div class="px-5 py-3.5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-blue-900">Struktur Organisasi</h3>
                <a href="<?php echo e(route('admin.struktur.index')); ?>" class="text-xs text-blue-600 hover:text-blue-700 font-medium">Lihat Semua ›</a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php $__empty_1 = true; $__currentLoopData = \App\Models\Struktur::latest()->take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $struktur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="px-4 py-2.5 flex items-center gap-3 hover:bg-gray-50 transition-colors">
                    
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-semibold flex-shrink-0
                        <?php echo e(['bg-amber-100 text-amber-700','bg-violet-100 text-violet-700','bg-pink-100 text-pink-700','bg-green-100 text-green-700'][($loop->index) % 4]); ?>">
                        <?php if($struktur->foto): ?>
                            <img src="<?php echo e(asset('storage/'.$struktur->foto)); ?>" class="w-8 h-8 rounded-lg object-cover">
                        <?php else: ?>
                            <?php echo e(strtoupper(substr($struktur->nama, 0, 2))); ?>

                        <?php endif; ?>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-semibold text-gray-800 truncate"><?php echo e($struktur->nama); ?></p>
                        <p class="text-[10px] text-gray-500"><?php echo e(ucwords(str_replace('_',' ',$struktur->jabatan))); ?></p>
                    </div>
                    <?php
                        $jabatanColor = match($struktur->jabatan) {
                            'ketua'      => 'bg-amber-100 text-amber-700',
                            'waketum'    => 'bg-blue-100 text-blue-700',
                            'sekretaris' => 'bg-violet-100 text-violet-700',
                            'bendahara'  => 'bg-pink-100 text-pink-700',
                            default      => 'bg-green-100 text-green-700',
                        };
                    ?>
                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full flex-shrink-0 <?php echo e($jabatanColor); ?>">
                        <?php echo e(ucfirst($struktur->jabatan)); ?>

                    </span>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="px-5 py-8 text-center text-sm text-gray-400">Belum ada data struktur</div>
                <?php endif; ?>
            </div>
            <div class="px-5 py-2.5 border-t border-gray-50 text-center">
                <a href="<?php echo e(route('admin.struktur.index')); ?>" class="text-xs text-blue-600 font-medium hover:text-blue-700">Lihat Semua ›</a>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampppp\htdocs\himalaya\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>