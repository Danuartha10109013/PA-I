<?php

namespace App\Http\Controllers;

use App\Models\KategoriM;
use App\Models\PembelianM;
use App\Models\PesananM;
use App\Models\ProdukM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardControlller extends Controller
{
    public function index(){
        $pembelian = PembelianM::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(id) as total'))
        ->groupBy('bulan')
        ->orderBy('bulan')
        ->pluck('total', 'bulan');

    // Pastikan data terisi untuk semua bulan (1-12)
    $pembelianPerBulan = [];
    for ($i = 1; $i <= 12; $i++) {
        $pembelianPerBulan[] = $pembelian->get($i, 0); // Jika tidak ada data di bulan tertentu, default 0
    }

    $pesanan = PesananM::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(id) as total'))
    ->groupBy('bulan')
    ->orderBy('bulan')
    ->pluck('total', 'bulan');

    // Prepare data for Chart.js
    $pesananPerBulan = [];
    for ($i = 1; $i <= 12; $i++) {
        $pesananPerBulan[] = $pesanan->get($i, 0); // Default to 0 if no data for the month
    }

    $produkCounts = ProdukM::select('kategori_id', DB::raw('COUNT(*) as total'))
    ->groupBy('kategori_id')
    ->pluck('total', 'kategori_id');

    // Retrieve category names corresponding to IDs
    $categories = KategoriM::whereIn('id', $produkCounts->keys())->pluck('name', 'id');

    // Prepare data for the pie chart
    $categoryNames = [];
    $categoryTotals = [];

    foreach ($produkCounts as $categoryId => $count) {
        $categoryNames[] = $categories[$categoryId] ?? 'Unknown'; // Default to 'Unknown' if category is missing
        $categoryTotals[] = $count;
    }

    $pesananbaru = PesananM::latest('created_at')->take(5)->get();

        return view('pages.admin.index',compact('pembelianPerBulan','pesananPerBulan','categoryTotals','categoryNames','pesananbaru'));
    }
}
