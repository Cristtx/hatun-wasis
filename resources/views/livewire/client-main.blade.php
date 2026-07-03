<div>
    <h1 class="text-3xl mb-10 border-b-3 pb-1 border-violet-500">Gestión de clientes</h1>

    <div class="flex gap-2 mb-4">
        <flux:input wire:model.live="search" placeholder="Buscar cliente" icon="magnifying-glass"/>
        <flux:button wire:click="create()" variant="primary" color="violet" icon="plus-circle" class="cursor-pointer">Nuevo</flux:button>
    </div>

    <flux:table>
        <flux:table.columns>
            <flux:table.column>ID</flux:table.column>
            <flux:table.column>NOMBRE</flux:table.column>
            <flux:table.column>EMAIL</flux:table.column>
            <flux:table.column>TELÉFONO</flux:table.column>
            <flux:table.column>DIRECCIÓN</flux:table.column>
            <flux:table.column>OPCIONES</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @foreach ($clientes as $item)
                <flux:table.row>
                    <flux:table.cell>
                        {{ $item->id }}
                    </flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $item->nombre }}</flux:table.cell>
                    <flux:table.cell>{{ $item->email }}</flux:table.cell>
                    <flux:table.cell>{{ $item->telefono ?? '-' }}</flux:table.cell>
                    <flux:table.cell>{{ $item->direccion ?? '-' }}</flux:table.cell>
                    <flux:table.cell>
                        <flux:button wire:click="edit({{ $item->id }})" variant="primary" color="amber" icon="pencil" class="cursor-pointer"></flux:button>
                        <flux:button wire:click="confirm({{ $item->id }})" variant="primary" color="red" icon="trash" class="cursor-pointer"></flux:button>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table.rows>
    </flux:table>

    <div class="mt-4">
        {{ $clientes->links() }}
    </div>

    <flux:modal name="showform" flyout>
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $id ? 'Editar Cliente' : 'Registrar Cliente' }}</flux:heading>
            </div>
            <flux:input wire:model="nombre" label="Nombre cliente" placeholder="Juan Perez" />
            <flux:input wire:model="email" label="Email" placeholder="juan@example.com" type="email"/>
            <flux:input wire:model="telefono" label="Teléfono" placeholder="987654321"/>
            <flux:input wire:model="direccion" label="Dirección" placeholder="Av. Siempre Viva 123"/>
            <div class="flex">
                <flux:spacer />
                <flux:button wire:click="save()" variant="primary" color="violet" icon="arrow-turn-down-right">Guardar</flux:button>
            </div>
        </div>
    </flux:modal>

    <flux:modal name="delete-client" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">¿Eliminar cliente?</flux:heading>
                <flux:text class="mt-2">
                    Estás a punto de eliminar este cliente.<br>
                    Esta acción no se puede deshacer.
                </flux:text>
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button wire:click="delete()" variant="danger">Borrar registro</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
