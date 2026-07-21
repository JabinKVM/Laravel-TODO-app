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
    $student = Auth::user()->student;

    $totalTasks = Task::where('student_id', $student->id)->count();

    $pendingTasks = Task::where('student_id', $student->id)
        ->where('status', 'Pending')
        ->count();

    $completedTasks = Task::where('student_id', $student->id)
        ->where('status', 'Completed')
        ->count();

    $highPriorityTasks = Task::where('student_id', $student->id)
        ->where('priority', 'High')
        ->count();

    $recentTasks = Task::where('student_id', $student->id)
        ->latest()
        ->take(5)
        ->get();

    return view('students.dashboard', compact(
        'totalTasks',
        'pendingTasks',
        'completedTasks',
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
    $student = Auth::user()->student;

    $tasks = Task::where('student_id', $student->id)
        ->latest()
        ->get();

    return view('tasks.index', [
        'tasks' => $tasks,
        'role'  => 'student',
        'title' => 'My Tasks',
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | View Task
    |--------------------------------------------------------------------------
    */

   public function show($id)
{
    $student = Auth::user()->student;

    $task = Task::where('student_id', $student->id)
        ->where('id', $id)
        ->firstOrFail();

    return view('tasks.show', [
        'task'  => $task,
        'role'  => 'student',
        'title' => 'Task Details',
    ]);
}
        /*
    |--------------------------------------------------------------------------
    | Mark Task as Completed
    |--------------------------------------------------------------------------
    */

    public function complete($id)
{
    $student = Auth::user()->student;

    $task = Task::where('student_id', $student->id)
        ->where('id', $id)
        ->firstOrFail();

    $task->update([
        'status' => 'Completed',
    ]);

    return redirect()
        ->route('student.tasks.index')
        ->with('success', 'Task marked as completed.');
}

    /*
    |--------------------------------------------------------------------------
    | Mark Task as Pending Again
    |--------------------------------------------------------------------------
    */

    public function pending($id)
{
    $student = Auth::user()->student;

    $task = Task::where('student_id', $student->id)
        ->where('id', $id)
        ->firstOrFail();

    $task->update([
        'status' => 'Pending',
    ]);

    return redirect()
        ->route('student.tasks.index')
        ->with('success', 'Task marked as pending.');
}
}