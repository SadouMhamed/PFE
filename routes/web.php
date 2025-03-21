<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;



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
    Route::get('/dashboard/demande/create', [DemandeController::class, 'showForm'])->name('demande.show');   
    Route::post('/dashboard/demande', [DemandeController::class, 'handleForm'])->name('demande.submit');
    Route::get('/dashboard/demandes', [DemandeController::class, 'listDemandes'])->name('demandes.list');

});

require __DIR__.'/auth.php';
