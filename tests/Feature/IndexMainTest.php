<?php

use App\Livewire\IndexMain;
use App\Models\Product;
use Livewire\Livewire;

test('index main component can be rendered', function () {
    Livewire::test(IndexMain::class)
        ->assertStatus(200);
});

test('index main shows product details', function () {
    Product::factory()->create([
        'nombre' => 'Test Product',
        'descripcion' => 'This is a test product description',
        'cantidad' => 5,
        'precio' => 99.99,
        'disponible' => true,
    ]);

    Livewire::test(IndexMain::class)
        ->assertSee('Test Product')
        ->assertSee('This is a test product description')
        ->assertSee('99.99');
});
