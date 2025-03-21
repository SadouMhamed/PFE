<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demande;

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
        return view('dashboard', ['showForm' => true]);
    }
    public function handleForm(Request $request)
    {
        // Vérifier si l'utilisateur est connecté
        if (!auth()->check()) {
        return back()->with('error', 'Vous devez être connecté pour soumettre une demande.');}
       
        // Validate inputs
        $validatedData = $request->validate([
            'typeProbleme' => 'required|string|max:255',
            'description' => 'required|min:10',
            'statut' => 'required|in:non affecté,affecté en cours,affecté en attente,traité,clôturé',
        ]);

        // Ajouter l'ID de l'utilisateur connecté
         $validatedData['user_id'] = auth()->id();

        // Save in database
        Demande::create($validatedData);

        return back()->with('success', 'Demande enregistrée avec succès !');
    }
    public function listDemandes()
    {
        $demandes = Demande::latest()->get(); // Fetch all demandes sorted by latest
        return view('demandes-list', compact('demandes'));
    }

}
