<?php

namespace App\Http\Controllers;

use App\Models\PembelianM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KPembeliController extends Controller
{
    public function index(){
        $data = User::where('role', 1)->get();
        return view('pages.admin.k-pembeli.index',compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'active' => 'required|boolean',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'nullable|string|min:8',
            'product' => 'required',

        ]);
        if($request->password == null){
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->role = 1;
            $user->active = $request->active;
            $user->email = $request->email;
            $user->password = Hash::make("Trisurya");
            $user->save();
            $jadi = new PembelianM();
            $jadi->product_id = $request->product;
            $jadi->user_id = $user->id;
            $jadi->save();
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->role = 1;
            $user->active = $request->active;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $jadi = new PembelianM();
            $jadi->product_id = $request->product;
            $jadi->user_id = $user->id;
            $jadi->save();
        }


        return redirect()->back()->with('success', 'User added successfully.');
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'active' => 'required|boolean',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable',
        ]);

        // Handle password change if provided
        if ($request->filled('password')) {
            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
            ]);
        }else{

            $user->update([
                'name' => $request->name,
                'username' => $request->username,
                'active' => $request->active,
                'email' => $request->email,
                'password' => $request->password ? Hash::make($request->password) : $user->password,
            ]);
        }

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    // Delete a user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $pesanan = PembelianM::where('user_id',$id)->get();
        foreach($pesanan as $p){
            $pesanans = PembelianM::find($p->id);
            $pesanans->delete();
        }

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
