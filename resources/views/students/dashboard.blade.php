@extends('layouts.master')

@section('title','Student Dashboard')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-1">
                    Student Dashboard
                </h4>

                <p class="text-muted mb-0">
                    Welcome back,
                    <strong>{{ Auth::user()->name }}</strong> 👋
                </p>

            </div>

        </div>

    </div>

</div>

{{-- Statistics --}}

<div class="row">

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Total Tasks
                        </p>

                        <h3 class="mb-0">

                            {{ $totalTasks }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center">

                        <span class="avatar-title rounded-circle bg-primary">

                            <i class="bx bx-task font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Completed

                        </p>

                        <h3 class="text-success">

                            {{ $completedTasks }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-success align-self-center">

                        <span class="avatar-title rounded-circle bg-success">

                            <i class="bx bx-check-circle font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Pending

                        </p>

                        <h3 class="text-warning">

                            {{ $pendingTasks }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-warning align-self-center">

                        <span class="avatar-title rounded-circle bg-warning">

                            <i class="bx bx-time font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            High Priority

                        </p>

                        <h3 class="text-danger">

                            {{ $highPriorityTasks }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-danger align-self-center">

                        <span class="avatar-title rounded-circle bg-danger">

                            <i class="bx bx-error font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

{{-- Recent Tasks --}}

<div class="card">

    <div class="card-header">

        <h4 class="card-title">

            Recent Tasks

        </h4>

    </div>

    <div class="card-body">

        @if($recentTasks->count())

            <div class="table-responsive">

                <table class="table table-bordered align-middle">

                    <thead>

                    <tr>

                        <th>Title</th>

                        <th>Priority</th>

                        <th>Due Date</th>

                        <th>Status</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($recentTasks as $task)

                        <tr>

                            <td>{{ $task->title }}</td>

                            <td>{{ $task->priority }}</td>

                            <td>

                                {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}

                            </td>

                            <td>

                               @if($task->status == 'Completed')

    <span class="badge bg-success">
        Completed
    </span>

@else

    <span class="badge bg-warning">
        Pending
    </span>

@endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="text-center text-muted">

                No Tasks Assigned

            </div>

        @endif

    </div>

</div>

@endsection