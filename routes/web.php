<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmigurumiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/pedido', function () {
    return view('orders.order'); // Aquí estamos indicando la nueva ubicación de la vista
});

Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

// Rutas protegidas por autenticación (middleware auth)
Route::middleware('auth')->group(function () {

    Route::get('amigurumis/{id}/edit', [AmigurumiController::class, 'edit'])->name('amigurumis.edit');
    Route::put('amigurumis/{id}', [AmigurumiController::class, 'update'])->name('amigurumis.update');
    Route::delete('/amigurumis/{id}', [AmigurumiController::class, 'destroy'])->name('amigurumis.destroy');
    Route::get('/amigurumi/{id}', [AmigurumiController::class, 'show'])->name('amigurumi.show');




    // Ruta para ver las órdenes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Ruta para mostrar el formulario de creación de amigurumi
    Route::get('/amigurumis/create', [AmigurumiController::class, 'create'])->name('amigurumis.create');

    // Ruta para almacenar el nuevo amigurumi
    Route::post('/amigurumis', [AmigurumiController::class, 'store'])->name('amigurumis.store');

    // Rutas para editar y eliminar amigurumis
    Route::get('/amigurumis/{amigurumi}/edit', [AmigurumiController::class, 'edit'])->name('amigurumis.edit');
    Route::put('/amigurumis/{amigurumi}', [AmigurumiController::class, 'update'])->name('amigurumis.update');
    Route::delete('/amigurumis/{amigurumi}', [AmigurumiController::class, 'destroy'])->name('amigurumis.destroy');

    // Rutas para categorías (crear, editar, eliminar)
    Route::resource('categories', CategoryController::class);
});

// Ruta para mostrar las categorías
Route::get('/categoria/{category}', [AmigurumiController::class, 'showByCategory'])->name('amigurumis.byCategory');

// Ruta para el home (visible para todos los usuarios)
Route::get('/', [CategoryController::class, 'index'])->name('home');



