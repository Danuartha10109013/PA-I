<?php

namespace App\Http\Controllers;

use App\Models\ProdukM;
use Illuminate\Http\Request;

class KRekomendasiController extends Controller
{
    public function index(){
        $data = ProdukM::all();
        return view('pages.admin.k-rekomendasi.index',compact('data'));
    }

    public function active($id){
        $data = ProdukM::find($id);
        $data->rekomendasi = 1;
        $data->save();
        return redirect()->back()->with('success', 'Produk Telah Direkomendasikan');
    }
    public function nonactive($id){
        $data = ProdukM::find($id);
        $data->rekomendasi = 0;
        $data->save();
        return redirect()->back()->with('success', 'Produk Tidak Direkomendasikan');
    }
}
