<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalClientes = Client::count();
        $totalProductos = Product::count();
        $valorInventario = Product::sum(DB::raw('cantidad * precio'));
        $productosBajos = Product::where('cantidad', '<', 5)->latest()->get();
        $disponibilidad = Product::where('disponible', true)->count();

        return view('livewire.dashboard', [
            'totalClientes' => $totalClientes,
            'totalProductos' => $totalProductos,
            'valorInventario' => $valorInventario,
            'productosBajos' => $productosBajos,
            'disponibilidad' => $disponibilidad,
        ]);
    }
}
