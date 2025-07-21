<?php

namespace App\Http\Controllers;

use App\Models\AboutM;
use App\Models\PesananM;
use App\Models\ProdukM;
use App\Models\Chat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function form($id){
        if(!Auth::check()){
            return redirect()->to('login')->with('error','Maaf, silahkan register atau login terlebih dahulu');
        }
     
        $data = ProdukM::find($id);
        $orders = PesananM::where('email',Auth::user()->email)
        // ->where('product_id', NULL)
        ->first();
        // dd($orders);
        return view('pages.product.form',compact('data','orders'));
    }

     public function send(Request $request){
        // dd($request->pesanan_id);
        // Validate the incoming data
        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'uuid' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_whatsapp' => 'required|string|max:20',
            'perusahaan' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'email_perusahaan' => 'nullable|email|max:255',
            'product_id' => 'nullable|integer', 
            'pesanan_id' => 'nullable', 
        ]);

     
        $pesanan = new PesananM();

        if( $request->pesanan_id ){ 
            
            $produk = ProdukM::find($validated['product_id']);

            $gambarArray = json_decode($produk->gambar, true);
    
            $gambarArray[] = $produk->harga_jual;
    
            $produk->gambar = json_encode($gambarArray);
            
            $orders = PesananM::where('id',$request->pesanan_id)->first();
            // dd($orders);
            $pesanan->where('id', $request->pesanan_id)->update([
                'name' => $validated['nama'],
                'email' => $validated['email'],
                'whatsapp' => $validated['no_whatsapp'],
                'company_name' => $validated['perusahaan'],
                'alamat_perusahaan' => $validated['alamat'],
                'email_perusahaan' => $validated['email_perusahaan'],
                'product_id' => $validated['product_id'],
                'total_order' => 1,
                'uuid' => $validated['uuid'],
            ]);

            $chat = new Chat();
            $chat->user_token = $orders['uuid'];
            $chat->sender = 'Admin';
            $chat->message = $produk->gambar;
            $chat->save();
    
            $chat2 = new Chat();
            $chat2->user_token= $orders['uuid'];
            $chat2->sender = 'Admin';
            $chat2->message = '<b>'. $produk->name.'</b> <br>Terimakasih telah memesan produk kami. kami akan memvalidasi terlebih dahulu pesanan anda';
            $chat2->save();
        
        }else{
            $pesanan->name = $validated['nama'];
            $pesanan->email = $validated['email'];
            $pesanan->whatsapp = $validated['no_whatsapp'];
            $pesanan->company_name = $validated['perusahaan'];
            $pesanan->alamat_perusahaan = $validated['alamat'];
            $pesanan->email_perusahaan = $validated['email_perusahaan'];
            $pesanan->product_id = NULL;
            $pesanan->total_order =  1;
            $pesanan->uuid = $validated['uuid'];
            $pesanan->save();
        }

        return redirect()->to('product')->with('success','Terimakasih telah mengisi data, silahkan Menghubungi kami di Chat');
       
        
       

    }
}
