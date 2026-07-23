<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\KitController;
use App\Http\Controllers\ChangeHistoryController;

// Route::view('/', 'welcome')->name('home');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/', 'dashboard')->name('dashboard');

    Route::get('/filters', [FilterController::class, 'index'])->name('filters');
    Route::get('/filters/create', [FilterController::class, 'create'])->name('filters.create');
    Route::post('/filters', [FilterController::class, 'store'])->name('filters.store');
    Route::get('/filters/{filter}/edit', [FilterController::class, 'edit'])->name('filters.edit');
    Route::put('/filters/{filter}', [FilterController::class, 'update'])->name('filters.update');
    Route::delete('/filters/{filter}', [FilterController::class, 'destroy'])->name('filters.destroy');


    Route::get('/kits', [KitController::class, 'index'])->name('kits');
    Route::get('/kits/create', [KitController::class, 'create'])->name('kits.create');
    Route::post('/kits', [KitController::class, 'store'])->name('kits.store');
    Route::get('/kits/{kit}/edit', [KitController::class, 'edit'])->name('kits.edit');
    Route::put('/kits/{kit}', [KitController::class, 'update'])->name('kits.update');
    Route::delete('/kits/{kit}', [KitController::class, 'destroy'])->name('kits.destroy');
   
    Route::get('/history', [ChangeHistoryController::class, 'index'])->name('history');
    Route::post('/history/create', [ChangeHistoryController::class, 'create'])->name('history.create');
    Route::post('/history', [ChangeHistoryController::class, 'store'])->name('history.store');
    // Route::resource('filter', FilterController::class);
});

require __DIR__.'/settings.php';
