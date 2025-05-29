<?php

namespace App\Http\Controllers;

use App\Models\KontakM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KKontakController extends Controller
{
    public function index(){
        $data = KontakM::all();
        return view('pages.admin.k-kontak.index',compact('data'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'operation_time' => 'required|string|max:255',
            'profile' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Limit to image types and size
        ]);

        // Retrieve the uploaded file
        $profile = $request->file('profile');

        // Define the storage path
        $profilePath = $profile->getClientOriginalName();

        // Store the file
        $profile->storeAs('kontak', $profilePath,'public');


        // Create a new Kontak record
        KontakM::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'operation_time' => $request->operation_time,
            'profile' => $profilePath, // Save the file path to the database
        ]);

        // Redirect with success message
        return redirect()->route('admin.kontak')->with('success', 'Kontak successfully added!');
    }

    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'operation_time' => 'required|string|max:255',
        'profile' => 'nullable|file|mimes:jpg,jpeg,png|max:2048', // Optional for profile
    ]);

    // Find the existing Kontak record
    $kontak = KontakM::findOrFail($id);

    // Check if a new profile file is uploaded
    if ($request->hasFile('profile')) {
        // Retrieve the uploaded file
        $profile = $request->file('profile');

        // Define the storage path for the new file
        $profilePath = $profile->getClientOriginalName();

        // Store the new file
        $profile->storeAs('kontak', $profilePath, 'public');

        // Delete the old file if it exists
        if ($kontak->profile && Storage::disk('public')->exists('kontak/' . $kontak->profile)) {
            Storage::disk('public')->delete('kontak/' . $kontak->profile);
        }

        // Update the profile path in the record
        $kontak->profile = $profilePath;
    }

    // Update other fields
    $kontak->name = $request->name;
    $kontak->phone = $request->phone;
    $kontak->operation_time = $request->operation_time;

    // Save the changes
    $kontak->save();

    // Redirect with a success message
    return redirect()->route('admin.kontak')->with('success', 'Kontak successfully updated!');
}

public function delete($id){
    $kontak = KontakM::findOrFail($id);
    $kontak->delete();
    return redirect()->back()->with('success','Data Has Been Deleted');
}
}
