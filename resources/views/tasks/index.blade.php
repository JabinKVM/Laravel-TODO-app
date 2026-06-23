@extends('layouts.dashboard')

@section('content')

<h2 class="mb-4">Dashboard</h2>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h5>Total Tasks</h5>
                <h2>{{ $totalTasks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h5>Completed</h5>
                <h2>{{ $completedTasks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning shadow">
            <div class="card-body">
                <h5>Pending</h5>
                <h2>{{ $pendingTasks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h5>High Priority</h5>
                <h2>{{ $highPriorityTasks }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">All Tasks</h5>

        <a href="{{ route('create-task') }}" class="btn btn-success">
            Add Task
        </a>
    </div>

    <div class="card-body">

        <table class="table table-hover">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            @foreach($tasks as $task)

                <tr>

                    <td>{{ $task->id }}</td>

                    <td>{{ $task->title }}</td>

                    <td>
                        @if($task->priority == 'High')
                            <span class="badge bg-danger">High</span>
                        @elseif($task->priority == 'Medium')
                            <span class="badge bg-warning text-dark">Medium</span>
                        @else
                            <span class="badge bg-info">Low</span>
                        @endif
                    </td>

                    <td>
                        @if($task->completed)
                            <span class="badge bg-success">Completed</span>
                        @else
                            <span class="badge bg-secondary">Pending</span>
                        @endif
                    </td>

                    <td>

                        <a href="/edit/{{ $task->id }}"
                           class="btn btn-primary btn-sm">
                            Edit
                        </a>

                        <form action="/delete/{{ $task->id }}"
                              method="POST"
                              style="display:inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection