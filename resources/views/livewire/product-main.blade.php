<h1 class="text-3xl mb-10 border-b-3 pb-1 border-violet-500">Gestión de Catálogo (Cerámicas y Afines)</h1>

    <div class="flex gap-2 mb-4">
        <flux:input wire:model.live="search" placeholder="Buscar por nombre o código" icon="magnifying-glass"/>
        <flux:button wire:click="create()" variant="primary" color="violet" icon="plus-circle" class="cursor-pointer">Nuevo Material</flux:button>
    </div>

    <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm overflow-hidden">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>CÓDIGO/SKU</flux:table.column>
                <flux:table.column>PRODUCTO</flux:table.column>
                <flux:table.column>TIPO / FORMATO</flux:table.column>
                <flux:table.column>STOCK (CAJAS)</flux:table.column>
                <flux:table.column>PRECIO M2 / UNIDAD</flux:table.column>
                <flux:table.column>DISPONIBLE</flux:table.column>
                <flux:table.column>OPCIONES</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($productos as $item)
                    <flux:table.row :key="$item->id">
                        <flux:table.cell class="font-mono text-xs text-neutral-500">
                            {{ $item->codigo_sku ?? 'N/A' }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap font-medium text-neutral-900 dark:text-white">
                            {{ $item->nombre }}
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="block text-xs font-semibold">{{ $item->tipo ?? 'General' }}</span>
                            <span class="text-xs text-neutral-400">{{ $item->formato ?? '' }} {{ $item->acabado ?? '' }}</span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="font-bold text-amber-500 dark:text-amber-400">{{ $item->cantidad }}</span>
                            @if(isset($item->unidad_medida))
                            <span class="text-xs text-neutral-500"> ({{ $item->unidad_medida }})</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell variant="strong" class="text-right">S/. {{ number_format($item->precio, 2) }}</flux:table.cell>
                        <flux:table.cell class="text-center">
                            <flux:badge size="sm" inset="top bottom" color="{{ $item->disponible ? 'green' : 'red' }}" wire:click="toggleDisponible({{ $item->id }})" class="cursor-pointer">
                                {{ $item->disponible ? "SI" : "NO" }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:button wire:click="openUpload({{ $item->id }})" variant="primary" color="amber" icon="photo" class="cursor-pointer"></flux:button>
                            <flux:button wire:click="edit({{ $item->id }})" variant="primary" color="amber" icon="pencil" class="cursor-pointer"></flux:button>
                            <flux:button wire:click="confirm({{ $item->id }})" variant="primary" color="red" icon="trash" class="cursor-pointer"></flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>

        <!-- Botón para abrir Modal -->
        <flux:modal.trigger name="modal-producto">
            <flux:button variant="filled" icon="plus" class="bg-amber-600 hover:bg-amber-700 text-white border-0">Nuevo Material</flux:button>
        </flux:modal.trigger>
    </div>

    <!-- TABLA DE PRODUCTOS -->
    <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800 shadow-sm overflow-hidden">
        <flux:table>
            <flux:table.columns>
                <flux:table.column>SKU / Código</flux:table.column>
                <flux:table.column>Nombre</flux:table.column>
                <flux:table.column>Tipo</flux:table.column>
                <flux:table.column>Formato / Acabado</flux:table.column>
                <flux:table.column>Stock Actual</flux:table.column>
                <flux:table.column>Precio Venta</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @forelse($productos as $producto)
                    <flux:table.row :key="$producto->id">
                        <flux:table.cell class="font-mono text-xs text-zinc-400">{{ $producto->codigo_sku }}</flux:table.cell>
                        <flux:table.cell class="font-medium text-neutral-900 dark:text-white">{{ $producto->nombre }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" variant="outline">{{ $producto->tipo }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $producto->formato ?? 'N/A' }} - {{ $producto->acabado ?? 'N/A' }}</span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="font-bold text-amber-500 dark:text-amber-400">{{ $producto->stock_cajas }} cjs</span>
                            <span class="text-xs text-neutral-500 dark:text-neutral-400 ml-1">({{ $producto->stock_total_m2 }} {{ $producto->unidad_medida }})</span>
                        </flux:table.cell>
                        <flux:table.cell class="font-semibold text-neutral-900 dark:text-white">S/. {{ number_format($producto->precio_venta, 2) }}</flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="text-center py-12 text-neutral-500">
                            <flux:icon.cube class="size-12 mx-auto text-neutral-400 mb-3" />
                            No hay productos registrados en el catálogo. ¡Crea el primero!
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        @if($productos->hasPages())
            <div class="p-4 border-t border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800/50">
                {{ $productos->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL DE REGISTRO CON FLUX -->
    <flux:modal name="modal-producto" class="md:w-[600px] space-y-6">
        <div>
            <flux:heading size="lg">Registrar Nuevo Material</flux:heading>
            <flux:subheading>Introduce los datos técnicos y comerciales de la cerámica o accesorio.</flux:subheading>
    <flux:modal name="showform" flyout>
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $id ? 'Editar Producto' : 'Registrar Nuevo Material' }}</flux:heading>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <flux:input wire:model="nombre" label="Nombre del Producto" placeholder="Ej. Porcelanato Carrara Pulido" />
                </div>

                <!-- Campos nuevos para cerámicas -->
                <div>
                    <flux:input wire:model="codigo_sku" label="Código SKU" placeholder="Ej. POR-CAR-60120" />
                </div>

                <div>
                    <flux:select wire:model="tipo" label="Tipo de Material">
                        <flux:select.option value="Porcelanato">Porcelanato</flux:select.option>
                        <flux:select.option value="Cerámico Pared">Cerámico Pared</flux:select.option>
                        <flux:select.option value="Tablón Madera">Tablón Madera</flux:select.option>
                        <flux:select.option value="Pegamento">Pegamento</flux:select.option>
                        <flux:select.option value="Fragua">Fragua</flux:select.option>
                    </flux:select>
                </div>

                <div>
                    <flux:input wire:model="formato" label="Formato" placeholder="Ej. 60x120 cm" />
                </div>

                <div>
                    <flux:input wire:model="acabado" label="Acabado" placeholder="Ej. Mate / Brillante" />
                </div>

                <!-- Campos originales adaptados -->
                <div>
                    <flux:input wire:model="cantidad" label="Stock (Cajas/Unidades)" placeholder="12" type="number"/>
                </div>

                <div>
                    <flux:input wire:model="precio" label="Precio Venta" placeholder="45.50" type="number" step="0.01"/>
                </div>
            </div>

            <div class="col-span-2">
                <flux:textarea wire:model="descripcion" label="Descripción Comercial" rows="3"/>
            </div>

            <flux:checkbox wire:model="disponible" label="Visible en Catálogo Público"/>

            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="save()" variant="primary" color="violet" icon="arrow-turn-down-right">Guardar Registro</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
