<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/add', [RedirectController::class, 'add'])->name('add');
Route::get('/edit', [RedirectController::class, 'edit'])->name('edit');
Route::get('/list', [RedirectController::class, 'list'])->name('list');
Route::get('/view', [RedirectController::class, 'view'])->name('view');


Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
// Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
Route::get('document/edit/{id}', [documentController::class, 'edit'])->name('document.edit');
Route::post('document/update/{id}', [DocumentController::class, 'update'])->name('document.update');
Route::delete('document/delete/{id}', [DocumentController::class, 'delete'])->name('document.delete');
Route::post('document', [DocumentController::class, 'save'])->name('document.save');



// Route::get('/', function () {
//     return view('welcome');
// });
