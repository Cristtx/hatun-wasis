<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class VirtualStudio extends Component
{
    use WithPagination;

    public $selectedProductId = null;

    public $surface = 'floor'; // 'floor' or 'wall'

    public function setProduct($id)
    {
        $this->selectedProductId = $id;

        $product = Product::with('images')->find($id);
        if ($product && $product->images->count() > 0) {
            $textureUrl = Storage::url($product->images->first()->url);
            $this->dispatch('update-studio', textureUrl: $textureUrl, surface: $this->surface);
        }
    }

    public function setSurface($surface)
    {
        $this->surface = $surface;

        if ($this->selectedProductId) {
            $product = Product::with('images')->find($this->selectedProductId);
            if ($product && $product->images->count() > 0) {
                $textureUrl = Storage::url($product->images->first()->url);
                $this->dispatch('update-studio', textureUrl: $textureUrl, surface: $this->surface);
            }
        }
    }

    public function render()
    {
        return view('livewire.virtual-studio', [
            'products' => Product::with('images')->paginate(12),
        ]);
    }
}
