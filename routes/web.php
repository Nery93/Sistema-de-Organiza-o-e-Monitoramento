<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/produtos/{slug}/edit', [ProdutoController::class, 'edit'])->name('produto.edit');
Route::get('/produtos/{sort?}/{direction?}', [ProdutoController::class,'index'])->name('produto.index');

Route::get('/create', [ProdutoController::class,'create'])->name('produto.create');
Route::post('/store', [ProdutoController::class,'store'])->name('produto.store');

Route::put('/produtos/{slug}', [ProdutoController::class, 'update'])->name('produto.update');

Route::get('produto/export', [ProdutoController::class, 'export'])->name('produtos.export');
Route::post('produto/export', [ProdutoController::class, 'handleExport'])->name('produtos.handleExport');
Route::get('/subcategorias/{categoriaId}', [ProdutoController::class, 'getSubcategorias'])->name('produto.subcategorias');
