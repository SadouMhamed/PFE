<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wilaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        $wilayas = Wilaya::all();
        return view('admin.users.create', compact('wilayas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'wilaya_id' => ['required', 'exists:wilayas,id'],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'wilaya_id' => $request->wilaya_id,
        ]);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'Admin user created successfully');
    }
    
    public function edit(User $user)
    {
        $wilayas = Wilaya::all();
        return view('admin.users.edit', compact('user', 'wilayas'));
    }
    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'wilaya_id' => ['required', 'exists:wilayas,id'],
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'wilaya_id' => $request->wilaya_id,
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
