<?php

namespace App\Http\Controllers;

use App\Models\CustomerM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KCustomerController extends Controller
{
    public function index(){
        $data = CustomerM::where('status',1)->get();
        return view('pages.admin.k-customer.index',compact('data'));
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'status' => 'required|boolean',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Handle the logo upload with the original name
    if ($request->hasFile('logo')) {
        $originalName = $request->file('logo')->getClientOriginalName();
        $filePath = $request->file('logo')->storeAs('customer_logo', $originalName, 'public');
        $validatedData['logo'] = $filePath; // Save the path in the database
    }

    // Create a new customer record
    CustomerM::create($validatedData);

    return redirect()->route('admin.customer')->with('success', 'Customer added successfully.');
}

    public function delete($id){
        $data = CustomerM::find($id);
        $data->delete();
        return redirect()->back()->with('success','Customer telah dihapus');
    }

    public function update(Request $request, $id)
{
    // Find the user by ID
    $customer = CustomerM::findOrFail($id);

    // Validate input data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'status' => 'required|boolean',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Check if a new logo is uploaded
    if ($request->hasFile('logo')) {
        // Delete the old logo if it exists
        if ($customer->logo && Storage::exists('public/' . $customer->logo)) {
            Storage::delete('public/' . $customer->logo);
        }

        // Store the new logo with the original name
        $originalName = $request->file('logo')->getClientOriginalName();
        $filePath = $request->file('logo')->storeAs('customer_logo', $originalName, 'public');
        $validatedData['logo'] = $filePath; // Update the logo path
    }

    // Update the customer record with validated data
    $customer->update($validatedData);

    return redirect()->route('admin.customer')->with('success', 'User updated successfully.');
}
}
