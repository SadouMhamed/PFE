<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Problem Type Distribution
        $problemTypes = Demande::select('typeProbleme', DB::raw('count(*) as total'))
            ->groupBy('typeProbleme')
            ->get();
            
        // Response Time Analytics
        $avgResponseTime = Ticket::selectRaw('AVG(EXTRACT(EPOCH FROM (created_at - demande.created_at))/3600) as avg_response_time')
            ->join('demandes', 'tickets.demande_id', '=', 'demandes.id')
            ->first();
            
        // Monthly Trends
        $monthlyTrends = Demande::select(
            DB::raw('DATE_TRUNC(\'month\', created_at) as month'),
            DB::raw('count(*) as total_demandes')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();
        
        return view('admin.analytics.index', compact('problemTypes', 'avgResponseTime', 'monthlyTrends'));
    }
}