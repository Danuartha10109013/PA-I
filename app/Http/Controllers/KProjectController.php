<?php

namespace App\Http\Controllers;

use App\Models\ProjectM;
use Illuminate\Http\Request;

class KProjectController extends Controller
{
    public function index(){
        $data = ProjectM::all();
        return view('pages.admin.k-project.index',compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Validate incoming request
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'video' => 'nullable|array',
            'video.*' => 'mimes:mp4,mov,avi,mpg,mkv',
        ]);

        // Process photo uploads
        $fotoPaths = [];
        if ($request->has('foto')) {
            foreach ($request->file('foto') as $foto) {
                // Save each photo and get the path
                $fotoPath = $foto->storeAs('project', $foto->getClientOriginalName(), 'public');
                $fotoPaths[] = $fotoPath; // Save the original name
            }
        }

        // Process video uploads
        $videoPaths = [];
        if ($request->has('video')) {
            foreach ($request->file('video') as $video) {
                // Save each video and get the path
                $videoPath = $video->storeAs('project', $video->getClientOriginalName(), 'public');
                $videoPaths[] = $videoPath; // Save the original name
            }
        }

        // Create a new project and store data in the database
        $project = ProjectM::create([
            'judul' => $request->judul,
            'sub_judul' => $request->sub_judul,
            'deskripsi' => $request->deskripsi,
            'foto' => json_encode($fotoPaths), // Store as JSON
            'video' => json_encode($videoPaths), // Store as JSON
        ]);

        return redirect()->back()->with('success', 'Project added successfully!');
    }

    public function delete($id){
        $data = ProjectM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Data telah dihapus');
    }
}
