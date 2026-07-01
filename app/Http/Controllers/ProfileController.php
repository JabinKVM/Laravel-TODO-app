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

    return view('profile.edit', compact(
        'user',
        'totaltasks',
        'completedTasks',
        'pendingTasks',
        'highPriorityTasks'
    ));
}

    /**
     * Update the user's profile information.
     */
public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = Auth::user();

    // Update user details
    $user->name = $request->name;
    $user->email = $request->email;

    // Upload profile photo
    if ($request->hasFile('profile_photo')) {

        // Delete old photo
        if ($user->profile_photo &&
            Storage::disk('public')->exists($user->profile_photo)) {

            Storage::disk('public')->delete($user->profile_photo);
        }

        // Store new photo
        $path = $request->file('profile_photo')
                        ->store('profiles', 'public');

        // Save path
        $user->profile_photo = $path;
    }

    // Save user
    $user->save();

    return redirect()
            ->route('profile.edit')
            ->with('success', 'Profile updated successfully.');
}   

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
{
    $request->validateWithBag('userDeletion', [
        'password' => ['required', 'current_password'],
    ]);

    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login')
    ->with('success', 'Your account has been deleted successfully.');
}
}


