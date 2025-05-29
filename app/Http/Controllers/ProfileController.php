<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('pages.profile.index',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|confirmed|min:8',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional profile picture
        ]);
    
        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
    
        // Handle password change if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Handle profile picture upload
        if ($request->hasFile('profile')) {
            // Delete old profile picture if it exists
            if ($user->profile) {
                Storage::delete($user->profile);
            }
    
            // Define the storage path as "public/storage/profile/id/original_filename"
            $filename = $request->file('profile')->getClientOriginalName();
            $path = $request->file('profile')->storeAs("profile/{$user->id}", $filename, 'public'); // Save to public disk
    
            // Save only the relative path (profile/id/original_filename) to the database
            $user->profile = "profile/{$user->id}/{$filename}";
        }
    
        // Save the updated user data
        $user->save();
    
        // Redirect back with a success message
        return redirect()->route('profile', $user->id)->with('success', 'Profile updated successfully.');
    }
    

}
