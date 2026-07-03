<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class IndexMain extends Component
{
    use WithPagination;

    public $search = '';
    public $category = ''; // '', 'tablones', 'pegamentos'

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCategory(): void
    {
        $this->resetPage();
    }

    #[Layout('layouts.index')]
    public function render()
    {
        $query = Product::query()->where('disponible', true);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nombre', 'like', '%'.$this->search.'%')
                  ->orWhere('descripcion', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->category === 'tablones') {
            $query->where(function ($q) {
                $q->where('descripcion', 'like', '%Categoría: Tablón%')
                  ->orWhere('nombre', 'like', '%Tablón%');
            });
        } elseif ($this->category === 'pegamentos') {
            $query->where(function ($q) {
                $q->where('descripcion', 'like', '%Categoría: Pegamento%')
                  ->orWhere('nombre', 'like', '%Pegamento%');
            });
        }

        $productos = $query->latest()->paginate(8);

        return view('livewire.index-main', compact('productos'));
    }
}
