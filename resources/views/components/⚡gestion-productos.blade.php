<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <flux:heading size="xl">Catálogo de Productos</flux:heading>
            <flux:subheading>Administra el inventario de cerámicos, porcelanatos y complementos.</flux:subheading>
        </div>

        <flux:modal.trigger name="modal-producto">
            <flux:button variant="filled" icon="plus" class="bg-amber-600 hover:bg-amber-700 text-white">Nuevo Producto</flux:button>
        </flux:modal.trigger>
    </div>

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
                        <flux:table.cell class="font-medium">{{ $producto->nombre }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" variant="outline">{{ $producto->tipo }}</flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="text-xs text-zinc-400">{{ $producto->formato ?? 'N/A' }} - {{ $producto->acabado ?? 'N/A' }}</span>
                        </flux:table.cell>
                        <flux:table.cell>
                            <span class="font-bold text-amber-500">{{ $producto->stock_cajas }} cjs</span>
                            <span class="text-xs text-zinc-400">({{ $producto->stock_total_m2 }} {{ $producto->unidad_medida }})</span>
                        </flux:table.cell>
                        <flux:table.cell class="font-semibold">S/. {{ number_format($producto->precio_venta, 2) }}</flux:table.cell>
                    </flux:table.row>
                @empty
                    <flux:table.row>
                        <flux:table.cell colspan="6" class="text-center py-8 text-zinc-500">
                            No hay productos registrados en el catálogo. ¡Crea el primero!
                        </flux:table.cell>
                    </flux:table.row>
                @endforelse
            </flux:table.rows>
        </flux:table>

        <div class="p-4 border-t border-neutral-200 dark:border-neutral-700">
            {{ $productos->links() }}
        </div>
    </div>

    <flux:modal name="modal-producto" class="md:w-[600px] space-y-6">
        <div>
            <flux:heading size="lg">Registrar Nuevo Material</flux:heading>
            <flux:subheading>Introduce los datos técnicos y comerciales de la cerámica o accesorio.</flux:subheading>
        </div>

        <form wire:submit="guardar" class="space-y-4 grid grid-cols-2 gap-4">
            <div class="col-span-2">
                <flux:input wire:model="nombre" label="Nombre del Producto" placeholder="Ej. Porcelanato Carrara Pulido" />
            </div>

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
                <flux:input wire:model="formato" label="Formato (Dimensiones)" placeholder="Ej. 60x120 cm" />
            </div>

            <div>
                <flux:input wire:model="acabado" label="Acabado Superficial" placeholder="Ej. Pulido / Satinado / Mate" />
            </div>

            <div>
                <flux:input wire:model="precio_venta" type="number" step="0.01" label="Precio de Venta (S/.)" />
            </div>

            <div>
                <flux:select wire:model="unidad_medida" label="Unidad de Medida">
                    <flux:select.option value="m2">Metros Cuadrados (m²)</flux:select.option>
                    <flux:select.option value="Unidad">Unidad (Bolsas/Potes)</flux:select.option>
                </flux:select>
            </div>

            <div>
                <flux:input wire:model="metros_por_caja" type="number" step="0.01" label="Metros por Caja (Rendimiento)" placeholder="Ej. 1.44" />
            </div>

            <div>
                <flux:input wire:model="stock_cajas" type="number" label="Cantidad Inicial (Cajas/Bolsas)" />
            </div>

            <div class="col-span-2 flex justify-end gap-2 pt-4">
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button type="submit" class="bg-amber-600 text-white hover:bg-amber-700">Guardar Material</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
</div>
