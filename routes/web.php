<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\BureauAccountController;



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
    // User routes
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/demande/create', [DemandeController::class, 'showForm'])->name('demande.show');   
        Route::post('/demande', [DemandeController::class, 'handleForm'])->name('demande.submit');
    });
    Route::get('/dashboard/demandes', [DemandeController::class, 'listDemandes'])->name('demandes.list');
    
    Route::middleware(['auth', 'role:admin,technicien'])->group(function () {
        Route::get('/tickets/create/{demande}', [TicketController::class, 'create'])->name('tickets.create');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::patch('/tickets/{ticket}/process', [TicketController::class, 'markAsProcessed'])->name('tickets.markAsProcessed');
        Route::patch('/tickets/{ticket}/observation', [TicketController::class, 'updateObservation'])->name('tickets.updateObservation');
        Route::get('/tickets/{ticket}/pdf', [TicketController::class, 'generatePdf'])->name('tickets.generatePdf');
    });
    route::middleware(['auth', 'role:technicien'])->group(function () {
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    });
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        
        Route::middleware(['auth', 'role:admin,technicien'])->group(function () {
            Route::resource('bureau-accounts', BureauAccountController::class);
            Route::get('/demande/create', [DemandeController::class, 'showForm'])->name('demande.show');
        });
        // Add technicien routes
        Route::resource('techniciens', TechnicienController::class);
    });
    Route::get('/demandes/{demande}', [App\Http\Controllers\DemandeController::class, 'show'])
        ->name('demandes.show');
    
    Route::get('/demandes/{demande}/pdf', [DemandeController::class, 'generatePDF'])
        ->name('demandes.pdf')
        ->middleware('auth');
});

require __DIR__.'/auth.php';
