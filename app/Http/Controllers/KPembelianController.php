<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrderM;
use App\Models\InvoiceM;
use App\Models\PembelianM;
use App\Models\PesananM;
use App\Models\ProdukM;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KPembelianController extends Controller
{
    public function index(){
        $data = PembelianM::where('status', '!=','Selesai')->orderBy('created_at','desc')->get();
        $data1 = PembelianM::where('status','Selesai')->get();
        return view('pages.admin.k-pembelian.index',compact('data','data1'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Find the Pembeli by ID
        $pembeli = PembelianM::findOrFail($id);

        // Validate the input data
        $request->validate([
            'product' => 'required|string', // You can add specific validation for 'product'
            // 'invoice' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
            // 'no_do' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
            'faktur' => 'nullable|file|mimes:jpeg,png,pdf,docx', 
            'logo' => 'nullable|file|mimes:jpeg,png', 
        ]);

        if($request->product == 'Selesai'){
            $request->validate([
                'faktur' => 'required|file|mimes:jpeg,jpg,png,pdf,docx',
                'logo' => 'required|file|mimes:jpeg,png,jpg',
            ]);
        }

        // Update the status field
        $pembeli->status = $request->input('product');
        
        // Handle the file upload if there's a file
        if($request->invoice){
        $pembeli->invoice = $request->invoice;
       }
        // Handle the file upload if there's a file
       if($request->no_do){
        $pembeli->no_do = $request->no_do;
       }
       if($request->invoice){
        $pembeli->invoice = $request->invoice;
       }
        // Handle the file upload if there's a file
        if ($request->hasFile('faktur')) {
            $file = $request->file('faktur');
            // Store the file in the storage folder
            $filePath = $file->storeAs('faktur', $file->getClientOriginalName(),'public');
            // You can update the database with the path of the file
            $pembeli->faktur = $filePath;
        }
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Store the file in the storage folder
            $filePath = $file->storeAs('logo', $file->getClientOriginalName(),'public');
            // You can update the database with the path of the file
            $pembeli->logo = $filePath;
        }

        // Save the changes to the model
        $pembeli->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function do($id){
        $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    // Konversi bulan ke angka romawi
    $romawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $bulanRomawi = $romawi[$bulan];

    // Ambil jumlah DO bulan ini
    $count = DeliveryOrderM::whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->count();

    $running = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    $do = "$running/DO/$bulanRomawi/$tahun";

    $pembeli = PembelianM::findOrFail($id);
    $product = ProdukM::find($pembeli->product_id);
    $user = User::find($pembeli->user_id);
    $pesanan = PesananM::where('email',$user->email)->first();
    // dd($pesanan);
    $now = Carbon::now();
    $day = str_pad($now->day, 2, '0', STR_PAD_LEFT);
    $month = str_pad($now->month, 2, '0', STR_PAD_LEFT);
    $yearShort = $now->format('y'); // dua digit tahun, misalnya '24'

    $no_ref =  "$day-$month-$product->name-TSU-$yearShort";
        return view('pages.admin.k-pembelian.do-pdf',compact('do','pembeli','product',"pesanan",'no_ref'));
    }

    function bulanRomawi($bulan)
{
    $romawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];

    return $romawi[(int)$bulan];
}

    public function invoice($id){
        $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    // Konversi bulan ke angka romawi
    $romawi = [
        1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV',
        5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII',
        9 => 'IX', 10 => 'X', 11 => 'XI', 12 => 'XII'
    ];
    $bulanRomawi = $romawi[$bulan];

    // Ambil jumlah DO bulan ini
    $count = InvoiceM::whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->count();

    $running = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    $no_invoice = "$running/INV/$bulanRomawi/$tahun";
    $pembelian = PembelianM::findOrFail($id);
    $product = ProdukM::find($pembelian->product_id);
    $user = User::find($pembelian->user_id);
    $pesanan = PesananM::where('email',$user->email)->first();
    // dd($pesanan);
    $bulanRomawi = $this->bulanRomawi($bulan);
    $prefix = 'OTM/SP';
    // Hitung jumlah surat bulan ini
    $jumlahSurat = DB::table('invoice')
        ->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->count();

    $urutan = str_pad($jumlahSurat + 1, 3, '0', STR_PAD_LEFT);

    $no_ref = "{$urutan}/{$prefix}/{$bulanRomawi}/{$tahun}";
        return view('pages.admin.k-pembelian.invoice-pdf',compact('no_invoice','pembelian','product',"pesanan",'no_ref'));
    }

public function saveinvoice(Request $request)
{
    $request->validate([
        'no_invoice' => 'required|string',
        'pembeli_id' => 'required|integer',
        'no_ref' => 'required|string',
        'date' => 'required|date',
        'due_date' => 'required|date',
        'product' => 'required|string',
        'description' => 'required|string',
        'qty' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
        'total' => 'required|numeric',
        'pt_penerima' => 'required|string',
        'alamat' => 'required|string',
        'dpp' => 'nullable|numeric',
        'vat' => 'nullable|numeric',
        'grand_total' => 'required|numeric',
        'bank_account' => 'required|string',
        'bank_account_name' => 'required|string',
        'date_kirim' => 'nullable|date',
        'best_regards' => 'nullable|string',
        'best_regards_signature' => 'nullable|file|image|max:2048',
    ]);

    // Handle signature upload
    $signaturePath = null;
    if ($request->hasFile('best_regards_signature')) {
        $signaturePath = $request->file('best_regards_signature')->store('signatures', 'public');
    }

    // Cari atau buat instance invoice
    $invoice = invoiceM::where('no_invoice', $request->no_invoice)->first();

        // Jika belum ada, buat instance baru
        if (!$invoice) {
            $invoice = new invoiceM();
            $invoice->no_invoice = $request->no_invoice;
        }
    // Isi datanya
    $invoice->pembeli_id = $request->pembeli_id;
    $invoice->no_ref = $request->no_ref;
    $invoice->date = $request->date;
    $invoice->due_date = $request->due_date;
    $invoice->product = $request->product;
    $invoice->description = $request->description;
    $invoice->pt_penerima = $request->pt_penerima;
    $invoice->alamat = $request->alamat;
    $invoice->qty = $request->qty;
    $invoice->price = $request->price;
    $invoice->total = $request->total;
    $invoice->dpp = $request->dpp;
    $invoice->vat = $request->vat;
    $invoice->grand_total = $request->grand_total;
    $invoice->bank_account = $request->bank_account;
    $invoice->bank_name = $request->bank_account_name;
    $invoice->date_kirim = $request->date_kirim;
    $invoice->best_regards = $request->best_regards;

    // Jika ada file baru diupload, ganti path-nya
    if ($signaturePath) {
        $invoice->best_regards_signature = $signaturePath;
    }

    $invoice->save();
    $pembelian = PembelianM::find($invoice->pembeli_id);
            if($pembelian){
                $pembelian->invoice = $invoice->id;
                $pembelian->save();
            }
    return redirect()->route('admin.pesanan.previewinvoice',$invoice->id)->with('success', 'Invoice berhasil disimpan atau diperbarui!');
}


    public function savedo(Request $request)
    {
        $request->validate([
            'nomor_do' => 'required',
            'no_ref' => 'required',
            'date' => 'required|date',
            'pt_penerima' => 'nullable|string',
            'alamat' => 'nullable|string',
            'product' => 'nullable|string',
            'description' => 'nullable|string',
            'qty' => 'nullable|string',
            'franco' => 'nullable|string',
            'waranty' => 'nullable|string',
            'customer_name' => 'nullable|string',
            'best_regards' => 'nullable|string',
            'customer_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'best_regards_signature' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cari berdasarkan no_do
        $deliveryOrder = DeliveryOrderM::where('no_do', $request->nomor_do)->first();

        // Jika belum ada, buat instance baru
        if (!$deliveryOrder) {
            $deliveryOrder = new DeliveryOrderM();
            $deliveryOrder->no_do = $request->nomor_do;
        }

        $deliveryOrder->no_ref = $request->no_ref;
        $deliveryOrder->pembeli_id = $request->pembeli_id; // atau sesuaikan dengan $pesanan->user_id
        $deliveryOrder->date = $request->date;
        $deliveryOrder->pt_penerima = $request->pt_penerima;
        $deliveryOrder->alamat = $request->alamat;
        $deliveryOrder->product = $request->product;
        $deliveryOrder->description = $request->description;
        $deliveryOrder->qty = $request->qty;
        $deliveryOrder->total_qty = $request->qty;
        $deliveryOrder->franco = $request->franco;
        $deliveryOrder->waranty = $request->waranty;
        $deliveryOrder->customer_name = $request->customer_name;
        $deliveryOrder->best_regards = $request->best_regards;

        // Handle file upload untuk customer signature
        if ($request->hasFile('customer_signature')) {
            if ($deliveryOrder->customer_signature && Storage::disk('public')->exists($deliveryOrder->customer_signature)) {
                Storage::disk('public')->delete($deliveryOrder->customer_signature);
            }
            $deliveryOrder->customer_signature = $request->file('customer_signature')->store('signatures/customer', 'public');
        }

        // Handle file upload untuk best regards signature
        if ($request->hasFile('best_regards_signature')) {
            if ($deliveryOrder->best_regards_signature && Storage::disk('public')->exists($deliveryOrder->best_regards_signature)) {
                Storage::disk('public')->delete($deliveryOrder->best_regards_signature);
            }
            $deliveryOrder->best_regards_signature = $request->file('best_regards_signature')->store('signatures/best_regards', 'public');
        }

        $deliveryOrder->save();

        $pembelian = PembelianM::find($deliveryOrder->pembeli_id);
        if($pembelian){
            $pembelian->no_do = $deliveryOrder->id;
            $pembelian->save();
        }

        return redirect()->route('admin.pesanan.previewdo',$deliveryOrder->id)->with('success', 'Delivery Order berhasil disimpan.');
    }

    public function do_preview($id){
        $data = DeliveryOrderM::find($id);

        return view('pages.admin.k-pembelian.preview-do-pdf', compact('data'));
    }
    public function invoice_preview($id){
        $data = InvoiceM::find($id);

        return view('pages.admin.k-pembelian.preview-invoice-pdf', compact('data'));
    }

    public function editdo($id){
        $data = DeliveryOrderM::find($id);

        return view('pages.admin.k-pembelian.edit-do-pdf',compact('data'));
    }
    public function editinvoice($id){
        $data = InvoiceM::find($id);

        return view('pages.admin.k-pembelian.edit-invoice-pdf',compact('data'));
    }
}
