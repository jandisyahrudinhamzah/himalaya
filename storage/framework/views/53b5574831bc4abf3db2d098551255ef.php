<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin HIMALAYA</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.25); }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    
    <aside class="w-52 bg-[#1a2744] fixed h-full overflow-y-auto z-20 hidden md:flex flex-col">

        
        <div class="p-5 border-b border-white/10 flex items-center gap-3">
    <div class="w-9 h-9 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg flex items-center justify-center shadow-lg overflow-hidden">
        <!-- Ganti ikon dengan logo Anda -->
        <img src="<?php echo e(asset('image/himalayalogo.jpeg')); ?>" 
             alt="HIMALAYA Logo" 
             class="w-6 h-6 object-contain"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
        <!-- Fallback ke ikon jika logo gagal load -->
        <i class="fas fa-mountain text-white text-sm" style="display: none;"></i>
    </div>
    <div>
        <h1 class="text-white font-bold text-base tracking-wide">HIMALAYA</h1>
        <p class="text-white/40 text-[10px]">Admin Panel</p>
    </div>
</div>

        
        <nav class="flex-1 px-3 py-4 space-y-0.5">

            <a href="<?php echo e(route('admin.dashboard')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-chart-line w-4 text-center text-xs"></i>
                Dashboard
            </a>

            <a href="<?php echo e(route('admin.artikel.index')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.artikel.*') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-newspaper w-4 text-center text-xs"></i>
                Artikel
            </a>

            <a href="<?php echo e(route('admin.kegiatans.index')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.kegiatans.*') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-calendar-alt w-4 text-center text-xs"></i>
                Kegiatan
            </a>

            <a href="<?php echo e(route('admin.anggota.index')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.anggota.*') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-users w-4 text-center text-xs"></i>
                Anggota
            </a>

            <a href="<?php echo e(route('admin.galeri.index')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.galeri.*') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-images w-4 text-center text-xs"></i>
                Galeri
            </a>

            <a href="<?php echo e(route('admin.struktur.index')); ?>"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium transition-all
               <?php echo e(request()->routeIs('admin.struktur.*') ? 'bg-blue-600 text-white' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <i class="fas fa-sitemap w-4 text-center text-xs"></i>
                Struktur
            </a>

        </nav>

        
        <div class="p-3 border-t border-white/10">
            <a href="#"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm font-medium text-white/50 hover:text-red-400 hover:bg-red-500/10 transition-all">
                <i class="fas fa-sign-out-alt w-4 text-center text-xs"></i>
                Logout
            </a>
            <form id="logout-form" method="POST" action="<?php echo e(route('logout')); ?>" class="hidden">
                <?php echo csrf_field(); ?>
            </form>
        </div>

    </aside>

    
    <main class="flex-1 md:ml-52 flex flex-col min-h-screen">

        
        <header class="bg-white border-b border-gray-200 px-6 py-3.5 flex justify-between items-center sticky top-0 z-10">
            <h1 class="font-semibold text-gray-800 text-sm">Admin Panel</h1>
            <div class="flex items-center gap-3">
                <button class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-gray-200 transition-colors">
                    <i class="fas fa-bell text-xs"></i>
                </button>
                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-semibold">
                    AD
                </div>
            </div>
        </header>

        
        <div class="flex-1 p-6">
            <?php echo $__env->yieldContent('content'); ?>
        </div>

    </main>

</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampppp\htdocs\himalaya\resources\views/layouts/admin.blade.php ENDPATH**/ ?>