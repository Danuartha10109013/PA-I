<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KadminController extends Controller
{
    public function index(){
        // dd()
        if (Auth::user()->role != 2){
            return redirect()->route('admin.dashboard');
            
        }
        $data = User::whereNot('role', 1)->orderBy('role','desc')->get();
        return view('pages.admin.k-admin.index',compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'active' => 'required|boolean',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'signature' => 'required|mimes:png|max:2048',
        ]);

        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
        } else {
            return redirect()->back()->withErrors(['signature' => 'Signature is required.']);
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 0,
            'active' => $request->active,
            'email' => $request->email,
            'signature' => $signaturePath,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.k-admin')->with('success', 'User added successfully.');
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'active' => 'required|boolean',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable',
            'signature' => 'nullable|mimes:png|max:2048',
        ]);

        if ($request->hasFile('signature')) {
            // Delete old signature if exists
            if ($user->signature) {
                Storage::disk('public')->delete($user->signature);
            }
            $signaturePath = $request->file('signature')->store('signatures', 'public');
        } else {
            $signaturePath = $user->signature; // Keep the old signature if not updated
        }

        // Handle password change if provided
        if ($request->filled('password')) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
                'signature' => $signaturePath ?? $user->signature,
                'password' =>  Hash::make($request->password),
            ]);
        }else{

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
                'signature' => $signaturePath ?? $user->signature,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        return redirect()->route('admin.k-admin')->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.k-admin')->with('success', 'User deleted successfully.');
    }
}
