<div>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/model-viewer/3.5.0/model-viewer.min.js"></script>
    <style>
        @keyframes kenburns {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-kenburns {
            animation: kenburns 7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        .product-card-tilt {
            perspective: 1000px;
        }
        .product-card-inner {
            transition: transform 0.1s ease-out;
            transform-style: preserve-3d;
        }
        .category-card-tilt {
            perspective: 1200px;
        }
        .category-card-inner {
            transition: transform 0.1s ease-out;
            transform-style: preserve-3d;
            box-shadow: 
                0 10px 30px -5px rgba(0,0,0,0.3),
                0 0 0 1px rgba(255,255,255,0.1) inset,
                0 15px 0px #1a1a1a; /* Thickness simulation */
        }
        .model-preview {
            opacity: 0;
            transition: opacity 0.4s ease-in-out;
            pointer-events: none;
        }
        .group:hover .model-preview {
            opacity: 1;
        }
        .group:hover .product-image {
            opacity: 0;
        }
        /* Spotlight effect helper */
        .spotlight {
            pointer-events: none;
            background: radial-gradient(circle at var(--x, 50%) var(--y, 50%), rgba(212,175,55,0.2) 0%, transparent 70%);
        }
        
        /* Material Textures */
        .mat-porcelanato {
            background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
            position: relative;
        }
        .mat-porcelanato::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
        }

        .mat-tablones {
            background: linear-gradient(180deg, #5d4037 0%, #3e2723 100%);
            position: relative;
        }
        .mat-tablones::after {
            content: '';
            position: absolute;
            inset: 0;
            background: repeating-linear-gradient(// Wood Grain Effect
                90deg,
                transparent,
                transparent 40px,
                rgba(0,0,0,0.05) 41px,
                transparent 42px
            );
            opacity: 0.4;
        }

        .mat-ceramicas {
            background: linear-gradient(135deg, #fffdfa 0%, #f5eee6 100%);
            position: relative;
        }
        .mat-ceramicas::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(255,255,255,0.8) 0%, transparent 100%);
        }

        .mat-pegamentos {
            background: linear-gradient(135deg, #9ca3af 0%, #4b5563 100%);
            position: relative;
        }
        .mat-pegamentos::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.1'/%3E%3C/svg%3E");
        }

        .glint {
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(
                to right,
                transparent,
                rgba(255,255,255,0.3),
                transparent
            );
            transform: skewX(-25deg);
            transition: 0.7s;
        }
        .group:hover .glint {
            left: 150%;
        }
    </style>
 
    {{-- Hero Section --}}

    <section id="hero" class="relative min-h-screen flex items-center overflow-hidden bg-black">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.0/three.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
        <canvas id="canvas-splendor" class="absolute inset-0 z-0 pointer-events-none" style="filter: contrast(1.1) brightness(1.1); opacity: 1;"></canvas>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 lg:py-36">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                {{-- LEFT: Text Content --}}
                <div class="text-center lg:text-left animate-fade-in-up">
                     <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gold-500/10 border border-gold-500/25 text-gold-400 text-xs font-semibold uppercase tracking-widest mb-8">
                         <span class="w-1.5 h-1.5 rounded-full bg-gold-400"></span>
                         Premium Collection
                     </div>
                     <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight mb-5">
                         Hatun Wasi
                     </h1>
                     <p class="text-base sm:text-lg text-zinc-400 font-light leading-relaxed mb-8 max-w-lg mx-auto lg:mx-0">
                         Discover the finest curated selection of ceramics and porcelain — where timeless craftsmanship meets contemporary elegance for your most inspiring spaces.
                     </p>
                     <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
                         <a href="#featured-products" class="btn-gold px-8 py-3.5 rounded-lg text-sm font-semibold uppercase tracking-wider transition-all hover:shadow-xl hover:shadow-gold-500/25 hover:-translate-y-0.5">
                             View Catalog
                         </a>
                         <a href="#contact" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-lg text-sm font-semibold uppercase tracking-wider text-zinc-300 border border-zinc-700 hover:bg-white hover:text-zinc-900 transition-all hover:-translate-y-0.5">
                             Contact Us
                         </a>
                     </div>
                 </div>

                 {{-- RIGHT: Product Image with Overlaid Glassmorphism Cards --}}
                  <div class="hidden lg:block relative">
                      <div class="aspect-[4/5] max-w-lg mx-auto"></div>
   
                      {{-- Floating Glassmorphism Cards Overlaid --}}
                    <div class="absolute -left-8 top-[15%] floating-card card-glass rounded-xl px-5 py-4 w-64">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-lg bg-orange-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Premium Products</p>
                                <p class="text-zinc-400 text-xs">Highest quality materials</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -right-8 top-[40%] floating-card card-glass rounded-xl px-5 py-4 w-64" style="animation-delay: 0.5s">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-lg bg-orange-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Exclusive Designs</p>
                                <p class="text-zinc-400 text-xs">Unique collections</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute left-4 bottom-[15%] floating-card card-glass rounded-xl px-5 py-4 w-64" style="animation-delay: 1s">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-lg bg-orange-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-white font-semibold text-sm">Personalized Service</p>
                                <p class="text-zinc-400 text-xs">Expert guidance</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-5 h-5 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    {{-- 3D Viewer Modal --}}
    <div id="viewer-3d-modal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 bg-black/90 backdrop-blur-md transition-all duration-300">
        <div class="relative w-full max-w-4xl aspect-square bg-zinc-900 rounded-3xl overflow-hidden shadow-2xl border border-zinc-800">
            <button onclick="close3DViewer()" class="absolute top-6 right-6 z-10 p-2 rounded-full bg-white/10 text-white hover:bg-white/20 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="absolute bottom-8 left-0 right-0 text-center z-10">
                <h3 id="viewer-product-name" class="font-serif text-2xl text-white mb-2"></h3>
                <p class="text-zinc-400 text-sm uppercase tracking-widest">Experiencia Inmersiva 3D</p>
            </div>
            <model-viewer 
                id="main-3d-model"
                src="" 
                alt="Modelo 3D de producto" 
                auto-rotate 
                camera-controls 
                shadow-intensity="1" 
                environment-image="neutral"
                exposure="1"
                style="width: 100%; height: 100%; background-color: #000;"
                touch-action="pan-y">
            </model-viewer>
        </div>
    </div>

    {{-- Featured Products Section --}}
    <section id="featured-products" class="py-24 lg:py-32 bg-cream blueprint-grid">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">Our Collection</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-4">Featured Products</h2>
                <div class="section-ornament">
                    <span class="ornament-diamond"></span>
                </div>
                <p class="text-zinc-500 max-w-2xl mx-auto mt-4 text-lg font-light">
                    Discover our curated selection of premium ceramics and porcelain pieces.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($productos as $item)
                    <div class="product-card-tilt">
                        <div class="product-card-inner product-card product-card-glass rounded-2xl overflow-hidden group cursor-pointer">
                            <div class="aspect-[4/3] overflow-hidden bg-zinc-50 relative">
                                @if ($item->images->count() > 0)
                                    <img src="{{ Storage::url($item->images->first()->url) }}"
                                         alt="{{ $item->nombre }}"
                                         class="product-image w-full h-full object-cover transition-opacity duration-400"
                                         loading="lazy">
                                @else
                                    <div class="product-image w-full h-full flex items-center justify-center text-zinc-300 transition-opacity duration-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif

                                @if($item->model_3d_path)
                                    <div class="model-preview absolute inset-0 w-full h-full">
                                        <model-viewer 
                                            src="{{ Storage::url($item->model_3d_path) }}" 
                                            alt="{{ $item->nombre }}" 
                                            auto-rotate 
                                            camera-controls 
                                            disable-zoom
                                            shadow-intensity="1" 
                                            environment-image="neutral"
                                            exposure="1"
                                            style="width: 100%; height: 100%; background-color: transparent;"
                                            touch-action="none">
                                        </model-viewer>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-x-2 group-hover:translate-x-0 flex gap-2 z-10">
                                     @if($item->model_3d_path)
                                         <button onclick="event.stopPropagation(); open3DViewer('{{ Storage::url($item->model_3d_path) }}', '{{ $item->nombre }}')" class="bg-gold-500 text-white text-xs font-medium px-3 py-1.5 rounded-full shadow-sm hover:bg-gold-600 transition-colors">
                                             Ver en 3D
                                         </button>
                                     @endif
                                     <span class="bg-white/90 backdrop-blur-sm text-zinc-800 text-xs font-medium px-3 py-1.5 rounded-full shadow-sm">
                                         S/ {{ number_format($item->precio, 2) }}
                                     </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h3 class="font-serif text-lg font-semibold text-zinc-900 mb-1 group-hover:text-gold-600 transition-colors">
                                    {{ $item->nombre }}
                                </h3>
                                @if($item->descripcion)
                                    <p class="text-zinc-500 text-sm line-clamp-2 mb-3">{{ $item->descripcion }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-gold-600 font-semibold text-base">S/ {{ number_format($item->precio, 2) }}</span>
                                    <span class="text-xs text-zinc-400">Stock: {{ $item->cantidad }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-zinc-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p class="text-zinc-400 text-lg">No products available yet.</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-12">
                <a href="#categories" class="btn-outline-gold px-8 py-3 rounded-lg text-sm font-semibold uppercase tracking-wider transition-all inline-flex items-center gap-2">
                    View All Products
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Categories Section --}}
    <section id="categories" class="py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">Catalog</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-4">Shop by Category</h2>
                <div class="section-ornament">
                    <span class="ornament-diamond"></span>
                </div>
                <p class="text-zinc-500 max-w-2xl mx-auto mt-4 text-lg font-light">
                    Explore our diverse range of ceramic and porcelain categories.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group relative rounded-2xl overflow-hidden aspect-[3/4] bg-zinc-100 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-gold-100 to-beige"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="text-white/70 text-xs uppercase tracking-widest">Collection</span>
                        <h3 class="font-serif text-2xl text-white mt-1">Floor Tiles</h3>
                    </div>
                    <div class="absolute top-6 right-6 w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden aspect-[3/4] bg-zinc-100 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-zinc-200 to-beige"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="text-white/70 text-xs uppercase tracking-widest">Collection</span>
                        <h3 class="font-serif text-2xl text-white mt-1">Wall Tiles</h3>
                    </div>
                    <div class="absolute top-6 right-6 w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden aspect-[3/4] bg-zinc-100 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-gold-50 to-cream"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="text-white/70 text-xs uppercase tracking-widest">Collection</span>
                        <h3 class="font-serif text-2xl text-white mt-1">Decorative</h3>
                    </div>
                    <div class="absolute top-6 right-6 w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>

                <div class="group relative rounded-2xl overflow-hidden aspect-[3/4] bg-zinc-100 cursor-pointer">
                    <div class="absolute inset-0 bg-gradient-to-br from-zinc-100 to-beige"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="text-white/70 text-xs uppercase tracking-widest">Collection</span>
                        <h3 class="font-serif text-2xl text-white mt-1">Outdoor</h3>
                    </div>
                    <div class="absolute top-6 right-6 w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section id="about" class="py-24 lg:py-32 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                <div class="relative">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden bg-zinc-200 shadow-xl">
                        <div class="w-full h-full bg-gradient-to-br from-beige to-gold-100 flex items-center justify-center">
                            <svg class="w-24 h-24 text-gold-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-40 h-40 rounded-2xl bg-gold-500 hidden lg:flex items-center justify-center shadow-xl">
                        <div class="text-center text-white">
                            <span class="block text-3xl font-serif font-bold">12+</span>
                            <span class="text-xs uppercase tracking-widest opacity-80">Years</span>
                        </div>
                    </div>
                </div>
                <div>
                    <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">About Us</span>
                    <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-6 leading-tight">
                        Crafting Spaces with Premium Ceramics Since 2012
                    </h2>
                    <div class="section-ornament justify-start mb-6">
                        <span class="ornament-diamond"></span>
                    </div>
                    <p class="text-zinc-600 leading-relaxed mb-6">
                        At Hatun Wasi, we are passionate about transforming spaces with the finest ceramics and porcelain. Our curated collections combine traditional craftsmanship with modern design, bringing elegance and durability to every project.
                    </p>
                    <p class="text-zinc-500 leading-relaxed mb-8">
                        Whether you are renovating your home or designing a commercial space, our team of experts is dedicated to helping you find the perfect materials that match your vision and style.
                    </p>
                    <div class="flex flex-wrap gap-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gold-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-zinc-700">Quality Guaranteed</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gold-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-zinc-700">Free Consultation</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gold-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium text-zinc-700">Nationwide Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Why Choose Us Section --}}
    <section id="why-choose-us" class="py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">Why Choose Us</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-4">The Hatun Wasi Difference</h2>
                <div class="section-ornament">
                    <span class="ornament-diamond"></span>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="group text-center p-8 rounded-2xl bg-cream hover:bg-gold-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gold-100 flex items-center justify-center group-hover:bg-gold-500 transition-colors duration-300">
                        <svg class="w-8 h-8 text-gold-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-zinc-900 mb-3">Premium Quality</h3>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Carefully selected materials ensuring durability and aesthetic perfection in every piece.
                    </p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-cream hover:bg-gold-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gold-100 flex items-center justify-center group-hover:bg-gold-500 transition-colors duration-300">
                        <svg class="w-8 h-8 text-gold-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-zinc-900 mb-3">Modern Designs</h3>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Contemporary styles and timeless patterns that elevate any space with sophistication.
                    </p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-cream hover:bg-gold-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gold-100 flex items-center justify-center group-hover:bg-gold-500 transition-colors duration-300">
                        <svg class="w-8 h-8 text-gold-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-zinc-900 mb-3">Personalized Attention</h3>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Expert guidance from our team to help you find the perfect solution for your project.
                    </p>
                </div>

                <div class="group text-center p-8 rounded-2xl bg-cream hover:bg-gold-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gold-100 flex items-center justify-center group-hover:bg-gold-500 transition-colors duration-300">
                        <svg class="w-8 h-8 text-gold-600 group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="font-serif text-xl font-semibold text-zinc-900 mb-3">Fast Delivery</h3>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Efficient logistics ensuring your order arrives promptly and in perfect condition.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Gallery Section --}}
    <section id="gallery" class="py-24 lg:py-32 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">Gallery</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-4">Our Work</h2>
                <div class="section-ornament">
                    <span class="ornament-diamond"></span>
                </div>
                <p class="text-zinc-500 max-w-2xl mx-auto mt-4 text-lg font-light">
                    Browse through our portfolio of completed projects and ceramic installations.
                </p>
            </div>

            @php
                $galleryImages = collect();
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse($galleryImages as $index => $image)
                    <div class="gallery-item rounded-xl overflow-hidden {{ $index === 0 ? 'md:col-span-2 md:row-span-2' : '' }} aspect-square md:aspect-auto {{ $index > 0 ? ($index < 3 ? 'aspect-square' : 'aspect-[4/5]') : '' }}">
                        <img src="{{ Storage::url($image->url) }}"
                             alt="Gallery image {{ $index + 1 }}"
                             class="w-full h-full object-cover"
                             loading="lazy">
                        <div class="gallery-overlay flex items-end p-6">
                            <span class="text-white text-sm font-medium">View Project</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-16">
                        <svg class="w-16 h-16 mx-auto text-zinc-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-zinc-400 text-lg">No gallery images available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="py-24 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-gold-600 text-xs font-semibold uppercase tracking-[0.2em]">Contact</span>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-zinc-900 mt-4 mb-4">Get in Touch</h2>
                <div class="section-ornament">
                    <span class="ornament-diamond"></span>
                </div>
                <p class="text-zinc-500 max-w-2xl mx-auto mt-4 text-lg font-light">
                    Have a question or ready to start your project? We'd love to hear from you.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-cream rounded-2xl p-8 text-center hover:bg-gold-50 transition-colors duration-300">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-gold-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900 mb-2">Visit Us</h4>
                    <p class="text-zinc-500 text-sm">Av. Principal 123, Lima, Peru</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 text-center hover:bg-gold-50 transition-colors duration-300">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-gold-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900 mb-2">Call Us</h4>
                    <p class="text-zinc-500 text-sm">+51 999 888 777</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 text-center hover:bg-gold-50 transition-colors duration-300">
                    <div class="w-14 h-14 mx-auto mb-5 rounded-2xl bg-gold-100 flex items-center justify-center">
                        <svg class="w-7 h-7 text-gold-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-zinc-900 mb-2">Email Us</h4>
                    <p class="text-zinc-500 text-sm">info@hatunwasi.com</p>
                </div>
            </div>

            <div class="max-w-3xl mx-auto mt-12 bg-cream rounded-2xl p-8 lg:p-10 text-center">
                <div class="flex flex-wrap justify-center gap-8 mb-6">
                    <div class="text-center">
                        <span class="block text-sm text-zinc-500 mb-1">Mon - Fri</span>
                        <span class="font-semibold text-zinc-900">9:00 AM - 7:00 PM</span>
                    </div>
                    <div class="w-px bg-zinc-200 hidden sm:block"></div>
                    <div class="text-center">
                        <span class="block text-sm text-zinc-500 mb-1">Saturday</span>
                        <span class="font-semibold text-zinc-900">10:00 AM - 6:00 PM</span>
                    </div>
                    <div class="w-px bg-zinc-200 hidden sm:block"></div>
                    <div class="text-center">
                        <span class="block text-sm text-zinc-500 mb-1">Sunday</span>
                        <span class="font-semibold text-zinc-900">Closed</span>
                    </div>
                </div>
                <p class="text-zinc-400 text-sm">Our team is available during business hours to assist you with any inquiries.</p>
            </div>
        </div>
    </section>

    {{-- CTA Banner --}}
    <section class="py-20 bg-gradient-to-r from-zinc-900 via-zinc-800 to-zinc-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-serif text-3xl sm:text-4xl text-white mb-4">Ready to Transform Your Space?</h2>
            <p class="text-zinc-400 text-lg font-light mb-8 max-w-2xl mx-auto">
                Contact us today for a free consultation and discover the perfect ceramics for your project.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="#contact" class="btn-gold px-8 py-3.5 rounded-lg text-sm font-semibold uppercase tracking-wider transition-all hover:shadow-xl hover:shadow-gold-500/25">
                    Get a Quote
                </a>
                <a href="#featured-products" class="border border-zinc-600 text-zinc-300 px-8 py-3.5 rounded-lg text-sm font-semibold uppercase tracking-wider hover:bg-zinc-800 transition-all">
                    Browse Products
                </a>
            </div>
        </div>
    </section>

    <script>
        window.open3DViewer = (url, name) => {
            const modal = document.getElementById('viewer-3d-modal');
            const modelViewer = document.getElementById('main-3d-model');
            const nameElement = document.getElementById('viewer-product-name');
            
            modelViewer.src = url;
            nameElement.textContent = name;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        };

        window.close3DViewer = () => {
            const modal = document.getElementById('viewer-3d-modal');
            const modelViewer = document.getElementById('main-3d-model');
            
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            modelViewer.src = '';
        };

        // Tilt Effect for Product Cards
        const initTilt = () => {
            const productCards = document.querySelectorAll('.product-card-inner');
            productCards.forEach(card => {
                const wrapper = card.parentElement;
                
                wrapper.addEventListener('mousemove', (e) => {
                    const rect = wrapper.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / centerY * 10; // Max 10deg
                    const rotateY = (centerX - x) / centerX * 10; // Max 10deg
                    
                    gsap.to(card, {
                        rotationX: rotateX,
                        rotationY: rotateY,
                        duration: 0.4,
                        ease: 'power2.out'
                    });
                });
                
                wrapper.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        rotationX: 0,
                        rotationY: 0,
                        duration: 0.6,
                        ease: 'elastic.out(1, 0.3)'
                    });
                });
            });

            const categoryCards = document.querySelectorAll('.category-card-inner');
            categoryCards.forEach(card => {
                const wrapper = card.parentElement;
                
                wrapper.addEventListener('mousemove', (e) => {
                    const rect = wrapper.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateX = (y - centerY) / centerY * 15; // Slightly more tilt for categories
                    const rotateY = (centerX - x) / centerX * 15; 
                    
                    gsap.to(card, {
                        rotationX: rotateX,
                        rotationY: rotateY,
                        duration: 0.4,
                        ease: 'power2.out'
                    });

                    // Update spotlight position
                    const spotlight = card.querySelector('.spotlight');
                    if (spotlight) {
                        const percX = (x / rect.width) * 100;
                        const percY = (y / rect.height) * 100;
                        spotlight.style.setProperty('--x', `${percX}%`);
                        spotlight.style.setProperty('--y', `${percY}%`);
                    }
                });
                
                wrapper.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        rotationX: 0,
                        rotationY: 0,
                        duration: 0.6,
                        ease: 'elastic.out(1, 0.3)'
                    });
                });
            });
        };

        window.onload = () => {
            try {
                const canvas = document.getElementById('canvas-splendor');
                if (!canvas) return;

                const renderer = new THREE.WebGLRenderer({ 
                    canvas, 
                    antialias: true, 
                    alpha: true 
                });
                renderer.setSize(window.innerWidth, window.innerHeight);
                renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                        renderer.setClearColor(0x000000, 0);


                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                camera.position.z = 5;

                // Background - Liquid Glass
                const bgGeometry = new THREE.PlaneGeometry(20, 20);
                const bgMaterial = new THREE.ShaderMaterial({
                    uniforms: {
                        u_time: { value: 0 },
                        u_resolution: { value: new THREE.Vector2(window.innerWidth, window.innerHeight) }
                    },
                    vertexShader: `
                        varying vec2 vUv;
                        void main() {
                            vUv = uv;
                            gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                        }
                    `,
                    fragmentShader: `
                        uniform float u_time;
                        varying vec2 vUv;
                        void main() {
                            vec2 uv = vUv;
                            float n = sin(uv.x * 2.0 + u_time * 0.1) * cos(uv.y * 2.0 + u_time * 0.1);
                             vec3 gold = vec3(0.6, 0.4, 0.02);
                             vec3 zinc = vec3(0.0, 0.0, 0.0);
                             gl_FragColor = vec4(mix(zinc, gold, n * 0.1 + 0.05), 0.6);

                        }
                    `,
                    transparent: true
                });
                const bgMesh = new THREE.Mesh(bgGeometry, bgMaterial);
                bgMesh.position.z = -1;
                scene.add(bgMesh);

                 // Optimized Particles
                 const particleCount = 40000;
                 const currentPositions = new Float32Array(particleCount * 3);
                 const targetPositions = new Float32Array(particleCount * 3);

                
                for (let i = 0; i < particleCount * 3; i++) {
                    currentPositions[i] = (Math.random() - 0.5) * 10;
                }

                const geometry = new THREE.BufferGeometry();
                geometry.setAttribute('position', new THREE.BufferAttribute(currentPositions, 3));

                    const createCircleTexture = () => {
                        const canvas = document.createElement('canvas');
                        canvas.width = 64; canvas.height = 64;
                        const ctx = canvas.getContext('2d');
                        const grad = ctx.createRadialGradient(32, 32, 0, 32, 32, 32);
                        grad.addColorStop(0, 'rgba(255, 255, 255, 1)');
                        grad.addColorStop(0.15, 'rgba(255, 215, 0, 1)');
                        grad.addColorStop(0.4, 'rgba(212, 175, 55, 0.3)');
                        grad.addColorStop(0.7, 'rgba(212, 175, 55, 0)');
                        
                        ctx.beginPath();
                        ctx.arc(32, 32, 32, 0, Math.PI * 2);
                        ctx.fillStyle = grad;
                        ctx.fill();
                        return new THREE.CanvasTexture(canvas);
                    };


                  const material = new THREE.PointsMaterial({
                      color: 0xDAA520,
                      size: 0.018,
                      map: createCircleTexture(),
                      transparent: true,
                      opacity: 1.0,
                      blending: THREE.AdditiveBlending,
                      depthWrite: false
                  });


                const points = new THREE.Points(geometry, material);
                scene.add(points);

                // Volumetric Shape Definitions
                 const setTargetRandom = () => {
                     for (let i = 0; i < particleCount; i++) {
                         const isEdge = Math.random() > 0.3;
                         const r = isEdge ? 6 : Math.random() * 6;
                         const theta = Math.random() * Math.PI * 2;
                         const phi = Math.random() * Math.PI;
                         targetPositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
                         targetPositions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
                         targetPositions[i * 3 + 2] = r * Math.cos(phi);
                     }
                 };


                 const setTargetText = () => {
                     const textCanvas = document.createElement('canvas');
                     const textCtx = textCanvas.getContext('2d');
                     textCanvas.width = 800;
                     textCanvas.height = 200;
                     textCtx.fillStyle = 'white';
                     textCtx.font = 'bold 80px "Cinzel", serif';
                     textCtx.textAlign = 'center';
                     textCtx.textBaseline = 'middle';
                     textCtx.fillText('HATUN WASI', 400, 100);


                    const imageData = textCtx.getImageData(0, 0, 800, 200).data;
                    const pointsArr = [];
                    for (let y = 0; y < 200; y++) {
                        for (let x = 0; x < 800; x++) {
                            if (imageData[(y * 800 + x) * 4 + 3] > 128) {
                                pointsArr.push({ x: x - 400, y: 100 - y });
                            }
                        }
                    }

                    for (let i = 0; i < particleCount; i++) {
                        const p = pointsArr[Math.floor(Math.random() * pointsArr.length)];
                        targetPositions[i * 3] = (p ? p.x : (Math.random() - 0.5) * 2) * 0.02;
                        targetPositions[i * 3 + 1] = (p ? p.y : (Math.random() - 0.5) * 2) * 0.02;
                        targetPositions[i * 3 + 2] = (Math.random() - 0.5) * 0.1;
                    }
                };

                 const setTargetBlock = () => {
                     for (let i = 0; i < particleCount; i++) {
                         const isSurface = Math.random() > 0.4;
                         if (isSurface) {
                             const axis = Math.floor(Math.random() * 3);
                             const side = Math.random() > 0.5 ? 3 : -3;
                             const p = [0, 0, 0];
                             p[axis] = side;
                             p[(axis + 1) % 3] = (Math.random() - 0.5) * 6;
                             p[(axis + 2) % 3] = (Math.random() - 0.5) * 6;
                             targetPositions[i * 3] = p[0];
                             targetPositions[i * 3 + 1] = p[1];
                             targetPositions[i * 3 + 2] = p[2];
                         } else {
                             targetPositions[i * 3] = (Math.random() - 0.5) * 6;
                             targetPositions[i * 3 + 1] = (Math.random() - 0.5) * 0.4;
                             targetPositions[i * 3 + 2] = (Math.random() - 0.5) * 4;
                         }
                     }
                 };

                 const setTargetBlackHole = () => {
                     for (let i = 0; i < particleCount; i++) {
                         const isDisk = Math.random() > 0.2;
                         if (isDisk) {
                             const angle = Math.random() * Math.PI * 2;
                             const radius = Math.pow(Math.random(), 2) * 6 + 0.5;
                             const height = (Math.random() - 0.5) * (radius * 0.1);
                             targetPositions[i * 3] = radius * Math.cos(angle);
                             targetPositions[i * 3 + 1] = height;
                             targetPositions[i * 3 + 2] = radius * Math.sin(angle);
                         } else {
                             const r = Math.random() * 0.6;
                             const theta = Math.random() * Math.PI * 2;
                             const phi = Math.random() * Math.PI;
                             targetPositions[i * 3] = r * Math.sin(phi) * Math.cos(theta);
                             targetPositions[i * 3 + 1] = r * Math.sin(phi) * Math.sin(theta);
                             targetPositions[i * 3 + 2] = r * Math.cos(phi);
                         }
                     }
                 };


                 const setTargetTorus = () => {
                     const R = 3; // Major radius
                     const r = 1; // Minor radius
                     for (let i = 0; i < particleCount; i++) {
                         const isSurface = Math.random() > 0.3;
                         const theta = Math.random() * Math.PI * 2;
                         const phi = Math.random() * Math.PI * 2;
                         
                         if (isSurface) {
                             targetPositions[i * 3] = (R + r * Math.cos(theta)) * Math.cos(phi);
                             targetPositions[i * 3 + 1] = (R + r * Math.cos(theta)) * Math.sin(phi);
                             targetPositions[i * 3 + 2] = r * Math.sin(theta);
                         } else {
                             const innerR = Math.random() * r;
                             targetPositions[i * 3] = (R + innerR * Math.cos(theta)) * Math.cos(phi);
                             targetPositions[i * 3 + 1] = (R + innerR * Math.cos(theta)) * Math.sin(phi);
                             targetPositions[i * 3 + 2] = innerR * Math.sin(theta);
                         }
                     }
                 };


                 const setTargetDiamond = () => {
                     for (let i = 0; i < particleCount; i++) {
                         const isEdge = Math.random() > 0.3;
                         const sign = Math.random() > 0.5 ? 1 : -1;
                         const r = isEdge ? 1 : Math.random();
                         const theta = Math.random() * Math.PI * 2;
                         const height = r * 3 * sign;
                         const scale = 1 - Math.abs(height / 3);
                         targetPositions[i * 3] = scale * Math.cos(theta) * 2;
                         targetPositions[i * 3 + 1] = height;
                         targetPositions[i * 3 + 2] = scale * Math.sin(theta) * 2;
                     }
                 };


                const setTargetWave = () => {
                    for (let i = 0; i < particleCount; i++) {
                        const x = (Math.random() - 0.5) * 8;
                        const z = (Math.random() - 0.5) * 8;
                        const y = Math.sin(x * 0.5) * Math.cos(z * 0.5) * 1.5;
                        targetPositions[i * 3] = x;
                        targetPositions[i * 3 + 1] = y + (Math.random() - 0.5) * 0.2;
                        targetPositions[i * 3 + 2] = z;
                    }
                };

                 const shapes = [setTargetRandom, setTargetText, setTargetBlackHole, setTargetTorus, setTargetDiamond, setTargetWave];

                let currentShapeIdx = 0;
                let rotationEnabled = true;

                const triggerMorph = () => {
                    currentShapeIdx = (currentShapeIdx + 1) % shapes.length;
                    shapes[currentShapeIdx]();
                    
                    if (shapes[currentShapeIdx] === setTargetText) {
                        rotationEnabled = false;
                        gsap.to(points.rotation, { x: 0, y: 0, z: 0, duration: 3, ease: "power2.inOut" });
                    } else {
                        rotationEnabled = true;
                        gsap.to(points.rotation, { y: points.rotation.y + Math.PI, duration: 3, ease: "none" });
                    }

                    const startPos = new Float32Array(geometry.attributes.position.array);
                    const morphObj = { p: 0 };
                    gsap.to(morphObj, {
                        p: 1,
                        duration: 3,
                        ease: "power2.inOut",
                        onUpdate: () => {
                            const pos = geometry.attributes.position.array;
                            for (let i = 0; i < particleCount * 3; i++) {
                                pos[i] = THREE.MathUtils.lerp(startPos[i], targetPositions[i], morphObj.p);
                            }
                            geometry.attributes.position.needsUpdate = true;
                        }
                    });
                };

                setInterval(triggerMorph, 6000);
                triggerMorph();

                const mouse = new THREE.Vector2();
                window.addEventListener('mousemove', (e) => {
                    mouse.x = (e.clientX / window.innerWidth) * 2 - 1;
                    mouse.y = -(e.clientY / window.innerHeight) * 2 + 1;
                });

                 function animate(time) {
                     bgMaterial.uniforms.u_time.value = time * 0.001;
                     if (rotationEnabled) points.rotation.y += 0.001;
                     points.position.x += (mouse.x * 0.5 - points.position.x) * 0.02;
                     points.position.y += (mouse.y * 0.5 - points.position.y) * 0.02;
                     
                     // "Star Dust" Flow Effect for Text
                     if (currentShapeIdx === 1) {
                         const pos = geometry.attributes.position.array;
                         for (let i = 0; i < particleCount * 3; i += 3) {
                             pos[i] += Math.sin(time * 0.002 + i) * 0.002;
                             pos[i+1] += Math.cos(time * 0.002 + i) * 0.002;
                             pos[i+2] += Math.sin(time * 0.001 + i) * 0.002;
                         }
                         geometry.attributes.position.needsUpdate = true;
                     }
                     
                     // Black Hole Swirl Effect
                     if (currentShapeIdx === 2) {
                         points.rotation.y += 0.02;
                         points.rotation.z += 0.005;
                     }
                     
                     renderer.render(scene, camera);
                     requestAnimationFrame(animate);
                 }

                animate(0);

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
        
        initTilt();
    } catch (e) {

                console.error('Splendor Error:', e);
            }
        };
    </script>
</div>