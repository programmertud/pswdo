<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
            'name'      => 'required|string|max:100',
            'username'  => 'required|string|max:50|unique:users,username,' . $userId,
            'job_title' => 'nullable|string|max:100',
        ]);

        $updateData = [
            'name'       => $request->name,
            'username'   => $request->username,
            'job_title'  => $request->job_title,
            'updated_at' => now(),
        ];

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $request->validate(['avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

            // Delete old avatar if it exists
            $user = DB::table('users')->find($userId);
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $file = $request->file('avatar');
            $filename = 'avatar_' . $userId . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('avatars'), $filename);
            $updateData['avatar'] = 'avatars/' . $filename;
        }

        DB::table('users')->where('id', $userId)->update($updateData);

        // Update session
        Session::put('name', $request->name);
        Session::put('username', $request->username);
        if (isset($updateData['avatar'])) {
            Session::put('avatar', $updateData['avatar']);
        }

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $userId = Session::get('user_id');

        $request->validate([
            'current_password' => 'required|string',
            'new_password'     => 'required|string|min:6|confirmed',
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
