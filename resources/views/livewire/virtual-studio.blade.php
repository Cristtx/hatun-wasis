<div class="min-h-screen bg-black text-white flex flex-col overflow-hidden">
    {{-- Header --}}
    <header class="p-6 border-b border-zinc-800 flex justify-between items-center bg-black z-20">
        <div>
            <h1 class="font-serif text-2xl font-bold text-white">Estudio Virtual <span class="text-gold-500">Hatun Wasi</span></h1>
            <p class="text-zinc-500 text-xs uppercase tracking-widest">Configurador de Espacios Premium</p>
        </div>
        <div class="flex gap-4">
            <div class="flex bg-zinc-900 p-1 rounded-lg border border-zinc-800">
                <button 
                    wire:click="setSurface('floor')" 
                    class="px-4 py-2 rounded-md text-xs font-semibold transition-all {{ $surface === 'floor' ? 'bg-gold-600 text-white shadow-lg' : 'text-zinc-400 hover:text-white' }}"
                >
                    Suelo
                </button>
                <button 
                    wire:click="setSurface('wall')" 
                    class="px-4 py-2 rounded-md text-xs font-semibold transition-all {{ $surface === 'wall' ? 'bg-gold-600 text-white shadow-lg' : 'text-zinc-400 hover:text-white' }}"
                >
                    Pared
                </button>
            </div>
            <a href="/" class="px-4 py-2 rounded-lg border border-zinc-800 text-xs font-semibold hover:bg-zinc-900 transition-all">
                Volver al Inicio
            </a>
        </div>
    </header>

    <div class="flex-1 flex overflow-hidden relative">
        <script src="https://unpkg.com/three@0.160.0/build/three.min.js"></script>
        <script src="https://unpkg.com/three@0.160.0/examples/js/controls/OrbitControls.js"></script>
        
        {{-- Product Sidebar --}}
        <aside class="w-80 bg-black border-r border-zinc-800 overflow-y-auto z-10 p-6 custom-scrollbar">
            <h2 class="text-sm font-semibold text-zinc-400 uppercase tracking-widest mb-6">Catálogo de Materiales</h2>
            
            <div class="grid grid-cols-1 gap-4">
                @foreach($products as $product)
                    <button 
                        wire:click="setProduct({{ $product->id }})" 
                        class="group relative p-3 rounded-xl border transition-all text-left {{ $selectedProductId === $product->id ? 'border-gold-500 bg-gold-500/5' : 'border-zinc-800 bg-zinc-900/50 hover:border-zinc-600' }}"
                    >
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-lg overflow-hidden bg-zinc-800 shrink-0 border border-zinc-700">
                                @if($product->images->count() > 0)
                                    <img src="{{ Storage::url($product->images->first()->url) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-zinc-600">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-sm font-medium text-white truncate">{{ $product->nombre }}</p>
                                <p class="text-xs text-zinc-500">S/ {{ number_format($product->precio, 2) }}</p>
                            </div>
                        </div>
                        @if($selectedProductId === $product->id)
                            <div class="absolute top-2 right-2 w-2 h-2 rounded-full bg-gold-500 shadow-[0_0_8px_rgba(184,134,11,0.8)]"></div>
                        @endif
                    </button>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </aside>

        {{-- 3D Viewport --}}
        <main class="flex-1 relative bg-zinc-950">
            <canvas id="studio-canvas" class="absolute inset-0 w-full h-full"></canvas>
            
            {{-- UI Overlays --}}
            <div class="absolute bottom-8 left-8 z-10 pointer-events-none">
                <div class="bg-black/60 backdrop-blur-md border border-zinc-800 p-6 rounded-2xl max-w-sm">
                    <h3 class="text-gold-500 font-serif text-lg mb-2">Visualizador Inmersivo</h3>
                    <p class="text-zinc-400 text-sm leading-relaxed">
                        {{ $selectedProductId 
                            ? "Previsualizando: " . \App\Models\Product::find($selectedProductId)->nombre 
                            : "Selecciona un material del catálogo para comenzar a diseñar tu espacio." }}
                    </p>
                </div>
            </div>

            <div class="absolute top-8 right-8 z-10 flex flex-col gap-3">
                <div class="bg-black/60 backdrop-blur-md border border-zinc-800 p-3 rounded-xl text-xs text-zinc-400">
                    <div class="flex items-center gap-2 mb-1">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span>Renderizado Realista Activo</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-gold-500"></div>
                        <span>Iluminación Dinámica</span>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #27272a; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #b8860b; }
    </style>

    <script>
        document.addEventListener('livewire:init', () => {
            const canvas = document.getElementById('studio-canvas');
            const renderer = new THREE.WebGLRenderer({ canvas, antialias: true });
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth - 320, window.innerHeight - 80);
            renderer.outputColorSpace = THREE.SRGBColorSpace;
            renderer.toneMapping = THREE.ACESFilmicToneMapping;
            renderer.toneMappingExposure = 1.2;

            const scene = new THREE.Scene();
            scene.background = new THREE.Color(0x050505);

            const camera = new THREE.PerspectiveCamera(45, (window.innerWidth - 320) / (window.innerHeight - 80), 0.1, 1000);
            camera.position.set(8, 6, 8);
            camera.lookAt(0, 0, 0);

            const controls = new THREE.OrbitControls(camera, renderer.domElement);
            controls.enableDamping = true;
            controls.maxPolarAngle = Math.PI / 2.1; // Evita ver debajo del suelo
            controls.minDistance = 2;
            controls.maxDistance = 20;

            // Lighting
            const ambientLight = new THREE.AmbientLight(0xffffff, 0.5);
            scene.add(ambientLight);

            const spotLight = new THREE.SpotLight(0xffffff, 100);
            spotLight.position.set(5, 10, 5);
            spotLight.castShadow = true;
            spotLight.shadow.mapSize.width = 1024;
            spotLight.shadow.mapSize.height = 1024;
            scene.add(spotLight);

            const fillLight = new THREE.PointLight(0xb8860b, 20);
            fillLight.position.set(-5, 2, -5);
            scene.add(fillLight);

            // The Room
            const roomGroup = new THREE.Group();
            scene.add(roomGroup);

            const createWall = (w, h, d, pos, rot, name) => {
                const geo = new THREE.BoxGeometry(w, h, d);
                const mat = new THREE.MeshStandardMaterial({ 
                    color: 0x111111, 
                    roughness: 0.8, 
                    metalness: 0.1 
                });
                const mesh = new THREE.Mesh(geo, mat);
                mesh.position.set(...pos);
                mesh.rotation.set(...rot);
                mesh.name = name;
                mesh.receiveShadow = true;
                return mesh;
            };

            const floor = createWall(10, 0.1, 10, [0, -0.05, 0], [0, 0, 0], 'floor');
            const wall1 = createWall(10, 5, 0.1, [0, 2.5, -5], [0, 0, 0], 'wall');
            const wall2 = createWall(0.1, 5, 10, [-5, 2.5, 0], [0, 0, 0], 'wall');
            
            roomGroup.add(floor, wall1, wall2);

            // Texture Loader
            const textureLoader = new THREE.TextureLoader();

            const updateMaterial = (textureUrl, surfaceType) => {
                const texture = textureLoader.load(textureUrl);
                texture.wrapS = THREE.RepeatWrapping;
                texture.wrapT = THREE.RepeatWrapping;
                texture.repeat.set(4, 4); // Tiling

                const material = new THREE.MeshStandardMaterial({ 
                    map: texture, 
                    roughness: 0.3, 
                    metalness: 0.2 
                });

                if (surfaceType === 'floor') {
                    floor.material = material;
                } else {
                    wall1.material = material;
                    wall2.material = material;
                }
            };

            // Listen to Livewire for changes
            Livewire.on('update-studio', (data) => {
                if (data.textureUrl) {
                    updateMaterial(data.textureUrl, data.surface);
                }
            });

            function animate() {
                requestAnimationFrame(animate);
                controls.update();
                renderer.render(scene, camera);
            }
            animate();

            window.addEventListener('resize', () => {
                const width = window.innerWidth - 320;
                const height = window.innerHeight - 80;
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer.setSize(width, height);
            });
        });
    </script>
