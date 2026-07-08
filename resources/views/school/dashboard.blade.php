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

<!-- Statistics -->

<div class="row">

    <!-- Total Students -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Total Students
                        </p>

                        <h3 class="mb-0">

                            {{ $totalStudents }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-primary">

                            <i class="bx bx-user font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Active Students -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Active Students
                        </p>

                        <h3 class="mb-0 text-success">

                            {{ $activeStudents }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-success align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-success">

                            <i class="bx bx-user-check font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Blocked Students -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Blocked Students
                        </p>

                        <h3 class="mb-0 text-warning">

                            {{ $blockedStudents }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-warning align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-warning">

                            <i class="bx bx-user-x font-size-24"></i>

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Assigned Tasks -->

    <div class="col-xl-3 col-md-6">

        <div class="card mini-stats-wid">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <p class="text-muted fw-medium">
                            Assigned Tasks
                        </p>

                        <h3 class="mb-0 text-danger">

                            {{ $assignedTasks }}

                        </h3>

                    </div>

                    <div class="avatar-sm rounded-circle bg-danger align-self-center mini-stat-icon">

                        <span class="avatar-title rounded-circle bg-danger">

                            <i class="bx bx-task font-size-24"></i>

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

                    Welcome to School Dashboard 🎓

                </h4>

                <p class="text-muted">

                    Register students, manage their details, assign tasks and monitor their progress.

                </p>

                <a href="{{ route('school.students.create') }}"
                   class="btn btn-primary">

                    <i class="bx bx-plus"></i>

                    Register Student

                </a>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card bg-primary text-white">

            <div class="card-body text-center">

                <i class="bx bx-user display-4 mb-3"></i>

                <h3>

                    {{ $totalStudents }}

                </h3>

                <p class="mb-0">

                    Total Students

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

                        <a href="{{ route('school.students') }}"
                           class="btn btn-outline-primary w-100 mb-3">

                            <i class="bx bx-group"></i><br>

                            Students

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="{{ route('school.students.create') }}"
                           class="btn btn-outline-success w-100 mb-3">

                            <i class="bx bx-user-plus"></i><br>

                            Register Student

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="#"
                           class="btn btn-outline-warning w-100 mb-3">

                            <i class="bx bx-task"></i><br>

                            Assign Task

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="#"
                           class="btn btn-outline-danger w-100 mb-3">

                            <i class="bx bx-check-circle"></i><br>

                            Completed Tasks

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection