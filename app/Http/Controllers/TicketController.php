<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Demande;
use App\Models\User;
use App\Models\Historique;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
//use PDF;

class TicketController extends Controller
{
    public function create(Demande $demande)
    {
        $techniciens = User::where('role', 'technicien')->get();
        return view('tickets.create', compact('demande', 'techniciens'));
    }
    public function addDescription(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'description' => 'required|string'
        ]);
    
        $ticket->description = $validated['description'];
        $ticket->save();
    
        return redirect()->back()->with('success', 'Description ajoutée avec succès');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'demande_id' => 'required|exists:demandes,id',
            'observation' => 'required|string',
            'technicien_id' => 'required|exists:users,id'
        ]);

        $ticket = Ticket::create($validated);
        
        // Update demande status
        $demande = Demande::find($request->demande_id);
        $demande->update(['statut' => 'affecté en cours']);

        return redirect()->route('demandes.list')
            ->with('success', 'Ticket créé avec succès');
    }

    public function index()
    {
        $tickets = Ticket::with(['demande', 'technicien'])->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function markAsProcessed(Ticket $ticket)
    {
        $ticket->status = 'traité';
        $ticket->save();

        $ticket->demande->update(['statut' => 'traité']);

        return back()->with('success', 'Ticket marqué comme traité');
    }

    public function updateObservation(Request $request, Ticket $ticket)
    {
        $validated = $request->validate([
            'observation' => 'required|string'
        ]);

        $ticket->observation = $validated['observation'];
        $ticket->save();

        return back()->with('success', 'Observation mise à jour');
    }
    public function addObservation(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'observation' => 'required|string'
        ]);
        
        $observation = new Observation();
        $observation->ticket_id = $validated['ticket_id'];
        $observation->content = $validated['observation'];
        $observation->user_id = auth()->id();
        $observation->save();
        
        return response()->json([
            'success' => true,
            'observation' => $validated['observation']
        ]);
    }

    public function generatePdf(Ticket $ticket)
    {
        $pdf = PDF::loadView('tickets.pdf', [
            'ticket' => $ticket,
            'demande' => $ticket->demande
        ]);

        return $pdf->download('ticket-'.$ticket->id.'.pdf');
    }
}