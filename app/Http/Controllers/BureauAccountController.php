<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BureauDePoste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BureauAccountController extends Controller
{
    public function create()
    {
        $bureauDePostes = BureauDePoste::all();
        return view('admin.bureau-accounts.create', compact('bureauDePostes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'bureau_de_poste_id' => 'required|exists:bureau_de_postes,id'
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user',
            'bureau_de_poste_id' => $validated['bureau_de_poste_id']
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Bureau de Poste account created successfully');
    }
}