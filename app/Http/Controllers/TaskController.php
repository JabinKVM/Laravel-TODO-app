<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
{
    $tasks = Task::all();

    $totalTasks = Task::count();

    $completedTasks = Task::where('completed', true)->count();

    $pendingTasks = Task::where('completed', false)->count();

    $highPriorityTasks = Task::where('priority', 'High')->count();

    return view('tasks.index', compact(
        'tasks',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'highPriorityTasks'
    ));
}

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|max:255'
            ],
            [
                'title.required' => 'Task field cannot be empty.',
                'title.max' => 'Task must not exceed 255 characters.'
            ]
        );

        Task::create([
            'title' => $request->title,
            'priority' => $request->priority,
            'completed' => false
        ]);

        return redirect('/');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:255'
            ],
            [
                'title.required' => 'Task field cannot be empty.',
                'title.max' => 'Task must not exceed 255 characters.'
            ]
        );

        $task = Task::findOrFail($id);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority
        ]);

        return redirect('/');
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);

        $task->completed = true;

        $task->save();

        return redirect('/');
    }

    public function destroy($id)
    {
        Task::destroy($id);

        return redirect('/');
    }
   public function pending()
{
    $tasks = Task::where('completed', false)->get();

    return view('tasks.pending',
        compact('tasks'));
}

public function completed()
{
    $tasks = Task::where('completed', true)->get();

    return view('tasks.completed',
        compact('tasks'));
}
public function highPriority()
{
    $tasks = Task::where('priority', 'High')->get();

    return view('tasks.high-priority', compact('tasks'));
}
}