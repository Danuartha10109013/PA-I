<?php

namespace App\Http\Controllers;

use App\Models\SliderM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KSliderController extends Controller
{
    public function index (){
        $data = SliderM::all();
        return view('pages.admin.k-slider.index',compact('data'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'slider' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Limit to image types and size
        ]);

        // Retrieve the uploaded file
        $slider = $request->file('slider');

        // Define the storage path
        $sliderPath = $slider->getClientOriginalName();

        // Store the file
        $slider->storeAs('slider', $sliderPath,'public');


        // Create a new Kontak record
        SliderM::create([
            'image' => $sliderPath, 
        ]);

        // Redirect with success message
        return redirect()->route('admin.slider')->with('success', 'Slider successfully added!');
    }
    public function update(Request $request, $id)
{
    // Validate the incoming request
    $request->validate([
        'slider' => 'required|file|mimes:jpg,jpeg,png|max:2048', // Limit to image types and size
    ]);

    // Retrieve the uploaded file
    $newSlider = $request->file('slider');

    // Define the storage path
    $newSliderPath = $newSlider->getClientOriginalName();

    // Retrieve the existing slider record
    $slider = SliderM::find($id);

    if ($slider) {
        // Check if there is an existing image
        if ($slider->image && Storage::disk('public')->exists('slider/' . $slider->image)) {
            // Delete the existing file
            Storage::disk('public')->delete('slider/' . $slider->image);
        }

        // Store the new file
        $newSlider->storeAs('slider', $newSliderPath, 'public');

        // Update the record with the new file name
        $slider->image = $newSliderPath;
        $slider->save();
    }

    // Redirect with success message
    return redirect()->route('admin.slider')->with('success', 'Slider successfully Updated!');
}


    public function delete ($id){
        $slider = SliderM::find($id);
        $slider->delete();
        return redirect()->back()->with('success', 'Slider Has Been Deleted');
    }
}
