<div class="min-h-screen bg-zinc-950 p-6 font-sans text-zinc-100">

    <!-- HEADER -->
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
    <!-- TARJETAS PRINCIPALES (MÉTRICAS) -->
    <div class="grid auto-rows-min gap-4 md:grid-cols-4 mb-8">

        <!-- Total Productos (Catálogo) -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm relative overflow-hidden group">
            <div class="absolute inset-y-0 left-0 w-1 bg-violet-500"></div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-violet-100 text-violet-600 dark:bg-violet-900/30 dark:text-violet-400">
                    <flux:icon.cube class="size-6" />
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400 font-semibold mb-1">Catálogo Activo</p>
                    <p class="text-3xl font-bold">{{ $totalProductos ?? 142 }}</p>
                </div>
            </div>
            <p class="mt-4 text-xs text-neutral-500"><span class="text-green-500 font-medium">↑ 12 nuevos</span> este mes</p>
        </div>

        <!-- Inventario Total (Cajas/m2) -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm relative overflow-hidden">
            <div class="absolute inset-y-0 left-0 w-1 bg-amber-500"></div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-amber-100 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                    <flux:icon.rectangle-stack class="size-6" />
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400 font-semibold mb-1">Stock Disponible (m²)</p>
                    <p class="text-3xl font-bold">4,250</p>
                </div>
            </div>
            <p class="mt-4 text-xs text-neutral-500">Equivalente a <span class="font-medium text-amber-500 dark:text-amber-400">2,840 cajas</span></p>
        </div>

        <!-- Cotizaciones Pendientes -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm relative overflow-hidden">
            <div class="absolute inset-y-0 left-0 w-1 bg-blue-500"></div>
            <div class="flex items-center gap-4">
                <div class="p-3 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <flux:icon.document-text class="size-6" />
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400 font-semibold mb-1">Cotizaciones Activas</p>
                    <p class="text-3xl font-bold">38</p>
                </div>
            </div>
            <p class="mt-4 text-xs text-neutral-500"><span class="text-blue-500 font-medium">8 cerradas</span> esta semana</p>
        </div>

        <!-- Valor Inventario -->
        <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm relative overflow-hidden">
            <div class="absolute inset-y-0 left-0 w-1 bg-green-500"></div>
            <!-- Brillo de fondo sutil -->
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-500/10 blur-2xl rounded-full"></div>
            <div class="flex items-center gap-4 relative z-10">
                <div class="p-3 rounded-lg bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400">
                    <flux:icon.currency-dollar class="size-6" />
                </div>
                <div>
                    <p class="text-xs uppercase tracking-wider text-neutral-500 dark:text-neutral-400 font-semibold mb-1">Valor Inventario</p>
                    <p class="text-3xl font-bold">S/ {{ number_format($valorInventario ?? 142500, 0) }}</p>
                </div>
            </div>
            <p class="mt-4 text-xs text-neutral-500 relative z-10">Calculado a precio de costo</p>
        </div>
    </div>

    <!-- SECCIÓN DE DETALLES (TABLAS Y GRÁFICOS) -->
    <div class="grid gap-6 md:grid-cols-3">

        <!-- COLUMNA IZQUIERDA (Alertas de Stock y Lotes) -->
        <div class="md:col-span-2 space-y-6">

            <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
                <div class="flex items-center justify-between mb-6 pb-4 border-b border-neutral-100 dark:border-neutral-700">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                            <flux:icon.exclamation-triangle class="size-5 text-red-600 dark:text-red-400" />
                        </div>
                        <div>
                            <flux:heading size="lg">Alertas de Quiebre de Lote</flux:heading>
                            <flux:subheading>Tonos y lotes específicos próximos a agotarse</flux:subheading>
                        </div>
                    </div>
                    <flux:badge color="red" variant="solid" class="animate-pulse">2 Críticos</flux:badge>
                </div>

                @if(isset($productosBajos) && $productosBajos->count())
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
                    <!-- Vista estática para demostración si no hay variables -->
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-neutral-600 dark:text-neutral-400">
                            <thead class="text-xs uppercase bg-neutral-50 dark:bg-neutral-800 border-b border-neutral-200 dark:border-neutral-700">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Producto</th>
                                    <th class="px-4 py-3 font-medium">Lote / Tono</th>
                                    <th class="px-4 py-3 font-medium">Stock Restante</th>
                                    <th class="px-4 py-3 font-medium text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
                                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition">
                                    <td class="px-4 py-3 font-medium text-neutral-900 dark:text-white">Porcelanato Roble Claro (20x120)</td>
                                    <td class="px-4 py-3"><span class="font-mono text-xs bg-neutral-100 dark:bg-neutral-700 px-2 py-1 rounded">45A-B2</span></td>
                                    <td class="px-4 py-3"><span class="text-red-600 dark:text-red-400 font-bold">3 cajas (4.32 m²)</span></td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-xs text-amber-600 hover:text-amber-700 font-medium">Solicitar Reposición</button>
                                    </td>
                                </tr>
                                <tr class="hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition">
                                    <td class="px-4 py-3 font-medium text-neutral-900 dark:text-white">Tablón Nogal Oscuro (15x90)</td>
                                    <td class="px-4 py-3"><span class="font-mono text-xs bg-neutral-100 dark:bg-neutral-700 px-2 py-1 rounded">12B-X9</span></td>
                                    <td class="px-4 py-3"><span class="text-amber-600 dark:text-amber-400 font-bold">8 cajas (10.8 m²)</span></td>
                                    <td class="px-4 py-3 text-right">
                                        <button class="text-xs text-amber-600 hover:text-amber-700 font-medium">Solicitar Reposición</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <!-- Productos Más Vendidos -->
            <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
                <flux:heading size="lg" class="mb-4">Top Productos (Últimos 30 días)</flux:heading>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg bg-neutral-50 dark:bg-neutral-800/50 border border-neutral-100 dark:border-neutral-700">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 flex items-center justify-center font-bold text-sm">1</div>
                            <div>
                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">Porcelanato Calacatta Gold</p>
                                <p class="text-xs text-neutral-500">Formato 60x120 cm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-neutral-900 dark:text-white">450 m²</p>
                            <p class="text-xs text-green-500">+15%</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg bg-neutral-50 dark:bg-neutral-800/50 border border-neutral-100 dark:border-neutral-700">
                        <div class="flex items-center gap-4">
                            <div class="w-8 h-8 rounded-full bg-neutral-200 dark:bg-neutral-700 text-neutral-600 dark:text-neutral-400 flex items-center justify-center font-bold text-sm">2</div>
                            <div>
                                <p class="text-sm font-semibold text-neutral-900 dark:text-white">Tablón Roble Amazónico</p>
                                <p class="text-xs text-neutral-500">Formato 20x120 cm</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-neutral-900 dark:text-white">320 m²</p>
                            <p class="text-xs text-green-500">+5%</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- COLUMNA DERECHA (Gráficos y KPIs secundarios) -->
        <div class="space-y-6">

            <!-- Resumen de Categorías -->
            <div class="p-6 rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm">
                <flux:heading size="lg" class="mb-6">Distribución de Inventario</flux:heading>

                <div class="space-y-5">
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-neutral-600 dark:text-neutral-400 font-medium">Porcelanatos y Tablones</span>
                            <span class="font-bold">65%</span>
                        </div>
                        <div class="w-full h-2 bg-neutral-100 dark:bg-neutral-700 rounded-full overflow-hidden">
                            <div class="h-full bg-amber-500 transition-all" style="width: 65%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-neutral-600 dark:text-neutral-400 font-medium">Cerámicos de Pared (Wall Tiles)</span>
                            <span class="font-bold">20%</span>
                        </div>
                        <div class="w-full h-2 bg-neutral-100 dark:bg-neutral-700 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500 transition-all" style="width: 20%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-neutral-600 dark:text-neutral-400 font-medium">Pegamentos y Fraguas</span>
                            <span class="font-bold">15%</span>
                        </div>
                        <div class="w-full h-2 bg-neutral-100 dark:bg-neutral-700 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500 transition-all" style="width: 15%"></div>
                        </div>
                    </div>
                </div>

                <div class="pt-6 mt-6 border-t border-neutral-100 dark:border-neutral-700 text-center">
                    <flux:text class="text-xs text-neutral-400 italic">
                        Los datos se actualizan basándose en m² equivalentes.
                    </flux:text>
                </div>
            </div>

            <!-- Venta Cruzada (Cross-Selling KPI) -->
            <div class="p-6 rounded-xl bg-gradient-to-br from-neutral-800 to-neutral-900 border border-neutral-700 shadow-sm relative overflow-hidden">
                <!-- Icono de fondo -->
                <flux:icon.arrows-right-left class="absolute -right-4 -bottom-4 w-32 h-32 text-neutral-700/30" />

                <div class="relative z-10">
                    <h3 class="text-lg font-bold text-white mb-1">Eficiencia de Pegamentos</h3>
                    <p class="text-xs text-neutral-400 mb-6">Cerámica vendida con su respectivo adhesivo (Cross-selling).</p>

                    <div class="flex items-baseline gap-2 mb-2">
                        <span class="text-5xl font-black text-green-400">68%</span>
                    </div>
                    <p class="text-sm font-medium text-green-400 flex items-center gap-1">
                        <flux:icon.arrow-trending-up class="size-4" /> +5% vs mes anterior
                    </p>

                    <div class="mt-6 w-full bg-neutral-700/50 rounded-full h-1.5">
                        <div class="bg-green-400 h-1.5 rounded-full" style="width: 68%"></div>
                    </div>
                    <p class="text-xs text-neutral-500 mt-2 text-right">Meta mensual: 80%</p>
                </div>
            </div>

        </div>
    </div>
</div>
