<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalUsers = User::count();

        $activeUsers = User::where('status', 'Active')->count();

        $blockedUsers = User::where('status', 'Blocked')->count();

        $totalTasks = Task::count();

        $completedTasks = Task::where('completed', true)->count();

        $pendingTasks = Task::where('completed', false)->count();

        $highPriority = Task::where('priority', 'High')->count();

        $mediumPriority = Task::where('priority', 'Medium')->count();

        $lowPriority = Task::where('priority', 'Low')->count();

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

    /*
    |--------------------------------------------------------------------------
    | User List
    |--------------------------------------------------------------------------
    */

    public function users()
    {
        $users = User::latest()->get();

        return view('admin.users', compact('users'));
    }

    /*
    |--------------------------------------------------------------------------
    | User Profile
    |--------------------------------------------------------------------------
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
public function block(User $user)
{
    if (strtolower($user->role) === 'admin') {
        return response()->json([
            'success' => false,
            'message' => 'Administrator cannot be blocked.'
        ], 403);
    }

    $user->status = 'Blocked';
    $user->save();

    return response()->json(['success' => true]);
}

public function unblock(User $user)
{
    $user->status = 'Active';
    $user->save();

    return response()->json(['success' => true]);
}
    
    /*
    |--------------------------------------------------------------------------
    | Delete User
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        if (strtolower($user->role) == 'admin') {

            return back()->with(

                'error',

                'Administrator account cannot be deleted.'

            );
        }

        $user->tasks()->delete();

        $user->delete();

        return back()->with(

            'success',

            'User deleted successfully.'

        );
    }
}