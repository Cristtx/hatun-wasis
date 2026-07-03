<div>
    <div class="grid auto-rows-min gap-4 md:grid-cols-3 mb-8">
        <!-- Total Productos -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-violet-100 text-violet-600 dark:bg-violet-900/30 dark:text-violet-400">
                    <flux:icon.cube class="size-6" />
                </div>
                <div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 font-medium">Total Productos</p>
                    <p class="text-2xl font-bold">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>

        <!-- Total Clientes -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <flux:icon.users class="size-6" />
                </div>
                <div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 font-medium">Total Clientes</p>
                    <p class="text-2xl font-bold">{{ $totalClientes }}</p>
                </div>
            </div>
        </div>

        <!-- Valor Inventario -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                    <flux:icon.currency-dollar class="size-6" />
                </div>
                <div>
                    <p class="text-sm text-neutral-500 dark:text-neutral-400 font-medium">Valor del Inventario</p>
                    <p class="text-2xl font-bold">S/. {{ number_format($valorInventario, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-3">
        <!-- Tabla de Stock Crítico -->
        <div class="md:col-span-2 p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <flux:heading size="lg">⚠️ Reposición Urgente</flux:heading>
                    <flux:subheading>Productos con stock menor a 5 unidades</flux:subheading>
                </div>
                <flux:badge color="red" variant="outline">Crítico</flux:badge>
            </div>

            @if($productosBajos->count())
                <flux:table>
                    <flux:table.columns>
                        <flux:table.column>Producto</flux:table.column>
                        <flux:table.column>Stock Actual</flux:table.column>
                        <flux:table.column>Precio</flux:table.column>
                    </flux:table.columns>
                    <flux:table.rows>
                        @foreach ($productosBajos as $producto)
                            <flux:table.row>
                                <flux:table.cell class="font-medium">{{ $producto->nombre }}</flux:table.cell>
                                <flux:table.cell>
                                    <span class="px-2 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold dark:bg-red-900/30 dark:text-red-400">
                                        {{ $producto->cantidad }} ud.
                                    </span>
                                </flux:table.cell>
                                <flux:table.cell>S/. {{ number_format($producto->precio, 2) }}</flux:table.cell>
                            </flux:table.row>
                        @endforeach
                    </flux:table.rows>
                </flux:table>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <flux:icon.check-circle class="size-12 text-green-500 mb-3" />
                    <p class="text-neutral-500">¡Todo en orden! No hay productos con stock crítico.</p>
                </div>
            @endif
        </div>

        <!-- Resumen de Disponibilidad -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
            <flux:heading size="lg" class="mb-6">Estado del Catálogo</flux:heading>
            
            <div class="space-y-6">
                <div>
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-neutral-500">Productos Disponibles</span>
                        <span class="font-bold">{{ $disponibilidad }} / {{ $totalProductos }}</span>
                    </div>
                    <div class="w-full h-2 bg-neutral-100 dark:bg-neutral-700 rounded-full overflow-hidden">
                        <div class="h-full bg-green-500 transition-all" style="width: {{ $totalProductos > 0 ? ($disponibilidad / $totalProductos) * 100 : 0 }}%"></div>
                    </div>
                </div>

                <div class="pt-6 border-t border-neutral-100 dark:border-neutral-700">
                    <flux:text class="text-xs text-neutral-400 italic">
                        Los datos se actualizan automáticamente basándose en tu inventario actual.
                    </flux:text>
                </div>
            </div>
        </div>
    </div>
</div>
