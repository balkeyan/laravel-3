<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PermissieController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPermissieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Iedereen mag het overzicht zien
Route::get('/games', [GameController::class, 'index']);

// Alleen de admin mag games toevoegen, bewerken en verwijderen
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/games/create', [GameController::class, 'create']);
    Route::post('/games/store', [GameController::class, 'store']);
    Route::get('/games/edit/{id}', [GameController::class, 'edit']);
    Route::post('/games/update/{id}', [GameController::class, 'update']);
    Route::post('/games/destroy/{id}', [GameController::class, 'destroy']);
});

require __DIR__.'/auth.php';

Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');

// Beheeromgeving, alleen voor de admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // permissies
    Route::get('/beheer/permissies', [PermissieController::class, 'index']);
    Route::get('/beheer/permissies/create', [PermissieController::class, 'create']);
    Route::post('/beheer/permissies/store', [PermissieController::class, 'store']);
    Route::get('/beheer/permissies/edit/{id}', [PermissieController::class, 'edit']);
    Route::post('/beheer/permissies/update/{id}', [PermissieController::class, 'update']);
    Route::post('/beheer/permissies/destroy/{id}', [PermissieController::class, 'destroy']);

    // rollen
    Route::get('/beheer/rollen', [RolController::class, 'index']);
    Route::get('/beheer/rollen/create', [RolController::class, 'create']);
    Route::post('/beheer/rollen/store', [RolController::class, 'store']);
    Route::get('/beheer/rollen/edit/{id}', [RolController::class, 'edit']);
    Route::post('/beheer/rollen/update/{id}', [RolController::class, 'update']);
    Route::post('/beheer/rollen/destroy/{id}', [RolController::class, 'destroy']);

    // permissie koppelen aan rol
    Route::get('/beheer/rol-permissies', [RolPermissieController::class, 'index']);
    Route::get('/beheer/rol-permissies/create', [RolPermissieController::class, 'create']);
    Route::post('/beheer/rol-permissies/store', [RolPermissieController::class, 'store']);
    Route::get('/beheer/rol-permissies/edit/{permission_id}/{role_id}', [RolPermissieController::class, 'edit']);
    Route::post('/beheer/rol-permissies/update/{permission_id}/{role_id}', [RolPermissieController::class, 'update']);
    Route::post('/beheer/rol-permissies/destroy/{permission_id}/{role_id}', [RolPermissieController::class, 'destroy']);
});
