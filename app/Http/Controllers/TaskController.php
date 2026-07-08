<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\School;
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

        $tasks = Task::with('user')

            ->where('created_by', Auth::id())

            ->latest()

            ->paginate(10);

        return view('school.tasks.index', compact('tasks'));
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
            ->where('status',1)
            ->orderBy('name')
            ->get();

        return view('school.tasks.create', compact('students'));
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Store Task
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([

            'user_id'=>'required|exists:users,id',

            'title'=>'required|max:255',

            'description'=>'nullable',

            'priority'=>'required|in:Low,Medium,High',

            'due_date'    => 'nullable|date',

        ]);

        Task::create([

            'user_id'=>$request->user_id,

            'created_by'=>Auth::id(),

            'title'=>$request->title,

            'description'=>$request->description,

            'priority'=>$request->priority,

            'due_date'    => $request->due_date,

            'completed'=>false

        ]);

        return redirect()

            ->route('school.tasks.index')

            ->with('success','Task assigned successfully.');
    }
        /*
    |--------------------------------------------------------------------------
    | SCHOOL - Edit Task
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        if ($task->created_by != Auth::id()) {
            abort(403);
        }

        $school = Auth::user()->school;

        $students = Student::where('school_id', $school->id)
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return view('school.tasks.edit', compact('task', 'students'));
    }

    /*
    |--------------------------------------------------------------------------
    | SCHOOL - Update Task
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $request->validate([

            'user_id'     => 'required|exists:users,id',

            'title'       => 'required|max:255',

            'description' => 'nullable',

            'priority'    => 'required|in:Low,Medium,High',
            
            'due_date' => 'nullable|date',

        ]);

        $task = Task::findOrFail($id);

        if ($task->created_by != Auth::id()) {
            abort(403);
        }

        $task->update([

            'user_id'     => $request->user_id,

            'title'       => $request->title,

            'description' => $request->description,

            'priority'    => $request->priority

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
        $task = Task::findOrFail($id);

        if ($task->created_by != Auth::id()) {
            abort(403);
        }

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
        $tasks = Task::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('student.tasks.index', compact('tasks'));
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - View Single Task
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('student.tasks.show', compact('task'));
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - Mark Complete
    |--------------------------------------------------------------------------
    */

    public function complete($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->completed = true;

        $task->save();

        return redirect()
            ->back()
            ->with('success', 'Task marked as completed.');
    }

    /*
    |--------------------------------------------------------------------------
    | STUDENT - Mark Pending Again
    |--------------------------------------------------------------------------
    */

    public function pending($id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $task->completed = false;

        $task->save();

        return redirect()
            ->back()
            ->with('success', 'Task marked as pending.');
    }

}