<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\BureauDePoste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BureauPerformanceController extends Controller
{
    public function index()
    {
        // Get performance metrics for all bureaux
        $metrics = BureauDePoste::withCount([
            'demandes',
            'demandes as resolved_count' => function ($query) {
                $query->where('statut', 'résolu');
            },
            'demandes as pending_count' => function ($query) {
                $query->where('statut', 'non affecté');
            },
            'demandes as in_progress_count' => function ($query) {
                $query->where('statut', 'en cours');
            }
        ])
        ->withAvg('demandes', DB::raw('EXTRACT(EPOCH FROM (updated_at - created_at))/3600 as resolution_time'))
        ->get();

        return view('admin.performance.index', compact('metrics'));
    }
}