<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // controller untuk halaman data user
    public function index()
    {
        $data = [
            'title' => 'User',
            'users' => DB::table('users')->get()
        ];

        return view('user.index', $data);
    }

    // controller untuk halaman tambah user
    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];

        return view('user.create', $data);
    }

    // controller untuk fungsi simpan user
    public function save(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'created_by' => auth()->user()->id,
            'created_at' => new DateTime(),
            'updated_by' => auth()->user()->id,
            'updated_at' => new DateTime(),
        ]);

        return redirect('/user');
    }

    // controller untuk halaman login
    public function login()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('user.login', $data);
    }


    // controller untuk fungsi login
    public function auth(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('invalidLogin', 'Username atau Password Salah');
    }


    // controller untuk fungsi logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    // controller untuk fungsi delete user
    public function deleteUser($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }


    // controller untuk halaman edit data user
    public function edit($id)
    {
        $data = [
            'title' => 'Tambah User',
            'user' => DB::table('users')
                ->where('id', $id)
                ->first(),
        ];

        return view('user.edit', $data);
    }


    // controller untuk fungsi update user
    public function update($id, Request $request)
    {
        DB::table('users')->where('id', $id)
            ->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'role' => $request->input('role'),
                'updated_by' => auth()->user()->id,
                'updated_at' => new DateTime(),
            ]);

        return redirect('/user');
    }


    // controller untuk fungsi update user
    public function updatePassword($id, Request $request)
    {
        DB::table('users')->where('id', $id)
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_by' => auth()->user()->id,
                'updated_at' => new DateTime(),
            ]);

        return redirect('/user');
    }
}
