@extends('layouts.master')

@section('title','Student Dashboard')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <div>

                <h4 class="mb-1">

                    Student Dashboard

                </h4>

                <p class="text-muted mb-0">

                    Welcome,

                    <strong>{{ Auth::user()->name }}</strong>

                </p>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <h5>Total Tasks</h5>

                <h2>{{ $totalTasks }}</h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <h5>Completed</h5>

                <h2>{{ $completedTasks }}</h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <h5>Pending</h5>

                <h2>{{ $pendingTasks }}</h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card">

            <div class="card-body">

                <h5>High Priority</h5>

                <h2>{{ $highPriorityTasks }}</h2>

            </div>

        </div>

    </div>

</div>


<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Recent Tasks

                </h4>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>Task</th>

                            <th>Priority</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentTasks as $task)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $task->title }}</td>

                            <td>{{ $task->priority }}</td>

                            <td>

                                {{ $task->completed ? 'Completed' : 'Pending' }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="4" class="text-center">

                                No Tasks Found

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body text-center">

                <h4>

                    Task Management

                </h4>

                <br>

                <a href="{{ route('student.tasks') }}"

                   class="btn btn-primary">

                    View My Tasks

                </a>

            </div>

        </div>

    </div>

</div>

@endsection