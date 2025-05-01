<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TechnicienController;
use App\Http\Controllers\BureauAccountController;
use App\Http\Controllers\NotificationController;



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
    // User routes - allow access for users, admins, and technicians
    Route::middleware(['auth', 'role:user,admin,technicien'])->group(function () {
        Route::get('/demande/create', [DemandeController::class, 'showForm'])->name('demande.show');   
        Route::post('/demande', [DemandeController::class, 'handleForm'])->name('demande.submit');
    });
    Route::get('/dashboard/demandes', [DemandeController::class, 'listDemandes'])->name('demandes.list');
    
    // Combine all ticket-related routes in one group
    // Combined routes for both admin and technicien roles
    Route::middleware(['auth', 'role:admin,technicien'])->group(function () {
        // Ticket routes
        Route::get('/tickets/create/{demande}', [TicketController::class, 'create'])->name('tickets.create');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::patch('/tickets/{ticket}/process', [TicketController::class, 'markAsProcessed'])->name('tickets.markAsProcessed');
        Route::patch('/tickets/{ticket}/observation', [TicketController::class, 'updateObservation'])->name('tickets.updateObservation');
        Route::get('/tickets/{ticket}/pdf', [TicketController::class, 'generatePdf'])->name('tickets.generatePdf');
        
        // Bureau accounts management
        Route::resource('bureau-accounts', BureauAccountController::class);
    });
    
    // Admin-only routes
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('techniciens', TechnicienController::class);
    });
    
    // Add this new route for the addObservation method
    // Modifiez ces routes pour utiliser PATCH au lieu de POST
    Route::patch('/tickets/{ticket}/add-observation', [TicketController::class, 'updateObservation'])
        ->middleware(['auth'])
        ->name('tickets.addObservation');
    
    Route::patch('/tickets/{ticket}/add-description', [TicketController::class, 'addDescription'])
        ->middleware(['auth'])
        ->name('tickets.addDescription');
    Route::get('/demandes/{demande}', [App\Http\Controllers\DemandeController::class, 'show'])
        ->name('demandes.show');
    
    Route::get('/demandes/{demande}/pdf', [DemandeController::class, 'generatePDF'])
        ->name('demandes.pdf')
        ->middleware('auth');
});

require __DIR__.'/auth.php';


// Bureau de Poste Import Routes
Route::get('/admin/bureau-de-poste/import', [BureauDePosteController::class, 'importForm'])->name('bureau-de-poste.import.form');
Route::post('/admin/bureau-de-poste/import', [BureauDePosteController::class, 'import'])->name('bureau-de-poste.import');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // User management routes
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});
