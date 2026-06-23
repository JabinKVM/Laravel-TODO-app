<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
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
}