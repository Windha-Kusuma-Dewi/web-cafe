<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = USer::where('name', 'LIKE', '%'.$request->search.'%')->orderBy('name', 'ASC')->simplePaginate(5);
        return view('user.user', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.usercreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'role'=>'required',
        ], [
            'role.required' => 'Role pengguna wajib diisi',
            'name.required' => 'Nama pengguna wajib diisi',
            'email.required' => 'Email pengguna wajib diisi',
            'password.required' => 'Password pengguna wajib diisi',
            'min.required' => 'Password minimal 6 karakter',
        ]);

        // menambahkan data pengguna baru ke dalam database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        //jika Medicine::create berhasil (if), jika gagal (else)
        if ($user) {
            return redirect()->route('user')->with('success', 'Successfully added user data!');
        } else {
            return redirect()->route('user.tambah')->with('failed', 'User data failed to add!');
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::where('id', $id)->first();
        return view('user.useredit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'nullable|min:6', 
            'role'=>'required',
        ]); 

        $proses = User::where('id', $id)->update([
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($proses) {
            return redirect()->route('user')->with('success', 'User data successfully changed!');
        } else {
            return redirect()->route('user.edit', $id)->with('failed', 'Failed to change user data!');
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proses = User::where('id', $id)->delete();
        if ($proses) {
            return redirect()->back()->with('success', 'User data successfully deleted!');
        } else {
            return redirect()->back()->with('failed', 'Failed to delete user data!');
        }
    }
}
