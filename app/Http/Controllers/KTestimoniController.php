<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;
use App\Models\TestimoniM;
use Illuminate\Support\Facades\Storage;

class KTestimoniController extends Controller
{
    /**
     * Display a listing of the testimonials.
     */
    public function index()
    {
        $testimonis = TestimoniM::all();
        return view('pages.admin.k-testimoni.index', compact('testimonis'));
    }

    /**
     * Store a newly created testimonial in storage.
     */

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'person_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'person_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Store person picture
        $personPicture = $request->file('person_picture');
        $personPictureName = $personPicture->getClientOriginalName();
        $personPicturePath = $personPicture->storeAs('testimoni', $personPictureName, 'public');  // Store in public/testimoni
    
        // Store company logo
        $companyLogo = $request->file('company_logo');
        $companyLogoName = $companyLogo->getClientOriginalName();
        $companyLogoPath = $companyLogo->storeAs('testimoni', $companyLogoName, 'public');  // Store in public/testimoni
    
        // Save data to the database, including the original filenames
        TestimoniM::create([
            'person_name' => $request->person_name,
            'company_name' => $request->company_name,
            'product_name' => $request->product_name,
            'testimonial' => $request->testimonial,
            'rating' => $request->rating,
            'person_picture' => $personPictureName,  // Save the filename
            'company_logo' => $companyLogoName,  // Save the filename
        ]);
    
        return redirect()->back()->with('success', 'Thank you For your Response.');
    }
    
    public function update(Request $request, $id)
    {

        $testimoni = TestimoniM::find($id)   ;

        // Validate incoming data
        $request->validate([
            'person_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'testimonial' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'person_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Update person picture if provided
        if ($request->hasFile('person_picture')) {
            $personPicture = $request->file('person_picture');
            $personPictureName = $personPicture->getClientOriginalName();
            $personPicture->storeAs('testimoni', $personPictureName, 'public');  // Store in public/testimoni
            $testimoni->person_picture = $personPictureName;  // Update database with the new filename
        }
    
        // Update company logo if provided
        if ($request->hasFile('company_logo')) {
            $companyLogo = $request->file('company_logo');
            $companyLogoName = $companyLogo->getClientOriginalName();
            $companyLogo->storeAs('testimoni', $companyLogoName, 'public');  // Store in public/testimoni
            $testimoni->company_logo = $companyLogoName;  // Update database with the new filename
        }
    
        // Update other fields in the database
        $testimoni->update([
            'person_name' => $request->person_name,
            'company_name' => $request->company_name,
            'product_name' => $request->product_name,
            'testimonial' => $request->testimonial,
            'rating' => $request->rating,
        ]);
    
        return redirect()->route('admin.testimoni')->with('success', 'Testimonial updated successfully.');
    }
    


    /**
     * Remove the specified testimonial from storage.
     */
    public function delete($id)
    {
        $testimoni = TestimoniM::find($id)   ;

        Storage::delete([$testimoni->person_picture, $testimoni->company_logo]);
        $testimoni->delete();

        return redirect()->route('admin.testimoni')->with('success', 'Testimonial deleted successfully.');
    }
}