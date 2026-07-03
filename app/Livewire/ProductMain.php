<?php

namespace App\Livewire;

use App\Models\Product;
use Flux\Flux;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductMain extends Component
{
    use WithFileUploads, WithPagination;

    public $search;

    public $descripcion;

    public $id;

    public $model_3d;

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

        $modelPath = null;
        if ($this->model_3d) {
            $modelPath = $this->model_3d->store('models', 'public');
        }

        if (! $this->id) {
            Product::create([
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'model_3d_path' => $modelPath,
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
            $updateData = [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad,
                'precio' => $this->precio,
                'disponible' => $this->disponible,
            ];

            if ($modelPath) {
                $updateData['model_3d_path'] = $modelPath;
            }

            $producto->update($updateData);
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
        $this->model_3d = $item->model_3d_path;
        $this->cantidad = $item->cantidad;
        $this->precio = $item->precio;
        $this->disponible = $item->disponible;
        $this->modal('showform')->show();
    }

    public function create()
    {
        $this->reset(['id', 'nombre', 'descripcion', 'model_3d', 'cantidad', 'precio', 'disponible']);
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
