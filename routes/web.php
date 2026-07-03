<?php

use App\Livewire\Dashboard;
use App\Livewire\IndexMain;
use App\Livewire\Tablones;
use App\Livewire\Pegamentos;
use App\Livewire\VirtualStudio;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexMain::class)->name('home');
Route::get('/tablones', Tablones::class)->name('tablones');
Route::get('/pegamentos', Pegamentos::class)->name('pegamentos');
Route::get('/estudio-virtual', VirtualStudio::class)->name('virtual-studio');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

require __DIR__.'/settings.php';
