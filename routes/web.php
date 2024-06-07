<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

Route::get('/add', [RedirectController::class, 'add'])->name('add');
Route::get('/edit', [RedirectController::class, 'edit'])->name('edit');
Route::get('/list', [RedirectController::class, 'list'])->name('list');
Route::get('/view', [RedirectController::class, 'view'])->name('view');


// web.php
Route::get('/documents/search', [DocumentController::class, 'search'])->name('document.search');
Route::get('/documents/download-csv', [DocumentController::class, 'downloadCsv'])->name('document.downloadCsv');
Route::post('/documents/bulk-delete', [DocumentController::class, 'bulkDelete'])->name('document.bulkDelete');


Route::get('/', [DocumentController::class, 'index'])->name('document.index');
Route::get('document/edit/{id}', [documentController::class, 'edit'])->name('document.edit');
Route::delete('document/delete/{id}', [DocumentController::class, 'delete'])->name('document.delete');
Route::post('document', [DocumentController::class, 'save'])->name('document.save');
Route::post('document/save', [DocumentController::class, 'store'])->name('document.save');
Route::post('document/update/{id}', [DocumentController::class, 'update'])->name('document.update');


Route::fallback([RedirectController::class, 'notFound'])->name('notFound');
