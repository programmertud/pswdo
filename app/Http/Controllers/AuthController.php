<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::get('authenticated')) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = DB::table('users')->where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('authenticated', true);
            Session::put('user_id', $user->id);
            Session::put('username', $user->username);
            Session::put('name', $user->name);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['credentials' => 'Invalid username or password.'])->withInput();
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect()->route('login');
    }
}
