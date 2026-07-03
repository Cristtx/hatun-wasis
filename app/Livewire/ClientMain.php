<?php

namespace App\Livewire;

use App\Models\Client;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;

class ClientMain extends Component
{
    use WithPagination;

    public $search;

    public $id;

    public $nombre;

    public $email;

    public $telefono;

    public $direccion;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $clientes = Client::where(function ($query) {
            $query->where('nombre', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orWhere('telefono', 'like', '%'.$this->search.'%');
        })
            ->latest()
            ->paginate();

        return view('livewire.client-main', compact('clientes'));
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|min:4',
            'email' => 'required|email|unique:clients,email,'.$this->id,
            'telefono' => 'nullable',
            'direccion' => 'nullable',
        ]);

        if (! $this->id) {
            Client::create([
                'nombre' => $this->nombre,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);

            Flux::toast(
                heading: 'Cliente registrado.',
                text: 'El registro se realizó correctamente.',
                variant: 'success'
            );
        } else {
            $cliente = Client::find($this->id);
            $cliente->update([
                'nombre' => $this->nombre,
                'email' => $this->email,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion,
            ]);

            Flux::toast(
                heading: 'Cliente actualizado.',
                text: 'El registro se actualizó correctamente.',
                variant: 'success'
            );
        }

        $this->modal('showform')->close();
    }

    public function edit(Client $item)
    {
        $this->id = $item->id;
        $this->nombre = $item->nombre;
        $this->email = $item->email;
        $this->telefono = $item->telefono;
        $this->direccion = $item->direccion;
        $this->modal('showform')->show();
    }

    public function create()
    {
        $this->reset(['id', 'nombre', 'email', 'telefono', 'direccion']);
        $this->modal('showform')->show();
    }

    public function confirm(Client $item)
    {
        $this->id = $item->id;
        $this->modal('delete-client')->show();
    }

    public function delete()
    {
        $cliente = Client::find($this->id);
        $cliente->delete();

        Flux::toast(
            heading: 'Cliente eliminado.',
            text: 'El registro se borró correctamente.',
            variant: 'success'
        );

        $this->modal('delete-client')->close();
    }
}
