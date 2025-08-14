<?php

use App\Http\Controllers\{AuthController, LojaController, ProdutoController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/lojas', [LojaController::class, 'index'])->name('lojas.index');
    Route::post('/lojas', [LojaController::class, 'store'])->name('lojas.store');
    Route::get('/lojas/{loja}', [LojaController::class, 'show'])->name('lojas.show');
    Route::put('/lojas/{loja}', [LojaController::class, 'update'])->name('lojas.update');
    Route::delete('/lojas/{loja}', [LojaController::class, 'destroy'])->name('lojas.destroy');

    Route::get('/lojas/{loja}/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::post('/lojas/{loja}/produtos', [ProdutoController::class,  'store'])->name('produtos.store');
    Route::put('/lojas/{loja}/produtos', [ProdutoController::class,  'update'])->name('produtos.update');

    Route::get('/lojas/{loja}/produtos/{produto}', [ProdutoController::class, 'show'])->name('loja.produtos.show');
    Route::delete('/lojas/{loja}/produtos/{produto}', [ProdutoController::class, 'destroy'])->name('loja.produtos.destroy');
    Route::put('/lojas/{loja}/produtos/{produto}', [ProdutoController::class, 'update'])->name('loja.produtos.update');
});
