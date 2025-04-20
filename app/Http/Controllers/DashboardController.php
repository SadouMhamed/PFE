<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Demande;
use App\Models\User;
use App\Models\BureauDePoste;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ticketsCount = Ticket::count();
        $demandesCount = Demande::count();
        $techniciensCount = User::where('role', 'technicien')->count();
        $bureauDePostes = BureauDePoste::all();

        return view('dashboard', compact('ticketsCount', 'demandesCount', 'techniciensCount', 'bureauDePostes'));
    }
}