<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Hatun Wasi') }} - Premium Ceramics & Porcelain</title>
    <meta name="description" content="Premium ceramics and porcelain to transform every space.">

    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white text-zinc-800 antialiased">

    <header
        x-data="{ scrolled: false, mobileOpen: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'header-scrolled shadow-sm' : 'bg-transparent'"
        class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
    >
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo.webp') }}" alt="Hatun Wasi" class="h-10 w-auto">
                    <span :class="scrolled ? 'text-zinc-900' : 'text-white'" class="font-serif text-2xl font-semibold transition-colors duration-300">Hatun Wasi</span>
                </a>

                <nav class="hidden lg:flex items-center gap-8">
                    <a href="#hero" :class="scrolled ? 'text-zinc-700 hover:text-orange-500' : 'text-white/80 hover:text-orange-400'" class="nav-link text-sm font-medium transition-colors">Home</a>
                    <a href="#featured-products" :class="scrolled ? 'text-zinc-700 hover:text-orange-500' : 'text-white/80 hover:text-orange-400'" class="nav-link text-sm font-medium transition-colors">Products</a>
                    <a href="#categories" :class="scrolled ? 'text-zinc-700 hover:text-orange-500' : 'text-white/80 hover:text-orange-400'" class="nav-link text-sm font-medium transition-colors">Catalog</a>
                    <a href="#about" :class="scrolled ? 'text-zinc-700 hover:text-orange-500' : 'text-white/80 hover:text-orange-400'" class="nav-link text-sm font-medium transition-colors">About Us</a>
                    <a href="#contact" :class="scrolled ? 'text-zinc-700 hover:text-orange-500' : 'text-white/80 hover:text-orange-400'" class="nav-link text-sm font-medium transition-colors">Contact</a>
                </nav>

                <div class="hidden lg:flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" :class="scrolled ? 'btn-orange shadow-lg shadow-orange-500/25' : 'bg-white/15 hover:bg-orange-500 text-white border border-white/20'" class="px-5 py-2.5 rounded-lg text-sm font-medium transition-all">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" :class="scrolled ? 'btn-outline-orange' : 'text-white border border-white/30 hover:bg-white hover:text-zinc-900'" class="px-5 py-2.5 rounded-lg text-sm font-medium transition-all">
                                Log in
                            </a>
                        @endauth
                    @endif
                </div>

                <button
                    @click="mobileOpen = !mobileOpen"
                    :class="scrolled ? 'text-zinc-600 hover:bg-zinc-100' : 'text-white/80 hover:bg-white/10'"
                    class="lg:hidden p-2 rounded-lg transition-colors"
                    aria-label="Toggle menu"
                >
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div
                x-show="mobileOpen"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-4"
                @click.outside="mobileOpen = false"
                class="lg:hidden pb-4"
            >
                <nav class="flex flex-col gap-2 bg-white rounded-xl shadow-lg border border-zinc-100 p-4">
                    <a href="#hero" @click="mobileOpen = false" class="px-4 py-2.5 text-sm font-medium text-zinc-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">Home</a>
                    <a href="#featured-products" @click="mobileOpen = false" class="px-4 py-2.5 text-sm font-medium text-zinc-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">Products</a>
                    <a href="#categories" @click="mobileOpen = false" class="px-4 py-2.5 text-sm font-medium text-zinc-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">Catalog</a>
                    <a href="#about" @click="mobileOpen = false" class="px-4 py-2.5 text-sm font-medium text-zinc-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">About Us</a>
                    <a href="#contact" @click="mobileOpen = false" class="px-4 py-2.5 text-sm font-medium text-zinc-700 hover:text-orange-500 hover:bg-orange-50 rounded-lg transition-colors">Contact</a>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" @click="mobileOpen = false" class="btn-orange px-4 py-2.5 rounded-lg text-sm font-medium text-center mt-2">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" @click="mobileOpen = false" class="btn-outline-orange px-4 py-2.5 rounded-lg text-sm font-medium text-center mt-2">Log in</a>
                        @endauth
                    @endif
                </nav>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-zinc-900 text-zinc-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('assets/img/logo.webp') }}" alt="Hatun Wasi" class="h-10 w-auto brightness-0 invert">
                        <span class="font-serif text-xl font-semibold text-white">Hatun Wasi</span>
                    </div>
                    <p class="text-sm text-zinc-400 leading-relaxed mb-6">
                        Premium ceramics and porcelain to transform every space. We bring elegance and quality to your home and commercial projects.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-orange-500 hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-orange-500 hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" aria-label="Pinterest" class="w-10 h-10 rounded-full bg-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-orange-500 hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#hero" class="text-sm text-zinc-400 hover:text-orange-400 transition-colors">Home</a></li>
                        <li><a href="#featured-products" class="text-sm text-zinc-400 hover:text-orange-400 transition-colors">Products</a></li>
                        <li><a href="#categories" class="text-sm text-zinc-400 hover:text-orange-400 transition-colors">Catalog</a></li>
                        <li><a href="#about" class="text-sm text-zinc-400 hover:text-orange-400 transition-colors">About Us</a></li>
                        <li><a href="#contact" class="text-sm text-zinc-400 hover:text-orange-400 transition-colors">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-6">Contact Info</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span class="text-sm text-zinc-400">Av. Principal 123, Lima, Peru</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <span class="text-sm text-zinc-400">+51 999 888 777</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-orange-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm text-zinc-400">info@hatunwasi.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-6">Business Hours</h4>
                    <ul class="space-y-3">
                        <li class="flex justify-between text-sm">
                            <span class="text-zinc-400">Mon - Fri</span>
                            <span class="text-zinc-300">9:00 AM - 7:00 PM</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-zinc-400">Saturday</span>
                            <span class="text-zinc-300">10:00 AM - 6:00 PM</span>
                        </li>
                        <li class="flex justify-between text-sm">
                            <span class="text-zinc-400">Sunday</span>
                            <span class="text-zinc-300">Closed</span>
                        </li>
                    </ul>
                    <div class="mt-6 pt-6 border-t border-zinc-800">
                        <p class="text-xs text-zinc-500">Subscribe to our newsletter</p>
                        <form class="mt-3 flex">
                            <input type="email" placeholder="Your email" class="flex-1 bg-zinc-800 text-zinc-300 text-sm px-4 py-2.5 rounded-l-lg border border-zinc-700 focus:outline-none focus:border-orange-500 transition-colors" required>
                            <button type="submit" class="btn-orange px-4 py-2.5 rounded-r-lg text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-zinc-500">
                    &copy; {{ date('Y') }} Hatun Wasi. All rights reserved.
                </p>
                <div class="flex items-center gap-6 text-sm text-zinc-500">
                    <a href="#" class="hover:text-zinc-300 transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-zinc-300 transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <button
        x-data="{ visible: false }"
        x-init="window.addEventListener('scroll', () => { visible = window.scrollY > 500 })"
        x-show="visible"
        x-cloak
        x-transition
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 z-40 w-12 h-12 rounded-full bg-orange-500 text-white shadow-lg hover:bg-orange-600 transition-all flex items-center justify-center"
        aria-label="Scroll to top"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </button>

    @vite(['resources/js/app.js'])
</body>
</html>