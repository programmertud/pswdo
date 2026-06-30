<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Hardcoded credentials (change as needed)
    private const ADMIN_USERNAME = 'admin';
    private const ADMIN_PASSWORD = 'cswdo2025';

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

        if (
            $request->username === self::ADMIN_USERNAME &&
            $request->password === self::ADMIN_PASSWORD
        ) {
            Session::put('authenticated', true);
            Session::put('username', $request->username);
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
