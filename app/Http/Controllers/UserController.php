<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'users' => DB::table('users')->get()
        ];

        return view('user.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User',
        ];

        return view('user.create', $data);
    }

    public function save(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'created_by' => 1,
            'created_at' => new DateTime(),
            'updated_by' => 1,
            'updated_at' => new DateTime(),
        ]);

        return redirect('/');
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];

        return view('user.login', $data);
    }

    public function auth(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('invalidLogin', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function deleteUser($id)
    {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect()->back();
    }
}
