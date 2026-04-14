<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <!-- Background -->
    <div class="min-h-screen flex items-center justify-center p-6 relative"
         style="background: #0f0f23;">

        <!-- Card Login -->
        <div class="w-full max-w-md backdrop-blur-xl bg-slate-900/80 border border-slate-700/50 
                    rounded-3xl shadow-2xl p-8 space-y-6 animate-fade-in-up">

            <!-- Header -->
            <div class="text-center">
                <h1 class="text-2xl font-bold text-white">Login</h1>
                <p class="text-sm text-slate-400">Masuk ke akun kamu</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" value="Email" class="text-slate-300 mb-1" />
                    <x-text-input id="email" name="email" type="email"
                        :value="old('email')" required autofocus
                        class="w-full px-4 py-3 bg-slate-800/60 border border-slate-700/50 rounded-xl
                               text-white placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-blue-500/40
                               transition duration-300"
                        placeholder="email@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" value="Password" class="text-slate-300 mb-1" />
                    <x-text-input id="password" name="password" type="password"
                        required autocomplete="current-password"
                        class="w-full px-4 py-3 bg-slate-800/60 border border-slate-700/50 rounded-xl
                               text-white placeholder-slate-400
                               focus:outline-none focus:ring-2 focus:ring-purple-500/40
                               transition duration-300"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                </div>

                <!-- Button -->
                <x-primary-button
    class="w-full py-3 text-sm font-semibold uppercase tracking-wide
           bg-gradient-to-r from-blue-600 to-purple-600
           hover:from-blue-500 hover:to-purple-500
           rounded-xl shadow-lg hover:shadow-xl
           transition duration-300 hover:scale-[1.02]">
    Login
    <a href="/" 
   class="block text-center mt-4 text-sm text-slate-400 hover:text-white transition">
    ← Kembali ke Halaman Utama
</a>
</x-primary-button>

<!-- Tombol kembali -->
<a href="/" 
   class="block text-center mt-4 text-sm text-slate-400 hover:text-white transition">
    ← Kembali ke Halaman Utama
</a>
            </form>
        </div>
    </div>

    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out;
        }
    </style>
</x-guest-layout>