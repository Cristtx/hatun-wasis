<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product; // Asegúrate de que este sea el nombre correcto de tu modelo

class ProductMain extends Component
{
    use WithPagination;

    // --- VARIABLES DE INTERFAZ Y BÚSQUEDA ---
    public $search = '';
    public $productSelectedId; // Para el modal de imágenes
    public $deleteId; // Para el modal de confirmación de borrado

    // --- VARIABLES DEL CRUD (Módulo Cerámicas) ---
    public $id; // ID del producto (null si es nuevo)
    public $codigo_sku;
    public $nombre;
    public $descripcion;
    public $tipo = 'Porcelanato';
    public $formato;
    public $acabado;
    public $cantidad; // Stock en cajas/unidades
    public $precio; // Precio de venta
    public $disponible = true;

    // Resetear paginación cuando se busca algo
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // --- FUNCIONES DEL CRUD ---

    public function create()
    {
        // Limpiamos el formulario
        $this->reset(['id', 'codigo_sku', 'nombre', 'descripcion', 'tipo', 'formato', 'acabado', 'cantidad', 'precio']);
        $this->disponible = true;

        // La vista Blade se encarga de abrir el modal con <flux:modal.trigger>
    }

    public function edit($id)
    {
        $producto = Product::findOrFail($id);

        $this->id = $producto->id;
        $this->codigo_sku = $producto->codigo_sku;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->tipo = $producto->tipo ?? 'Porcelanato';
        $this->formato = $producto->formato;
        $this->acabado = $producto->acabado;
        $this->cantidad = $producto->cantidad;
        $this->precio = $producto->precio;
        $this->disponible = $producto->disponible;

        // Abrimos el modal programáticamente
        $this->dispatch('modal', name: 'showform')->to('flux::modal');
    }

    public function save()
    {
        // Validación básica
        $this->validate([
            'nombre' => 'required|string|max:255',
            'codigo_sku' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0',
        ]);

        // Guardar o Actualizar
        Product::updateOrCreate(
            ['id' => $this->id],
            [
                'codigo_sku' => $this->codigo_sku,
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'tipo' => $this->tipo,
                'formato' => $this->formato,
                'acabado' => $this->acabado,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
                'disponible' => $this->disponible,
            ]
        );

        // Cerramos modal y mostramos mensaje
        $this->dispatch('modal', name: 'showform')->to('flux::modal');
        $this->dispatch('toast', variant: 'success', heading: '¡Éxito!', message: 'Material guardado correctamente.');
        $this->reset(['id', 'codigo_sku', 'nombre', 'descripcion', 'tipo', 'formato', 'acabado', 'cantidad', 'precio']);
    }

    // --- FUNCIONES EXTRA (Tus funciones originales) ---

    public function toggleDisponible($id)
    {
        $producto = Product::findOrFail($id);
        $producto->disponible = !$producto->disponible;
        $producto->save();

        $this->dispatch('toast', variant: 'success', heading: 'Actualizado', message: 'Estado de visibilidad modificado.');
    }

    public function openUpload($id)
    {
        $this->productSelectedId = $id;
        $this->dispatch('modal', name: 'showimage')->to('flux::modal');
    }

    public function confirm($id)
    {
        $this->deleteId = $id;
        $this->dispatch('modal', name: 'delete-profile')->to('flux::modal');
    }

    public function delete()
    {
        if ($this->deleteId) {
            Product::findOrFail($this->deleteId)->delete();
            $this->dispatch('modal', name: 'delete-profile')->to('flux::modal');
            $this->dispatch('toast', variant: 'success', heading: 'Eliminado', message: 'El registro fue borrado.');
        }
    }

    public function render()
    {
        // Búsqueda por nombre o por código SKU
        $productos = Product::where('nombre', 'like', '%' . $this->search . '%')
            ->orWhere('codigo_sku', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.product-main', compact('productos'));
    }
}
