<?php

use App\Livewire\ClientMain;
use App\Models\Client;
use App\Models\User;
use Livewire\Livewire;

test('client main component can be rendered and save works', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test(ClientMain::class)
        ->assertStatus(200)
        ->set('nombre', 'Juan Perez')
        ->set('email', 'juan.perez@example.com')
        ->set('telefono', '987654321')
        ->set('direccion', 'Av. Siempre Viva 123')
        ->call('save');

    expect(Client::count())->toBe(1);
    $client = Client::first();
    expect($client->nombre)->toBe('Juan Perez');
    expect($client->email)->toBe('juan.perez@example.com');
});

test('client main component validation fails when required fields are missing', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Missing nombre (or too short) and missing email
    Livewire::test(ClientMain::class)
        ->set('nombre', 'Jua') // min:4
        ->set('email', '')
        ->call('save')
        ->assertHasErrors(['nombre', 'email']);
});

test('client main component validation fails when email is not unique', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    // Create an existing client
    Client::factory()->create([
        'email' => 'duplicate@example.com',
    ]);

    Livewire::test(ClientMain::class)
        ->set('nombre', 'Juan Perez')
        ->set('email', 'duplicate@example.com')
        ->call('save')
        ->assertHasErrors(['email']);
});

test('client can be updated', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $client = Client::factory()->create([
        'nombre' => 'Old Name',
        'email' => 'old.email@example.com',
    ]);

    Livewire::test(ClientMain::class)
        ->call('edit', $client->id)
        ->set('nombre', 'New Name')
        ->set('email', 'new.email@example.com')
        ->call('save');

    $client->refresh();
    expect($client->nombre)->toBe('New Name');
    expect($client->email)->toBe('new.email@example.com');
});

test('client can be deleted', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $client = Client::factory()->create();

    Livewire::test(ClientMain::class)
        ->call('confirm', $client->id)
        ->call('delete');

    expect(Client::count())->toBe(0);
});
