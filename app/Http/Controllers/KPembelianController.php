<?php

namespace App\Http\Controllers;

use App\Models\PembelianM;
use Illuminate\Http\Request;

class KPembelianController extends Controller
{
    public function index(){
        $data = PembelianM::where('status', '!=','Selesai')->get();
        $data1 = PembelianM::where('status','Selesai')->get();
        return view('pages.admin.k-pembelian.index',compact('data','data1'));
    }

    public function update(Request $request, $id)
    {
        // Find the Pembeli by ID
        $pembeli = PembelianM::findOrFail($id);

        // Validate the input data
        $request->validate([
            'product' => 'required|string', // You can add specific validation for 'product'
            'invoice' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
            'no_do' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
            'faktur' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
        ]);

        // Update the status field
        $pembeli->status = $request->input('product');
        
        // Handle the file upload if there's a file
        if ($request->hasFile('invoice')) {
            $file = $request->file('invoice');
            // Store the file in the storage folder
            $filePath = $file->storeAs('invoice', $file->getClientOriginalName(),'public');
            // You can update the database with the path of the file
            $pembeli->invoice = $filePath;
        }
        // Handle the file upload if there's a file
        if ($request->hasFile('no_do')) {
            $file = $request->file('no_do');
            // Store the file in the storage folder
            $filePath = $file->storeAs('no_do', $file->getClientOriginalName(),'public');
            // You can update the database with the path of the file
            $pembeli->no_do = $filePath;
        }
        // Handle the file upload if there's a file
        if ($request->hasFile('faktur')) {
            $file = $request->file('faktur');
            // Store the file in the storage folder
            $filePath = $file->storeAs('faktur', $file->getClientOriginalName(),'public');
            // You can update the database with the path of the file
            $pembeli->faktur = $filePath;
        }

        // Save the changes to the model
        $pembeli->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
