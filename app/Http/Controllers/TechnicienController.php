<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicienController extends Controller
{
    public function index()
    {
        $techniciens = User::where('role', 'technicien')->get();
        return view('admin.techniciens.index', compact('techniciens'));
    }

    public function create()
    {
        return view('admin.techniciens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'technicien',
        ]);

        return redirect()->route('techniciens.index')
            ->with('success', 'Technicien created successfully');
    }

    public function edit(User $technicien)
    {
        return view('admin.techniciens.edit', compact('technicien'));
    }

    public function update(Request $request, User $technicien)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $technicien->id,
        ]);

        $technicien->update($validated);

        return redirect()->route('techniciens.index')
            ->with('success', 'Technicien updated successfully');
    }

    public function destroy(User $technicien)
    {
        $technicien->delete();
        return redirect()->route('techniciens.index')
            ->with('success', 'Technicien deleted successfully');
    }
}