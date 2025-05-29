<?php

namespace App\Http\Controllers;

use App\Models\PembelianM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    public function index(){
        $ids = PembelianM::where('user_id',Auth::user()->id)->value('id');
        $data = PembelianM::find($ids);
        // dd($data);
        
        return view('pages.pesanan.index',compact('data'));
    }
}
