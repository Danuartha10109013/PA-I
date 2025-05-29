<?php

namespace App\Http\Controllers;

use App\Models\AboutM;
use Illuminate\Http\Request;

class KAboutController extends Controller
{
    public function index (){
        $data = AboutM::find(1);
        return view('pages.admin.k-about.index',compact('data'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'desc_judul' => 'required|string|max:255',
            'item' => 'required|array',
            'desc_item' => 'required|array',
            'visi' => 'required|string|max:255',
            'misi' => 'required|array',
            'misi_tagline' => 'required|array',
            'link_map' => 'required|string',
            'hotline' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
        ]);

        // Find the AboutM record by ID
        $about = AboutM::findOrFail($id);

        // Update the fields
        $about->judul = $request->input('judul');
        $about->desc_judul = $request->input('desc_judul');
        $about->item = json_encode($request->input('item')); // Convert array to JSON
        $about->desc_item = json_encode($request->input('desc_item')); // Convert array to JSON
        $about->visi = $request->input('visi');
        $about->misi = json_encode($request->input('misi')); // Convert array to JSON
        $about->misi_tagline = json_encode($request->input('misi_tagline')); // Convert array to JSON
        $about->link_map = $request->input('link_map');
        $about->hotline = $request->input('hotline');
        $about->email = $request->input('email');

        // Save the updated record
        $about->save();

        // Redirect back with a success message
        return redirect()->route('admin.about')->with('success', 'About updated successfully!');
    }
}
