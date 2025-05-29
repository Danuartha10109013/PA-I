<?php

namespace App\Http\Controllers;

use App\Models\AboutM;
use App\Models\CustomerM;
use App\Models\KategoriM;
use App\Models\KontakM;
use App\Models\ProdukM;
use App\Models\ProjectM;
use App\Models\SliderM;
use App\Models\TestimoniM;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $slides = SliderM::all();
        $data = ProdukM::where('rekomendasi',1)->get();
        return view('pages.landing-page',compact('slides','data'));
    }
    public function product(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');

        // Query ProdukM dengan filter search dan category
        if($category == 'rekomendasi'){
            $data = ProdukM::where('rekomendasi',1)->get();
        }else{
            $data = ProdukM::query()
                ->when($category, function ($query, $category) {
                    $c = KategoriM::where('name',$category)->value('id');
                    return $query->where('kategori_id', 'LIKE', '%' . $c . '%'); // Pastikan 'category' adalah kolom yang sesuai
                })
                ->when($search, function ($query, $search) {
                    return $query->where('name', 'LIKE', '%' . $search . '%');
                })
                ->get();
        }

        $category = KategoriM::all();

        return view('pages.product.index', compact('data', 'category', 'search'));
    }

    public function customer(Request $request)
    {
        $data = CustomerM::where('status', 1)->get();
        return view('pages.customer.index',compact('data'));
    }
    public function testimoni(Request $request)
    {
        $testimonials = TestimoniM::all();
        return view('pages.testimoni.index',compact('testimonials'));
    }
    public function kontak(Request $request)
    {
        $data = KontakM::all();
        $a = AboutM::find(1);
        $link_map = $a->link_map;
        return view('pages.kontak.index',compact('data','link_map'));
    }
    public function about(Request $request)
    {
        $data = AboutM::find(1);
        return view('pages.about.index',compact('data'));
    }
    public function project(Request $request)
    {
        $data = ProjectM::all();
        return view('pages.project.index',compact('data'));
    }


}
