<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HIMALAYA - Penjelajah Alam</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <!-- Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0B3D2E; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; border-radius: 4px; }
    </style>
</head>
<body class="bg-himalaya-white text-gray-800 font-sans antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-4 px-6 lg:px-12 text-white">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-3 group">
                <div class="w-10 h-10 border-2 border-himalaya-gold rounded-full flex items-center justify-center group-hover:bg-himalaya-gold transition duration-300">
                    <i class="fa-solid fa-mountain text-himalaya-gold text-lg group-hover:text-white transition"></i>
                </div>
                <div>
                    <h1 class="font-serif text-2xl font-bold tracking-wider">HIMALAYA</h1>
                    <p class="text-[10px] tracking-[0.2em] text-himalaya-gold uppercase">Himpunan Mahasiswa Pecinta Alam</p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8 font-mono text-sm tracking-wide">
                <a href="#" class="hover:text-himalaya-gold transition duration-300">BERANDA</a>
                <a href="#about" class="hover:text-himalaya-gold transition duration-300">TENTANG</a>
                <a href="#activities" class="hover:text-himalaya-gold transition duration-300">KEGIATAN</a>
                <a href="#gallery" class="hover:text-himalaya-gold transition duration-300">GALERI</a>
                
                <!-- Dropdown Anggota -->
                <div class="relative group">
                    <button class="hover:text-himalaya-gold transition duration-300 flex items-center gap-1">
                        ANGGOTA <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white text-gray-800 shadow-xl rounded-sm overflow-hidden opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right">
                        <a href="#" class="block px-4 py-3 hover:bg-himalaya-green hover:text-white border-b border-gray-100">Pengurus Inti</a>
                        <a href="#" class="block px-4 py-3 hover:bg-himalaya-green hover:text-white border-b border-gray-100">Anggota Muda</a>
                        <a href="#" class="block px-4 py-3 hover:bg-himalaya-green hover:text-white">Alumni</a>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <a href="#" class="hidden md:block px-6 py-2 border border-himalaya-gold text-himalaya-gold hover:bg-himalaya-gold hover:text-white transition duration-300 font-mono text-xs tracking-widest uppercase">
                Gabung Sekarang
            </a>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-2xl text-himalaya-gold">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Main Content Slot -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-himalaya-dark text-white pt-20 pb-10 border-t-4 border-himalaya-gold relative overflow-hidden">
        <!-- Texture Overlay -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-1">
                    <h2 class="font-serif text-3xl font-bold mb-4 text-himalaya-gold">HIMALAYA</h2>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Membangun generasi pecinta alam yang tangguh, peduli lingkungan, dan siap menjelajah nusantara.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-himalaya-gold transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-himalaya-gold transition"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-himalaya-gold transition"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="font-mono text-himalaya-gold text-sm tracking-widest mb-6 uppercase">Navigasi</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li><a href="#" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">Kegiatan</a></li>
                        <li><a href="#" class="hover:text-white transition">Galeri</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="font-mono text-himalaya-gold text-sm tracking-widest mb-6 uppercase">Kontak</h3>
                    <ul class="space-y-3 text-sm text-gray-300">
                        <li class="flex items-start gap-3"><i class="fa-solid fa-location-dot mt-1 text-himalaya-gold"></i> Jl. Petualang No. 88, Bandung</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-envelope text-himalaya-gold"></i> info@himalaya.org</li>
                        <li class="flex items-center gap-3"><i class="fa-solid fa-phone text-himalaya-gold"></i> +62 812 3456 7890</li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="font-mono text-himalaya-gold text-sm tracking-widest mb-6 uppercase">Newsletter</h3>
                    <p class="text-xs text-gray-400 mb-4">Dapatkan info ekspedisi terbaru.</p>
                    <form class="flex border-b border-gray-600 pb-2">
                        <input type="email" placeholder="Email Anda" class="bg-transparent w-full outline-none text-sm text-white placeholder-gray-500">
                        <button class="text-himalaya-gold hover:text-white"><i class="fa-solid fa-arrow-right"></i></button>
                    </form>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-xs text-gray-500 font-mono">
                &copy; 2024 HIMALAYA. All Rights Reserved. Designed with <i class="fa-solid fa-heart text-red-500"></i> for Nature.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        AOS.init({ duration: 1000, once: true });
        
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav', 'py-2');
                nav.classList.remove('py-4');
            } else {
                nav.classList.remove('glass-nav', 'py-2');
                nav.classList.add('py-4');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>