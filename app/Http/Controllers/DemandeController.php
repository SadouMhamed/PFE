<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\BureauDePoste;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Historique;
use PDF;

class DemandeController extends Controller
{

    // Charge le Dashboard avec ou sans le formulaire
    public function dashboard()
    {
        return view('dashboard', ['showForm' => false]);
    }
    
    //
    public function showForm()
    {
        // Get the current user's wilaya_id
        $userWilayaId = auth()->user()->wilaya_id;
        
        // Filter bureau de postes by the user's wilaya_id
        $bureauDePostes = BureauDePoste::where('wilaya_id', $userWilayaId)->get();
        
        //dd($bureauDePostes);
        return view('demandes.create', compact('bureauDePostes'));
    }
    
    public function handleForm(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', 'Vous devez être connecté pour soumettre une demande.');
        }
           
        $validatedData = $request->validate([
            'typeProbleme' => 'required|string|in:hardware,software,réseau',
            'description' => 'required|min:10',
            'statut' => 'required|in:non affecté',
            'bureau_de_poste_id' => 'required|exists:bureau_de_postes,id',
        ]);
    
        $validatedData['user_id'] = auth()->id();
    
        // Create demande
        $demande = Demande::create($validatedData);
    
        // Create initial history entry with properly quoted string
        Historique::create([
            /*'demande_id' => $demande->id,
            'status' => 'non affecté',
            'description' => 'Demande créée',
            'user_id' => auth()->id():*/
            'type' => 'demande',
            'reference_id' => $demande->id,
            'old_status' => null,
            'new_status' => $demande->statut,
            'description' => 'Demande créée et en attente de traitement.',
            'updated_by' => auth()->id()
        ]);
    
        return back()->with('success', 'Demande enregistrée avec succès !');
    }
    public function listDemandes()
    {
        $demandes = Demande::with('bureauDePoste')->latest()->get();
        return view('demandes-list', compact('demandes'));
    }
    public function showHistorique()
    {
        $historiques = Historique::with(['demande', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('historique', compact('historiques'));
    }
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|string'
        ]);

        $demande = Demande::findOrFail($id);
        $oldStatus = $demande->statut;
        $newStatus = $request->input('statut');

        if ($oldStatus !== $newStatus) {
            $demande->statut = $newStatus;
            $demande->save();

            Historique::create([
                'type' => 'demande',
                'reference_id' => $demande->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
                'updated_by' => auth()->id()
            ]);
        }

        return back()->with('success', 'Le statut a été mis à jour avec succès.');
    }

    public function show(Demande $demande)
    {
        return view('demandes.show', compact('demande'));
    }

    public function generatePDF(Demande $demande)
    {
        $pdf = PDF::loadView('demandes.pdf', compact('demande'));
        return $pdf->download('demande-'.$demande->id.'.pdf');
    }
}
