<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;
use App\Models\BureauDePoste;

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
        $bureauDePostes = BureauDePoste::all();
        return view('dashboard', [
            'showForm' => true,
            'bureauDePostes' => $bureauDePostes
        ]);
    }
    public function handleForm(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
        return back()->with('error', 'Vous devez être connecté pour soumettre une demande.');}
       
        // Validate inputs
        $validatedData = $request->validate([
            'typeProbleme' => 'required|string|in:hardware,software,réseau',
            'description' => 'required|min:10',
            'statut' => 'required|in:non affecté',
            'bureau_de_poste_id' => 'required|exists:Bureau_de_poste,id',
        ]);

        // Ajouter l'ID de l'utilisateur connecté
         $validatedData['user_id'] = auth()->id();

        // Save in database
        Demande::create($validatedData);

        return back()->with('success', 'Demande enregistrée avec succès !');
    }
    public function listDemandes()
    {
        $demandes = Demande::with('bureauDePoste')->latest()->get();
        return view('demandes-list', compact('demandes'));
    }

}
