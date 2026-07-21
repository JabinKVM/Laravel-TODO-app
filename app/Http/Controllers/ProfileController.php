<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
{
    $user = $request->user();

    $totaltasks = Task::where('user_id', $user->id)->count();

    $completedTasks = Task::where('user_id', $user->id)
        ->where('completed', true)
        ->count();

    $pendingTasks = Task::where('user_id', $user->id)
        ->where('completed', false)
        ->count();

    $highPriorityTasks = Task::where('user_id', $user->id)
        ->where('priority', 'High')
        ->count();
    
    $user = Auth::user();

$school = null;
$student = null;

if ($user->role == 'school') {
    $school = $user->school;
}

if ($user->role == 'student') {
    $student = $user->student;
}

    return view('profile.edit', compact(
    'user',
    'school',
    'student',
    'totaltasks',
    'completedTasks',
    'pendingTasks',
    'highPriorityTasks'
));
}

    /**
     * Update the user's profile information.
     */
    public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    // Delete old photo
    if ($user->profile_photo &&
        Storage::disk('public')->exists($user->profile_photo)) {

        Storage::disk('public')->delete($user->profile_photo);
    }

    // Store new photo
    $path = $request->file('profile_photo')
        ->store('profile_photos', 'public');

    $user->profile_photo = $path;
    $user->save();

    return back()->with('success', 'Profile photo updated successfully.');
}
    public function update(Request $request)
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore(Auth::id()),
        ],
    ]);

    $user = Auth::user();

    $user->update([
        'name'  => $request->name,
        'email' => $request->email,
    ]);

    return back()->with('success', 'Profile updated successfully.');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {

        throw ValidationException::withMessages([
            'current_password' => 'Current password is incorrect.',
        ]);

    }

    $user->password = Hash::make($request->password);

    $user->save();

    return back()->with('success', 'Password changed successfully.');
}
public function destroy(Request $request)
{
    abort(404);
}
}


