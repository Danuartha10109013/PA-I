<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\DashboardControlller;
use App\Http\Controllers\KAboutController;
use App\Http\Controllers\KadminController;
use App\Http\Controllers\KCustomerController;
use App\Http\Controllers\KKontakController;
use App\Http\Controllers\KPembelianController;
use App\Http\Controllers\KPembeliController;
use App\Http\Controllers\KPesananController;
use App\Http\Controllers\KProductController;
use App\Http\Controllers\KProjectController;
use App\Http\Controllers\KRekomendasiController;
use App\Http\Controllers\KSliderController;
use App\Http\Controllers\KTestimoniController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Middleware\AutoLogout;
use App\Models\PesananM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/',[LandingController::class,'index'])->name('landing-page');

Route::get('/download/{file}', function ($file) {
    $filePath = public_path($file); // Mengambil file dari folder 'public'
    if (file_exists($filePath)) {
        return response()->download($filePath);
    }
    return abort(404, 'File not found');
});
Route::get('/cek-pesanan', function (Request $request) {
    $uuid = $request->query('uuid');
    try {
        $exists = PesananM::where('uuid', $uuid)->exists();
        return response()->json(['exists' => $exists]);
    } catch (\Exception $e) {
        return response()->json([
            'exists' => false,
            'error' => $e->getMessage()
        ], 500);
    }
});
//chats
Route::post('/save-chat', [ChatController::class, 'store']);
Route::get('/chat/{token}', [ChatController::class, 'getMessages']);
Route::get('/api/chats/{user_token}', [ChatController::class, 'getChatsByUserToken']);
Route::post('/upload-chat-file', [ChatController::class, 'uploadFile']);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/login-proses', [LoginController::class, 'proses'])->name('login-proses');
Route::post('/logouts', [LoginController::class, 'logouts'])->name('logouts');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
//Produk
Route::get('/product', [LandingController::class, 'product'])->name('product');
Route::get('/product/wa/{id}', [ProdukController::class, 'form'])->name('product.whatsapp');
Route::post('/product/send', [ProdukController::class, 'send'])->name('product.whatsapp.send');
Route::get('/product/manual_book/{id}',[KProductController::class, 'download'])->name('product.manual_book');
Route::get('/product/brosur/{id}',[KProductController::class, 'downloads'])->name('product.brosur');
Route::get('/pembayaran-berhasil/{id}',[PesananController::class, 'success'])->name('product.brosur');


//Customer
Route::get('/customer', [LandingController::class, 'customer'])->name('customer');

//Testimoni
Route::get('/testimoni', [LandingController::class, 'testimoni'])->name('testimoni');

//Kontak
Route::get('/kontak', [LandingController::class, 'kontak'])->name('kontak');

//About
Route::get('/about', [LandingController::class, 'about'])->name('about');

//project
Route::get('/project', [LandingController::class, 'project'])->name('project');

Route::middleware([AutoLogout::class])->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/profile',[ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update/{id}',[ProfileController::class, 'update'])->name('profile.update');
    });


    Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
        Route::get('/dash',[DashboardControlller::class, 'index'])->name('dashboard');
        Route::prefix('k-chat')->group(function () {
            Route::get('/chats',[ChatController::class, 'admin'])->name('k-chat');
            Route::get('/chat/{user_token}', [ChatController::class, 'showChat'])->name('k-chat.message');
            Route::get('/api/chats/{user_token}', [ChatController::class, 'apiMessages']);

            Route::post('/chat/reply', [ChatController::class, 'reply'])->name('k-chat.reply');
            // Route::get('/chats/view/{id}',[ChatController::class, 'admin'])->name('k-chat');
        });
        Route::prefix('k-admin')->group(function () {
            Route::get('/',[KadminController::class, 'index'])->name('k-admin');
            Route::post('/store',[KadminController::class, 'store'])->name('k-admin.store');
            Route::put('/update/{id}',[KadminController::class, 'update'])->name('k-admin.update');
            Route::delete('/delete/{id}',[KadminController::class, 'delete'])->name('k-admin.delete');
        });
        Route::prefix('k-pembeli')->group(function () {
            Route::get('/',[KPembeliController::class, 'index'])->name('k-pembeli');
            Route::post('/store',[KPembeliController::class, 'store'])->name('k-pembeli.store');
            Route::put('/update/{id}',[KPembeliController::class, 'update'])->name('k-pembeli.update');
            Route::delete('/delete/{id}',[KPembeliController::class, 'delete'])->name('k-pembeli.delete');
        });
        Route::prefix('product')->group(function () {
            Route::get('/',[KProductController::class, 'index'])->name('product');
            Route::post('/store',[KProductController::class, 'store'])->name('product.store');
            Route::post('/kategori',[KProductController::class, 'kategori'])->name('product.kategori');
            Route::delete('/kategori/delete/{id}',[KProductController::class, 'kategori_delete'])->name('product.kategori.delete');
            Route::put('/kategori/update/{id}',[KProductController::class, 'kategori_edit'])->name('product.kategori.edit');
            Route::post('/jenis',[KProductController::class, 'jenis'])->name('product.jenis');
            Route::put('/jenis/update/{id}',[KProductController::class, 'jenis_edit'])->name('product.jenis.edit');
            Route::get('/edit/{id}',[KProductController::class, 'edit'])->name('product.edit');
            Route::put('/update/{id}',[KProductController::class, 'update'])->name('product.update');
            Route::delete('/delete/{id}',[KProductController::class, 'delete'])->name('product.delete');
            Route::get('/download/{id}',[KProductController::class, 'download'])->name('product.download');
            Route::get('/downloads/{id}',[KProductController::class, 'downloads'])->name('product.downloads');
        });
        Route::prefix('rekomendasi')->group(function () {
            Route::get('/',[KRekomendasiController::class, 'index'])->name('rekomendasi');
            Route::post('/active/{id}',[KRekomendasiController::class, 'active'])->name('k-rekomendasi.active');
            Route::post('/nonactive/{id}',[KRekomendasiController::class, 'nonactive'])->name('k-rekomendasi.nonactive');

        });
        Route::prefix('pemesanan')->group(function () {
            Route::get('/',[KPesananController::class, 'index'])->name('pemesanan');
            Route::post('/active/{id}',[KPesananController::class, 'active'])->name('pemesanan.active');
            Route::post('/active-baru/{id}',[KPesananController::class, 'active'])->name('pemesanan.active.baru');
            Route::get('/message/{id}',[KPesananController::class, 'message'])->name('pemesanan.message');
            Route::get('/export',[KPesananController::class, 'export'])->name('pemesanan.export');
            Route::delete('/delete/{id}',[KPesananController::class, 'delete'])->name('pemesanan.delete');
            
        });
        Route::prefix('slider')->group(function () {
            Route::get('/',[KSliderController::class, 'index'])->name('slider');
            Route::post('/store',[KSliderController::class, 'store'])->name('k-slider.store');
            Route::delete('/delete/{id}',[KSliderController::class, 'delete'])->name('k-slider.delete');
            Route::put('/update/{id}',[KSliderController::class, 'update'])->name('k-slider.update');
            
        });
        Route::prefix('customer')->group(function () {
            Route::get('/',[KCustomerController::class, 'index'])->name('customer');
            Route::post('/store',[KCustomerController::class, 'store'])->name('k-customer.store');
            Route::put('/update/{id}',[KCustomerController::class, 'update'])->name('k-customer.update');
            Route::delete('/delete/{id}',[KCustomerController::class, 'delete'])->name('k-customer.delete');

        });
        Route::prefix('project')->group(function () {
            Route::get('/',[KProjectController::class, 'index'])->name('project');
            Route::post('/store',[KProjectController::class, 'store'])->name('project.store');
            Route::delete('/delete/{id}',[KProjectController::class, 'delete'])->name('project.delete');

        });
        Route::prefix('testimoni')->group(function () {
            Route::get('/',[KTestimoniController::class, 'index'])->name('testimoni');
            Route::post('/store',[KTestimoniController::class, 'store'])->name('testimoni.store');
            Route::put('/update/{id}',[KTestimoniController::class, 'update'])->name('testimoni.update');
            Route::delete('/delete/{id}',[KTestimoniController::class, 'delete'])->name('testimoni.delete');

        });
        Route::prefix('kontak')->group(function () {
            Route::get('/',[KKontakController::class, 'index'])->name('kontak');
            Route::post('/store',[KKontakController::class, 'store'])->name('k-kontak.store');
            Route::put('/update/{id}',[KKontakController::class, 'update'])->name('k-kontak.update');
            Route::delete('/delete/{id}',[KKontakController::class, 'delete'])->name('k-kontak.delete');

        });
        Route::prefix('rating')->group(function () {
            Route::get('/',[KPembeliController::class, 'index'])->name('rating');

        });
        Route::prefix('pesanan')->group(function () {
            Route::get('/',[KPembelianController::class, 'index'])->name('pesanan');
            Route::put('/update/{id}',[KPembelianController::class, 'update'])->name('pesanan.update');

        });
        Route::prefix('about')->group(function () {
            Route::get('/',[KAboutController::class, 'index'])->name('about');
            Route::put('update/{id}',[KAboutController::class, 'update'])->name('about.update');

        });

    });

    Route::group(['prefix' => 'pembeli', 'middleware' => ['pembeli'], 'as' => 'pembeli.'], function () {
        Route::prefix('rating')->group(function () {
            Route::get('/',[RatingController::class, 'index'])->name('rating');

        });
        Route::prefix('pesanan')->group(function () {
            Route::get('/',[PesananController::class, 'index'])->name('pesanan');

        });
        Route::prefix('testimoni')->group(function () {
            Route::post('/store',[KTestimoniController::class, 'store'])->name('testimoni.store');
        });
    });

});