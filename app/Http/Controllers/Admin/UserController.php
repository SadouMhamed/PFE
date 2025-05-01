<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilaya;
use App\Models\BureauDePoste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        // Get the current admin user
        $currentUser = Auth::user();
        
        // If the user has a wilaya_id, only show bureau de postes for that wilaya
        // Otherwise, show all bureau de postes (for super admin)
        if ($currentUser->wilaya_id) {
            $wilayas = Wilaya::where('id', $currentUser->wilaya_id)->get();
            $bureauDePostes = BureauDePoste::where('wilaya_id', $currentUser->wilaya_id)->get();
        } else {
            $wilayas = Wilaya::all();
            $bureauDePostes = BureauDePoste::all();
        }
        
        return view('admin.users.create', compact('wilayas', 'bureauDePostes'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'wilaya_id' => ['required', 'exists:wilayas,id'],
        ]);
        
        $currentUser = Auth::user();
        $wilayaId = $currentUser->wilaya_id ? $currentUser->wilaya_id : $request->wilaya_id;
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'wilaya_id' => $wilayaId, // Use the calculated wilayaId
        ]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user created successfully');
    }
    
    public function edit(User $user)
    {
        // Get the current admin user
        $currentUser = Auth::user();
        
        // If the user has a wilaya_id, only show bureau de postes for that wilaya
        // Otherwise, show all bureau de postes (for super admin)
        if ($currentUser->wilaya_id) {
            $wilayas = Wilaya::where('id', $currentUser->wilaya_id)->get();
            $bureauDePostes = BureauDePoste::where('wilaya_id', $currentUser->wilaya_id)->get();
        } else {
            $wilayas = Wilaya::all();
            $bureauDePostes = BureauDePoste::all();
        }
        
        return view('admin.users.edit', compact('user', 'wilayas', 'bureauDePostes'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'wilaya_id' => ['required', 'exists:wilayas,id'],
        ]);
        
        $currentUser = Auth::user();
        $wilayaId = $currentUser->wilaya_id ? $currentUser->wilaya_id : $request->wilaya_id;
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'wilaya_id' => $wilayaId, // Use the calculated wilayaId
        ];
        
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }
        
        $user->update($data);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user updated successfully');
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user deleted successfully');
    }
}
