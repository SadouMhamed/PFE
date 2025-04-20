<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard/demande/create', [DemandeController::class, 'showForm'])->name('demande.show');   
    Route::post('/dashboard/demande', [DemandeController::class, 'handleForm'])->name('demande.submit');
    Route::get('/dashboard/demandes', [DemandeController::class, 'listDemandes'])->name('demandes.list');
    // Add these inside your auth middleware group
    // Add these routes in your web.php
    Route::get('/tickets/create/{demande}', [TicketController::class, 'create'])->name('tickets.create');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::patch('/tickets/{ticket}/process', [TicketController::class, 'markAsProcessed'])->name('tickets.markAsProcessed');
    Route::patch('/tickets/{ticket}/observation', [TicketController::class, 'updateObservation'])->name('tickets.updateObservation');
    Route::get('/tickets/{ticket}/pdf', [TicketController::class, 'generatePdf'])->name('tickets.generatePdf');
});

require __DIR__.'/auth.php';
