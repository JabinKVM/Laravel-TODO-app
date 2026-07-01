@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <div>

                <h4 class="mb-1">
                    Dashboard
                </h4>

                <p class="text-muted mb-0">
                    Welcome back,
                    <strong>{{ Auth::user()->name }}</strong> 👋
                </p>

            </div>

        </div>

    </div>

</div>

<!-- Statistics Cards -->

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

                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-primary">

                            <i class="bx bx-list-ul font-size-24"></i>

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

                    <div class="avatar-sm rounded-circle bg-success align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-success">

                            <i class="bx bx-check-circle font-size-24"></i>

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

                    <div class="avatar-sm rounded-circle bg-warning align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-warning">

                            <i class="bx bx-time-five font-size-24"></i>

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

                    <div class="avatar-sm rounded-circle bg-danger align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-danger">

                            <i class="bx bx-error font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Welcome Card -->

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">
                    Welcome to TodoPro 🚀
                </h4>

                <p class="text-muted">

                    TodoPro helps you organize your daily work efficiently.
                    Use the sidebar to create, edit, complete and manage your tasks.

                </p>

                <a href="{{ route('tasks.create') }}"
                   class="btn btn-primary">

                    <i class="bx bx-plus"></i>

                    Create New Task

                </a>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card bg-primary text-white">

            <div class="card-body text-center">

                <i class="bx bx-task display-4 mb-3"></i>

                <h3>

                    {{ $totalTasks }}

                </h3>

                <p class="mb-0">

                    Total Tasks Created

                </p>

            </div>

        </div>

    </div>

</div>

<!-- Quick Navigation -->

<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Quick Navigation

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-3">

                        <a href="{{ route('tasks.index') }}"
                           class="btn btn-outline-primary w-100 mb-3">

                            <i class="bx bx-list-ul"></i><br>

                            All Tasks

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="{{ route('tasks.pending') }}"
                           class="btn btn-outline-warning w-100 mb-3">

                            <i class="bx bx-time-five"></i><br>

                            Pending Tasks

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="{{ route('tasks.completed') }}"
                           class="btn btn-outline-success w-100 mb-3">

                            <i class="bx bx-check-circle"></i><br>

                            Completed Tasks

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="{{ route('tasks.high-priority') }}"
                           class="btn btn-outline-danger w-100 mb-3">

                            <i class="bx bx-error"></i><br>

                            High Priority

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection