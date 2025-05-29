<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(){
        return view('pages.login');
    }

    public function proses(Request $request)
    {
        // Validate input
        $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Prepare authentication data
        $data = [
            $loginType => $request->username, // Check whether username or email
            'password' => $request->password,
        ];
    
        // Attempt authentication with provided credentials
        if (Auth::attempt($data)) {
            $user = Auth::user();
    
            // Check if the user is active (e.g., 'active' field in the User model)
            if ($user->active != 1) {
                Auth::logout(); // Ensure the user is logged out
                return redirect()->back()->with('error', 'Akun Anda tidak aktif.');
            }
    
            // Check the user's role
            if ($user->role == 0) {
                return redirect()->route('admin.dashboard')->with('success', 'Hallo Selamat Datang ' . Auth::user()->name);
            } elseif($user->role == 1){
                return redirect()->route('landing-page')->with('success', 'Hallo Selamat Datang ' . Auth::user()->name);

            }
             else {
                Auth::logout(); // Prevent access if the user is not an admin
                return redirect()->back()->with('error', 'You are not authorized to access this area.');
            }
        } else {
            // Authentication failed
            return redirect()->back()->with('error', 'Username or password is incorrect.');
        }
    }
    


public function logout(Request $request) {
    // Mengarahkan kembali ke halaman login dengan pesan sukses
    if(Auth::user()->role == 0){
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Kamu berhasil Logout');
    }else{
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
    }
}
public function logouts(Request $request) {
    // Mengarahkan kembali ke halaman login dengan pesan sukses
    if(Auth::user()->role == 0){
        Auth::logout();
        return redirect()->route('admin.login')->with('success', 'Kamu berhasil Logout');
    }else{
        Auth::logout();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout');
    }
}
public function logoutUserById($userId)
{
    // Temukan pengguna dengan ID tertentu
    $user = DB::table('users')->where('id', $userId)->first();

    if ($user) {
        // Menghapus token untuk logout pengguna
        DB::table('users')
            ->where('id', $userId)
            ->update(['remember_token' => null]);

        // Jika Anda menggunakan session-based authentication
        // Hapus sesi pengguna tertentu jika perlu
        // Session::forget('user_' . $userId);

        return redirect()->route('auth.login')->with('success', 'Pengguna dengan ID ' . $userId . ' berhasil Logout');
    }

    return redirect()->route('auth.login')->with('error', 'Pengguna tidak ditemukan');
}

public function welcome(){
    return view('welcome');
}
}
