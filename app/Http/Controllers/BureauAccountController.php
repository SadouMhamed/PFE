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
    
        return redirect()->route('bureau-accounts.index')
            ->with('success', 'Bureau de Poste account has been created successfully!');
    }

    public function edit(User $bureauAccount)
    {
        $bureauDePostes = BureauDePoste::all();
        return view('admin.bureau-accounts.edit', [
            'user' => $bureauAccount,
            'bureauDePostes' => $bureauDePostes
        ]);
    }

    public function update(Request $request, User $bureauAccount)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $bureauAccount->id,
            'bureau_de_poste_id' => 'required|exists:bureau_de_postes,id',
            'password' => 'nullable|string|min:8',
        ]);
    
        $bureauAccount->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'bureau_de_poste_id' => $validated['bureau_de_poste_id'],
        ]);
    
        if (!empty($validated['password'])) {
            $bureauAccount->update(['password' => Hash::make($validated['password'])]);
        }
    
        return redirect()->route('bureau-accounts.index')
            ->with('success', 'Account updated successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('bureau-accounts.index')
            ->with('success', 'Account deleted successfully!');
    }

    public function index()
    {
        $users = User::where('role', 'user')
            ->with('bureauDePoste')
            ->get();
        
        return view('admin.bureau-accounts.index', compact('users'));
    }
}