<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

class IndexMain extends Component
{
    #[Layout('layouts.index')]
    public function render()
    {
        $productos = Product::latest()->take(8)->get();

        return view('livewire.index-main', compact('productos'));
    }
}
