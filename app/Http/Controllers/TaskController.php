<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Assigned Tasks
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $school = Auth::user()->school;

        $tasks = Task::with('student')
            ->where('school_id', $school->id)
            ->latest()
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'role'  => 'school',
            'title' => 'Assigned Tasks',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Create Task
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $school = Auth::user()->school;

        $students = Student::where('school_id', $school->id)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('tasks.create', [
            'students' => $students,
            'role'     => 'school',
            'title'    => 'Assign Task',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Store Task
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'student_id'  => 'required|exists:students,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:High,Medium,Low',
            'due_date'    => 'required|date',
        ]);

        $school = Auth::user()->school;

        Task::create([
            'school_id'   => $school->id,
            'student_id'  => $request->student_id,
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
            'status'      => 'Pending',
        ]);

        return redirect()
            ->route('school.tasks.index')
            ->with('success', 'Task assigned successfully.');
    }
        /*
    |--------------------------------------------------------------------------
    | SCHOOL - View Task
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $school = Auth::user()->school;

        $task = Task::with('student')
            ->where('school_id', $school->id)
            ->where('id', $id)
            ->firstOrFail();

        return view('tasks.show', [
            'task'  => $task,
            'role'  => 'school',
            'title' => 'Task Details',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Edit Task
    |--------------------------------------------------------------------------
    */

   public function edit($id)
{
    $school = Auth::user()->school;

    $task = Task::where('school_id', $school->id)
        ->where('id', $id)
        ->firstOrFail();

    $students = Student::where('school_id', $school->id)
        ->orderBy('name')
        ->get();

    return view('tasks.edit', [
        'task' => $task,
        'students' => $students,
    ]);
}

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Update Task
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id'  => 'required|exists:students,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority'    => 'required|in:High,Medium,Low',
            'due_date'    => 'required|date',
        ]);

        $school = Auth::user()->school;

        $task = Task::where('school_id', $school->id)
            ->where('id', $id)
            ->firstOrFail();

        $task->update([
            'student_id'  => $request->student_id,
            'title'       => $request->title,
            'description' => $request->description,
            'priority'    => $request->priority,
            'due_date'    => $request->due_date,
        ]);

        return redirect()
            ->route('school.tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Delete Task
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $school = Auth::user()->school;

        $task = Task::where('school_id', $school->id)
            ->where('id', $id)
            ->firstOrFail();

        $task->delete();

        return redirect()
            ->route('school.tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
        /*
    |--------------------------------------------------------------------------
    | STUDENT - My Tasks
    |--------------------------------------------------------------------------
    */

    public function myTasks()
    {
        $student = Auth::user()->student;

        $tasks = Task::with('school')
            ->where('student_id', $student->id)
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
    | STUDENT - Pending Tasks
    |--------------------------------------------------------------------------
    */

    public function pendingTasks()
    {
        $student = Auth::user()->student;

        $tasks = Task::with('school')
            ->where('student_id', $student->id)
            ->where('status', 'Pending')
            ->latest()
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'role'  => 'student',
            'title' => 'Pending Tasks',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - Completed Tasks
    |--------------------------------------------------------------------------
    */

    public function completedTasks()
    {
        $student = Auth::user()->student;

        $tasks = Task::with('school')
            ->where('student_id', $student->id)
            ->where('status', 'Completed')
            ->latest()
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'role'  => 'student',
            'title' => 'Completed Tasks',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - High Priority Tasks
    |--------------------------------------------------------------------------
    */

    public function highPriorityTasks()
    {
        $student = Auth::user()->student;

        $tasks = Task::with('school')
            ->where('student_id', $student->id)
            ->where('priority', 'High')
            ->latest()
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'role'  => 'student',
            'title' => 'High Priority Tasks',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - View Task
    |--------------------------------------------------------------------------
    */

    public function studentShow($id)
    {
        $student = Auth::user()->student;

        $task = Task::with('school')
            ->where('student_id', $student->id)
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
    | STUDENT - Mark Completed
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
            ->back()
            ->with('success', 'Task marked as completed.');
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - Mark Pending
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
            ->back()
            ->with('success', 'Task marked as pending.');
    }

}