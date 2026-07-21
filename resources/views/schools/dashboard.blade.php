@extends('layouts.master')

@section('title', 'School Dashboard')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">
                        School Dashboard
                    </h4>

                </div>

            </div>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="row">

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6 class="text-muted">

                            Total Students

                        </h6>

                        <h2>

                            {{ $totalStudents }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6 class="text-muted">

                            Active Students

                        </h6>

                        <h2>

                            {{ $activeStudents }}

                        </h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6 class="text-muted">

                            Blocked Students

                        </h6>

                        <h2>

                            {{ $blockedStudents }}

                        </h2>

                    </div>

                </div>

            </div>

        </div>

        <div class="card mt-4">

            <div class="card-header">

                <h5>

                    Quick Actions

                </h5>

            </div>

            <div class="card-body">

                <a href="{{ route('school.students.create') }}"
   class="btn btn-primary">
    Register Student
</a>

                <a href="{{ route('school.students.index') }}"
                   class="btn btn-secondary">

                    View Students

                </a>

            </div>

        </div>

    </div>

</div>

@endsection