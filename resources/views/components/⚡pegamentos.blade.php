<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
   <div class="min-h-screen bg-[#fcfaf8] py-10" style="background-image: radial-gradient(#e5e7eb 1px, transparent 1px); background-size: 40px 40px;">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Botón Volver a Tablones -->
        <div class="mb-8">
            <a href="{{ route('tablones') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a Tablones
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-zinc-800 text-white p-12 text-center">
                <h1 class="text-4xl font-serif mb-4">Adhesivos y Pegamentos</h1>
                <p class="text-gray-300 max-w-2xl mx-auto text-lg">Encuentra el pegamento ideal recomendado para tus cerámicos y porcelanatos.</p>
            </div>

            <div class="p-8 md:p-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Pegamento 1 -->
                    <div class="flex gap-6 items-start p-6 border border-gray-100 rounded-2xl hover:border-[#d97706] hover:shadow-md transition bg-gray-50">
                        <img src="https://placehold.co/150x200/ffffff/d97706?text=Bolsa+Flexible" alt="Pegamento Flexible" class="w-24 object-contain shadow-sm rounded bg-white p-2">
                        <div>
                            <span class="bg-orange-100 text-[#d97706] text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Recomendado</span>
                            <h3 class="text-xl font-bold text-zinc-800 mt-2 mb-2">Pegamento Blanco Flexible</h3>
                            <p class="text-sm text-gray-600 mb-4">Ideal para porcelanatos y formatos tipo tablón.</p>
                            <p class="font-semibold">Rendimiento: <span class="font-normal text-gray-500">4 m² por bolsa (25kg)</span></p>
                        </div>
                    </div>

                    <!-- Pegamento 2 -->
                    <div class="flex gap-6 items-start p-6 border border-gray-100 rounded-2xl hover:border-gray-400 hover:shadow-md transition bg-white">
                        <img src="https://placehold.co/150x200/ffffff/4b5563?text=Bolsa+Estandar" alt="Pegamento Estandar" class="w-24 object-contain shadow-sm rounded bg-white p-2 border">
                        <div>
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Interiores</span>
                            <h3 class="text-xl font-bold text-zinc-800 mt-2 mb-2">Pegamento Gris Estándar</h3>
                            <p class="text-sm text-gray-600 mb-4">Para cerámicos de tamaño regular en pisos rígidos.</p>
                            <p class="font-semibold">Rendimiento: <span class="font-normal text-gray-500">5 m² por bolsa (25kg)</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>
