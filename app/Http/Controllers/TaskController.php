<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        $totalTasks = Task::where('user_id', auth()->id())->count();

        $completedTasks = Task::where('user_id', auth()->id())
            ->where('completed', true)
            ->count();

        $pendingTasks = Task::where('user_id', auth()->id())
            ->where('completed', false)
            ->count();

        $highPriorityTasks = Task::where('user_id', auth()->id())
            ->where('priority', 'High')
            ->count();

        return view('dashboard', compact(
            'totalTasks',
            'completedTasks',
            'pendingTasks',
            'highPriorityTasks'
        ));
    }

    /**
     * All Tasks
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())
        ->orderBy('created_at', 'asc')   // oldest task first
        ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Create Task Page
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store Task
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required'
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'priority' => $request->priority,
            'completed' => false
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Edit Task
     */
    public function edit($id)
    {
        $task = Task::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update Task
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'priority' => 'required'
        ]);

        $task = Task::where('user_id', auth()->id())
            ->findOrFail($id);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Complete Task
     */
    public function complete($id)
    {
        $task = Task::where('user_id', auth()->id())
            ->findOrFail($id);

        $task->completed = true;
        $task->save();

        return redirect()->route('tasks.index')
            ->with('success', 'Task completed.');
    }

    /**
     * Delete Task
     */
    public function destroy($id)
    {
        $task = Task::where('user_id', auth()->id())
            ->findOrFail($id);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted.');
    }

    /**
     * Pending Tasks
     */
    public function pending()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->where('completed', false)
            ->latest()
            ->get();

        return view('tasks.pending', compact('tasks'));
    }

    /**
     * Completed Tasks
     */
    public function completed()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->where('completed', true)
            ->latest()
            ->get();

        return view('tasks.completed', compact('tasks'));
    }

    /**
     * High Priority Tasks
     */
    public function highPriority()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->where('priority', 'High')
            ->latest()
            ->get();

        return view('tasks.high_priority', compact('tasks'));
    }
}