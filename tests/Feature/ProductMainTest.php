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

test('product main component can be saved with disponible as false', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    Livewire::test(ProductMain::class)
        ->set('nombre', 'Piedra marfil')
        ->set('descripcion', 'Piedra para construccion')
        ->set('cantidad', 10)
        ->set('precio', 25.50)
        ->set('disponible', false)
        ->call('save')
        ->assertHasNoErrors();

    expect(Product::where('disponible', false)->count())->toBe(1);
});

test('product availability can be toggled', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $product = Product::factory()->create(['disponible' => true]);

    Livewire::test(ProductMain::class)
        ->call('toggleDisponible', $product);

    $product->refresh();
    expect($product->disponible)->toBe(false);

    Livewire::test(ProductMain::class)
        ->call('toggleDisponible', $product);

    $product->refresh();
    expect($product->disponible)->toBe(true);
});
