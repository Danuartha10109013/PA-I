<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KadminController extends Controller
{
    public function index(){
        $data = User::where('role', 0)->get();
        return view('pages.admin.k-admin.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'active' => 'required|boolean',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'role' => 0,
            'active' => $request->active,
            'email' => $request->email,
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
        ]);

        // Handle password change if provided
        if ($request->filled('password')) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
            ]);
        }else{

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
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
