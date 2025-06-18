<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Mail\AccPemesananMail;
use App\Models\PembelianM;
use App\Models\PesananM;
use App\Models\ProdukM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Midtrans\Config;
use Midtrans\Snap;

class KPesananController extends Controller
{
    public function index(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Retrieve records from PesananM, applying the search if there's a query
        $data = PesananM::query()
            ->when($search, function($query) use ($search) {
                // Apply the search filter on 'name' or 'company_name'
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('company_name', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Pass the data to the view 'pages.admin.k-pesanan.index'
        return view('pages.admin.k-pesanan.index', compact('data'));
    }

    public function active(Request $request,$id){
        // dd($request->all());
        $data = PesananM::where('uuid',$id)->first();

        $user= new User();
        $user->name = $data->name;
        $user->username = $data->name;
        $user->email = $data->email;
        $user->role = 1;
        $user->active = 1;
        $user->nominal = $request->nominal;
        $user->password = Hash::make('Trisurya');
        $user->save();



        $jadi = new PembelianM();
        $jadi->user_id = $user->id;
        $jadi->nominal = $request->nominal;
        $jadi->product_id = $data->product_id;
        $jadi->status_pembayaran ='pending';
        $jadi->save();
        $product = ProdukM::find($data->product_id);
        $produk   = $product->name;
        $harga    = $request->nominal;
        $nama     = $data->name;
        $email    = $data->email;
        $password = 'Trisurya'; // Bisa digenerate secara acak atau default

        // Kirim email ke klien
        Mail::to($email)->send(new AccPemesananMail($produk, $harga, $nama, $email, $password));
        return redirect()->back()->with('success', 'User Has Been Created');
    }
    public function actives(Request $request,$id){
        // dd($request->all());
        $data = PesananM::find($id);
        // dd($data);

        $user= new User();
        $user->name = $data->name;
        $user->username = $data->name;
        $user->email = $data->email;
        $user->role = 1;
        $user->active = 1;
        $user->nominal = $request->nominal;
        $user->password = Hash::make('Trisurya');
        $user->save();



        $jadi = new PembelianM();
        $jadi->user_id = $user->id;
        $jadi->nominal = $request->nominal;
        $jadi->product_id = $data->product_id;
        $jadi->status_pembayaran ='pending';
        $jadi->save();

        $product = ProdukM::find($data->product_id);
        $produk   = $product->name;
        $harga    = $request->nominal;
        $nama     = $data->name;
        $email    = $data->email;
        $password = 'Trisurya'; // Bisa digenerate secara acak atau default

        // Kirim email ke klien
        Mail::to($email)->send(new AccPemesananMail($produk, $harga, $nama, $email, $password));
        return redirect()->back()->with('success', 'User Has Been Created');
    }

    public function message($id){
        $data = PesananM::find($id);

        $nomor = $data->whatsapp; // Ganti 0821 menjadi 62821 (62 adalah kode negara Indonesia)
        
        // Pesan WhatsApp
        $message = urlencode("Terimakasih telah menghubungi Kami, Akun Anda telah dibuatkan");
        
        // URL WhatsApp
        $whatsappLink = "https://wa.me/{$nomor}?text={$message}";

        header("Location: $whatsappLink");
        exit;
    }

    public function delete($id){
        // dd($id);
        $data = PesananM::find($id);
        if($data){
            $user = User::where('email',$data->email)->first();
            $user->active = 0;
            $user->save();
            $pembelian = PembelianM::where('user_id',$user->id)->first();
            $pembelian->delete();
            $data->delete();
            return redirect()->back()->with('success','Pemesan telah berhasil dihapus');
        }else{
            return redirect()->back()->with('error','Gagal Menghapus');
        }
    }

    public function export(){
        $data = PesananM::all();
        return Excel::download(new PemesananExport($data), 'Pemesanan_Report.csv');

    }

    public function checkout($id)
{
    
    Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
    Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $params = [
        'transaction_details' => [
            'order_id' => 'RR-' . time(),
            'gross_amount' => 100000, // Total harga
        ],
        'customer_details' => [
            'first_name' => 'Danu',
            'email' => 'danu@example.com',
        ],
    ];

    $snapToken = Snap::getSnapToken($params);
    return view('checkout', compact('snapToken'));
}
}
