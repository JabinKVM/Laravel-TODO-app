<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function index(Request $request)
{
    $search = $request->search;

    $tasks = Task::where('user_id', auth()->id())
        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', '%' . $search . '%');

            });

        })
        ->oldest()
        ->get();

    return view('tasks.index', compact('tasks', 'search'));
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
    
    public function inlineUpdate(Request $request, Task $task)
{
    // Make sure the task belongs to the logged-in user
    if ($task->user_id != Auth::id()) {
        return response()->json([
            'success' => false,
            'message' => 'Unauthorized.'
        ], 403);
    }

    // Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'priority' => 'required|in:Low,Medium,High',
        'completed' => 'required|boolean',
    ]);

    // Update task
    $task->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Task updated successfully.',
        'task' => [
            'id' => $task->id,
            'title' => $task->title,
            'priority' => $task->priority,
            'completed' => $task->completed,
        ]
    ]);
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
    public function ajaxDelete(Task $task)
{
    if ($task->user_id != Auth::id()) {

        return response()->json([
            'success' => false,
            'message' => 'Unauthorized.'
        ], 403);

    }

    $task->delete();

    return response()->json([
        'success' => true,
        'message' => 'Task deleted successfully.'
    ]);
}
}