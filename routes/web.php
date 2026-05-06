<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CotxeController;
use App\Http\Controllers\ComentariController;
use App\Http\Controllers\ModController;

Route::get('/', [CotxeController::class, 'index']);

Route::get('/cotxes/{cotxe}', [CotxeController::class, 'show'])->name('cotxes.show');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cotxes', CotxeController::class)
        ->except(['show'])
        ->parameters(['cotxes' => 'cotxe']);
        
    Route::resource('comentaris', ComentariController::class)->except(['index', 'show', 'create', 'edit']);

    Route::post('/mods', [ModController::class, 'store'])->name('mods.store');
    Route::put('/mods/{mod}', [ModController::class, 'update'])->name('mods.update');
    Route::delete('/mods/{mod}', [ModController::class, 'destroy'])->name('mods.destroy');

});

require __DIR__ . '/auth.php';