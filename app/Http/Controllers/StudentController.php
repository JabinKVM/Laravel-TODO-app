<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $totalTasks = Task::where('user_id', Auth::id())->count();

        $completedTasks = Task::where('user_id', Auth::id())
            ->where('completed', true)
            ->count();

        $pendingTasks = Task::where('user_id', Auth::id())
            ->where('completed', false)
            ->count();

        $highPriorityTasks = Task::where('user_id', Auth::id())
            ->where('priority', 'High')
            ->count();

        $recentTasks = Task::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'highPriorityTasks',
            'recentTasks'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | My Tasks
    |--------------------------------------------------------------------------
    */

    public function myTasks()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('student.tasks.index', compact('tasks'));
    }

    /*
    |--------------------------------------------------------------------------
    | View Task
    |--------------------------------------------------------------------------
    */

    public function show(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        return view('student.tasks.show', compact('task'));
    }
        /*
    |--------------------------------------------------------------------------
    | Mark Task as Completed
    |--------------------------------------------------------------------------
    */

    public function complete(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->update([
            'completed' => true,
        ]);

        return redirect()
            ->route('student.tasks')
            ->with('success', 'Task marked as completed successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Mark Task as Pending Again
    |--------------------------------------------------------------------------
    */

    public function pending(Task $task)
    {
        if ($task->user_id != Auth::id()) {
            abort(403);
        }

        $task->update([
            'completed' => false,
        ]);

        return redirect()
            ->route('student.tasks')
            ->with('success', 'Task marked as pending.');
    }
}