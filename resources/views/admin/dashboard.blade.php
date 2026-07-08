@extends('layouts.master')

@section('title','Admin Dashboard')

@section('content')

<div class="row mb-4">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <div>

                <h4 class="mb-1">
                    Admin Dashboard
                </h4>

                <p class="text-muted mb-0">

                    Welcome back,

                    <strong>{{ Auth::user()->name }}</strong>

                </p>

            </div>

        </div>

    </div>

</div>


@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif


@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    {{ session('error') }}

    <button class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif


<div class="row">

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <h5 class="text-muted">

                            Total Schools

                        </h5>

                        <h2>

                            {{ $totalSchools }}

                        </h2>

                    </div>

                    <div>

                        <i class="bx bx-buildings display-5 text-primary"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <h5 class="text-muted">

                            Active Schools

                        </h5>

                        <h2 class="text-success">

                            {{ $activeSchools }}

                        </h2>

                    </div>

                    <div>

                        <i class="bx bx-check-circle display-5 text-success"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <div class="d-flex">

                    <div class="flex-grow-1">

                        <h5 class="text-muted">

                            Blocked Schools

                        </h5>

                        <h2 class="text-danger">

                            {{ $blockedSchools }}

                        </h2>

                    </div>

                    <div>

                        <i class="bx bx-block display-5 text-danger"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<div class="row">

    <div class="col-lg-12">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <h4 class="card-title mb-0">

                    Recently Registered Schools

                </h4>

                <a href="{{ route('schools.index') }}"
                   class="btn btn-primary btn-sm">

                    View All

                </a>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                        <tr>

                            <th>#</th>

                            <th>Name</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th>Created</th>

                        </tr>

                        </thead>

                        <tbody>

                        @forelse($recentSchools as $school)

                        <tr>

                            <td>

                                {{ $loop->iteration }}

                            </td>

                            <td>

                                {{ $school->name }}

                            </td>

                            <td>

                                {{ $school->email }}

                            </td>

                            <td>

                                {{ $school->phone }}

                            </td>

                            <td>

                                @if($school->status)

                                    <span class="badge bg-success">

                                        Active

                                    </span>

                                @else

                                    <span class="badge bg-danger">

                                        Blocked

                                    </span>

                                @endif

                            </td>

                            <td>

                                {{ $school->created_at->format('d M Y') }}

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="6"
                                class="text-center py-5">

                                <i class="bx bx-buildings display-4 text-muted"></i>

                                <h5 class="mt-3">

                                    No Schools Registered

                                </h5>

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