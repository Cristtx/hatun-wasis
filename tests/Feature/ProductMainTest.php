<?php

use App\Livewire\ProductMain;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;

test('product main component can be rendered and save works', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(ProductMain::class)
        ->assertStatus(200)
        ->set('nombre', 'Piedra marfil')
        ->set('descripcion', 'Piedra para construccion')
        ->set('cantidad', 10)
        ->set('precio', 25.50)
        ->set('disponible', true)
        ->call('save');

    expect(Product::count())->toBe(1);
});

test('product main component validation fails when disponible is false', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(ProductMain::class)
        ->set('nombre', 'Piedra marfil')
        ->set('descripcion', 'Piedra para construccion')
        ->set('cantidad', 10)
        ->set('precio', 25.50)
        ->set('disponible', false)
        ->call('save')
        ->assertHasErrors(['disponible']);
});
