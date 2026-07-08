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

                    Welcome back,

                    <strong>{{ Auth::user()->name }}</strong> 👋

                </p>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <!-- Total Tasks -->

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

    <!-- Pending -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Pending

                        </p>

                        <h3 class="mb-0 text-warning">

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

    <!-- Completed -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            Completed

                        </p>

                        <h3 class="mb-0 text-success">

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

    <!-- High Priority -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">

                            High Priority

                        </p>

                        <h3 class="mb-0 text-danger">

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
<div class="row">

    <!-- Quick Actions -->

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Quick Actions

                </h4>

            </div>

            <div class="card-body">

                <a href="{{ route('student.tasks') }}"
                   class="btn btn-primary w-100 mb-3">

                    <i class="bx bx-task me-2"></i>

                    My Tasks

                </a>

                <a href="{{ route('profile.edit') }}"
                   class="btn btn-info w-100">

                    <i class="bx bx-user me-2"></i>

                    My Profile

                </a>

            </div>

        </div>

    </div>

    <!-- Recent Tasks -->

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4 class="card-title mb-0">

                    Recent Tasks

                </h4>

                <a href="{{ route('student.tasks') }}"
                   class="btn btn-sm btn-primary">

                    View All

                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead>

                        <tr>

                            <th>Title</th>

                            <th>Priority</th>

                            <th>Due Date</th>

                            <th>Status</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($recentTasks as $task)

                            <tr>

                                <td>

                                    {{ $task->title }}

                                </td>

                                <td>

                                    @if($task->priority=='High')

                                        <span class="badge bg-danger">

                                            High

                                        </span>

                                    @elseif($task->priority=='Medium')

                                        <span class="badge bg-warning">

                                            Medium

                                        </span>

                                    @else

                                        <span class="badge bg-success">

                                            Low

                                        </span>

                                    @endif

                                </td>

                                <td>

                                    {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}

                                </td>

                                <td>

                                    @if($task->completed)

                                        <span class="badge bg-success">

                                            Completed

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Pending

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">

                                    No Tasks Assigned Yet

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection