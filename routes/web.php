<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

//Route::view('dashboard', 'dashboard')
Route::get('/', [HomeController::class, 'index']); // aquí indicamos que dentro de la vista a la que hacemos referencia ejecutamos la función index
Route::get('/{slug}', [HomeController::class, 'view']);
//Route::view('dashboard', 'dashboard')
  //  ->middleware(['auth', 'verified'])
   // ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

