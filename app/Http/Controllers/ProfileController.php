<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{
    /**
     * Profile Page
     */
    public function index()
    {
        return view('profile.index', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Edit Profile
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($request->hasFile('profile_photo')) {

        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->profile_photo = $request->file('profile_photo')
            ->store('profiles', 'public');
    }

    $user->name = $request->name;
    $user->email = $request->email;

    $user->save();
    return redirect()
        ->route(auth()->user()->role.'.profile.index')
        ->with('success', 'Profile updated successfully.');



    }

    /**
     * Change Password Page
     */
    public function changePassword()
    {
        return view('profile.change_password');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {

        throw ValidationException::withMessages([
            'current_password' => 'Current password is incorrect.',
        ]);

    }

    $user->password = Hash::make($request->password);

    $user->save();

    return redirect()
        ->route(auth()->user()->role.'.profile.index')
        ->with('success', 'Password changed successfully.');
}
}