<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::table('users')->orderBy('created_at', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        DB::table('users')->insert([
            'name'       => $request->name,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'User "' . $request->username . '" created successfully.');
    }

    public function destroy($id)
    {
        // Prevent deleting self
        if ($id == Session::get('user_id')) {
            return back()->withErrors(['delete' => 'You cannot delete your own account.']);
        }

        DB::table('users')->where('id', $id)->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
