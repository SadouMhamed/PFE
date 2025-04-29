<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StatusHistory;
use App\Models\Historique;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Update the route name to match web.php
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');  // This matches the route name in web.php
        }
        
        // Statistics for regular dashboard
        $ticketsCount = Ticket::count();
        $demandesCount = Demande::count();
        $techniciensCount = User::where('role', 'technicien')->count();
        $bureauDePostes = \App\Models\BureauDePoste::all();
        
        return view('dashboard', compact(
            'ticketsCount',
            'demandesCount',
            'techniciensCount',
            'bureauDePostes'
        ));
    }

    public function adminDashboard()
    {
        // Enhanced statistics
        $totalDemandes = Demande::count();
        $totalTickets = Ticket::count();
        $totalTechniciens = User::where('role', 'technicien')->count();
        
        // Detailed ticket statistics
        $ticketStats = [
            'total' => $totalTickets,
            'handled' => Ticket::whereNotNull('technicien_id')->count(),
            'completed' => Ticket::where('status', 'traité')->count(),
            'pending' => Ticket::where('status', 'en_cours')->count(),
            'unassigned' => Ticket::whereNull('technicien_id')->count(),
        ];
        $pendingIssues = Ticket::where('status', 'en_cours')->count();
    
        // Get technician performance metrics
        $technicienPerformance = User::where('role', 'technicien')
            ->withCount(['tickets as completed_tickets' => function($query) {
                $query->where('status', 'traité');
            }])
            ->withAvg('tickets as average_resolution_time', \DB::raw('EXTRACT(EPOCH FROM (updated_at - created_at))/3600'))
            ->get()
            ->map(function($technicien) {
                return [
                    'name' => $technicien->name,
                    'completed_tickets' => $technicien->completed_tickets,
                    'average_time' => round($technicien->average_resolution_time ?? 0, 1),
                ];
            });
    
        // Get recent activities
        $recentDemandes = Demande::with(['bureauDePoste', 'user'])
            ->latest()
            ->take(5)
            ->get();
    
        $recentTickets = Ticket::with(['technicien', 'demande'])
            ->latest()
            ->take(5)
            ->get();
    
        // Get history data for demandes and tickets
        $demandeHistoriques = Historique::with(['demande', 'user'])
            ->latest()
            ->take(10)
            ->get();
            
        $ticketHistoriques = StatusHistory::where('trackable_type', 'App\Models\Ticket')
            ->with('trackable')
            ->latest()
            ->take(10)
            ->get();
    
        $statusHistories = StatusHistory::with('trackable')
            ->latest()
            ->take(10)
            ->get();
    
        return view('admin.dashboard', compact(
            'ticketStats',
            'technicienPerformance',
            'totalTechniciens',
            'statusHistories',
            'demandeHistoriques',
            'ticketHistoriques',
            'recentDemandes',
            'recentTickets'
        ));
    }
}