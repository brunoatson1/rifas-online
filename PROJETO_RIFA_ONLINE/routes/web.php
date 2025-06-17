<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RifaController;

Route::get('/', [RifaController::class, 'index'])->name('home');
Route::get('/rifas/{rifa}', [RifaController::class, 'show'])->name('rifas.show');

// Rotas de autenticação
Auth::routes();

// Área administrativa
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    // Outras rotas admin...
});