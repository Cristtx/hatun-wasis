<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
  <div class="min-h-screen bg-[#fcfaf8] py-10" style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 40px 40px;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Botón Volver -->
        <div class="mb-8">
            <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a Inicio
            </a>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-4xl font-serif text-zinc-800 mb-3 uppercase tracking-wide">Catálogo de Tablones</h1>
            <p class="text-gray-500">Filtra y encuentra el acabado madera perfecto para tu proyecto.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar de Filtros -->
            <aside class="lg:w-1/4 w-full">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm sticky top-24">
                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Filtros</h3>
                    <div class="mb-6">
                        <h4 class="font-medium text-sm text-gray-700 mb-3">Tono de Madera</h4>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="rounded text-zinc-800 focus:ring-zinc-800"> <span class="text-sm text-gray-600">Roble Claro</span></label>
                            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="rounded text-zinc-800 focus:ring-zinc-800"> <span class="text-sm text-gray-600">Nogal Oscuro</span></label>
                            <label class="flex items-center gap-2 cursor-pointer"><input type="checkbox" class="rounded text-zinc-800 focus:ring-zinc-800"> <span class="text-sm text-gray-600">Gris Ceniza</span></label>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Grid de Productos -->
            <div class="lg:w-3/4 w-full">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Producto 1 -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition group">
                        <div class="h-48 overflow-hidden bg-gray-50 flex items-center justify-center p-4">
                            <img src="https://placehold.co/400x300/f8ede3/854d0e?text=Roble+Claro" alt="Roble" class="w-full h-full object-cover rounded shadow-sm group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-5">
                            <p class="text-xs text-gray-400 mb-1">Porcelanato • 20x120 cm</p>
                            <h3 class="font-serif text-lg font-semibold text-zinc-800 mb-2">Roble Claro Amazónico</h3>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-bold text-lg">S/ 45.90 <span class="text-xs font-normal text-gray-500">/ m²</span></span>
                            </div>
                        </div>
                    </div>
                    <!-- Producto 2 -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-md transition group">
                        <div class="h-48 overflow-hidden bg-gray-50 flex items-center justify-center p-4">
                            <img src="https://placehold.co/400x300/e5e5e5/404040?text=Gris+Ceniza" alt="Gris" class="w-full h-full object-cover rounded shadow-sm group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-5">
                            <p class="text-xs text-gray-400 mb-1">Cerámica • 15x60 cm</p>
                            <h3 class="font-serif text-lg font-semibold text-zinc-800 mb-2">Gris Ceniza Industrial</h3>
                            <div class="flex justify-between items-center mt-4">
                                <span class="font-bold text-lg">S/ 28.50 <span class="text-xs font-normal text-gray-500">/ m²</span></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOTÓN HACIA PEGAMENTOS -->
                <div class="mt-16 bg-orange-50 border border-orange-100 rounded-2xl p-8 text-center flex flex-col items-center">
                    <h3 class="text-2xl font-serif mb-2 text-[#d97706]">¿Ya elegiste tus tablones?</h3>
                    <p class="text-gray-600 mb-6 max-w-md">Para instalar porcelanatos alargados necesitas el adhesivo correcto para evitar desprendimientos.</p>
                    <a href="{{ route('pegamentos') }}" wire:navigate class="bg-white border-2 border-zinc-800 text-zinc-800 px-8 py-3 rounded-xl font-bold hover:bg-zinc-800 hover:text-white transition flex items-center gap-2 shadow-sm">
                        Ver Catálogo de Pegamentos
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
