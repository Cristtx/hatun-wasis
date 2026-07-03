<?php

namespace App\Livewire;

use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ProductMain extends Component
{
    use WithPagination;

    public $search;

    public $descripcion;

    public $id;

    public $productSelectedId = null;

    #[Validate('required|min:4')]
    public $nombre;

    #[Validate('accepted')]
    public $disponible;

    #[Validate('required|numeric|min:1')]
    public $cantidad;

    public $precio;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $productos = Product::where('nombre', 'like', '%'.$this->search.'%')
            ->latest()->paginate();

        return view('livewire.product-main', compact('productos'));
    }

    public function save()
    {
        $this->validate();
        if (! $this->id) {
            Product::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
                'disponible' => $this->disponible,
            ]);
            Flux::toast(
                heading: 'Producto registrado.',
                text: 'El registro se realizo correctamente.',
                variant: 'success'
            );
        } else {
            $producto = Product::find($this->id);
            $producto->update([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
                'disponible' => $this->disponible,
            ]);
            Flux::toast(
                heading: 'Producto actualizado.',
                text: 'El registro se actualizo correctamente.',
                variant: 'success'
            );
        }
        $this->modal('showform')->close();
    }

    public function edit(Product $item)
    {
        $this->id = $item->id;
        $this->nombre = $item->nombre;
        $this->descripcion = $item->descripcion;
        $this->cantidad = $item->cantidad;
        $this->precio = $item->precio;
        $this->disponible = $item->disponible;
        $this->modal('showform')->show();
    }

    public function create()
    {
        $this->reset(['id', 'nombre', 'descripcion', 'cantidad', 'precio', 'disponible']);
        $this->modal('showform')->show();
    }

    // === METODO PARA ELIMINAR EL PRODUCTO ===
    public function confirm(Product $item)
    {
        $this->id = $item->id;
        $this->modal('delete-profile')->show();
    }

    public function delete()
    {
        $producto = Product::find($this->id);
        $producto->update([
            'disponible' => false, // Soft delete
        ]);
        Flux::toast(
            heading: 'Producto eliminado.',
            text: 'El registro se borró correctamente.',
            variant: 'success'
        );
        $this->modal('delete-profile')->close();
    }

    // === METODO PARA ALTERNAR DISPONIBILIDAD ===
    public function toggleDisponible(Product $product)
    {
        $product->update([
            'disponible' => ! $product->disponible,
        ]);
    }

    public function openUpload(Product $item)
    {
        $this->productSelectedId = $item->id;
        $this->modal('showimage')->show();
    }
}
