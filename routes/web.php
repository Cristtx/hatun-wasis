<?php

use App\Livewire\Dashboard;
use App\Livewire\IndexMain;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexMain::class)->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});

require __DIR__.'/settings.php';
