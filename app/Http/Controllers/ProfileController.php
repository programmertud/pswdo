<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index()
    {
        $user = DB::table('users')->find(Session::get('user_id'));
        return view('profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $userId = Session::get('user_id');

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $userId,
        ]);

        DB::table('users')->where('id', $userId)->update([
            'name'       => $request->name,
            'username'   => $request->username,
            'updated_at' => now(),
        ]);

        // Update session
        Session::put('name', $request->name);
        Session::put('username', $request->username);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $userId = Session::get('user_id');

        $request->validate([
            'current_password'      => 'required|string',
            'new_password'          => 'required|string|min:6|confirmed',
        ]);

        $user = DB::table('users')->find($userId);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        DB::table('users')->where('id', $userId)->update([
            'password'   => Hash::make($request->new_password),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }
}
