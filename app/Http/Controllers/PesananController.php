<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrderM;
use App\Models\InvoiceM;
use App\Models\PembelianM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class PesananController extends Controller
{
    public function index(){
        $ids = PembelianM::where('user_id',Auth::user()->id)->value('id');
        $data = PembelianM::find($ids);
        $user = User::find($data->user_id);
        // dd($data);
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'RR-' . time(),
                'gross_amount' => $data->nominal, // Total harga
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
            
        return view('pages.pesanan.index',compact('data','snapToken'));
    }

    public function success($id){
        $data = PembelianM::find($id);
        $data->status_pembayaran = 'payed';
        $data->save();
        return redirect()->back()->with('success','Terimakasih telah melakukan pembayaran');
    }

    public function do($id){
        $data = DeliveryOrderM::find($id);

        return view('pages.admin.k-pembelian.preview-do-pdf',compact('data'));
    }
    public function invoice($id){
        $data = InvoiceM::find($id);

        return view('pages.admin.k-pembelian.preview-invoice-pdf',compact('data'));
    }
}
