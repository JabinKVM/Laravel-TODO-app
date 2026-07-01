<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
   public function dashboard()
{
    // Dashboard Cards
    $totalUsers = User::count();
    $activeUsers = User::where('status', 'active')->count();
    $blockedUsers = User::where('status', 'blocked')->count();
    $totalTasks = Task::count();

    // Task Status
    $completedTasks = Task::where('completed', true)->count();
    $pendingTasks = Task::where('completed', false)->count();

    // Task Priority
    $highPriority = Task::where('priority', 'High')->count();
    $mediumPriority = Task::where('priority', 'Medium')->count();
    $lowPriority = Task::where('priority', 'Low')->count();

    // Recent Data
    $recentUsers = User::latest()->take(5)->get();
    $recentTasks = Task::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalUsers',
        'activeUsers',
        'blockedUsers',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'highPriority',
        'mediumPriority',
        'lowPriority',
        'recentUsers',
        'recentTasks'
    ));
}

    /**
     * View All Users
     */
    public function users(Request $request)
{
    $search = $request->search;

    $users = User::when($search, function ($query) use ($search) {

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");

    })
    ->orderBy('created_at', 'desc')
    ->paginate(10);

    return view('admin.users', compact('users', 'search'));
}
    /**
 * View User Profile
 */
public function show(User $user)
{
    $totalTasks = $user->tasks()->count();

    $completedTasks = $user->tasks()
        ->where('completed', true)
        ->count();

    $pendingTasks = $user->tasks()
        ->where('completed', false)
        ->count();

    $highPriorityTasks = $user->tasks()
        ->where('priority', 'High')
        ->count();

    return view('admin.show', compact(
        'user',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'highPriorityTasks'
    ));
}
    /**
     * Block User
     */
    public function block(User $user)
    {
        if ($user->role == 'admin') {

            return back()->with(
                'error',
                'Admin account cannot be blocked.'
            );

        }

        $user->update([
            'status' => 'blocked'
        ]);

        return back()->with(
            'success',
            'User blocked successfully.'
        );
    }

    /**
     * Unblock User
     */
    public function unblock(User $user)
    {
        $user->update([
            'status' => 'active'
        ]);

        return back()->with(
            'success',
            'User activated successfully.'
        );
    }

    /**
     * Delete User
     */
    public function destroy(User $user)
    {
        if ($user->role == 'admin') {

            return back()->with(
                'error',
                'Admin account cannot be deleted.'
            );

        }

        // Delete all tasks

        $user->tasks()->delete();

        // Delete user

        $user->delete();

        return back()->with(
            'success',
            'User deleted successfully.'
        );
    }
}