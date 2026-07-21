@extends('layouts.master')

@section('title','School Details')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex justify-content-between align-items-center">

                    <h4 class="mb-0">
                        School Details
                    </h4>

                    <a href="{{ route('admin.schools.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>


        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif


        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    School Information

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <strong>School Name</strong>

                        <p>{{ $school->name }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Email</strong>

                        <p>{{ $school->email }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Phone</strong>

                        <p>{{ $school->phone }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <strong>Status</strong>

                        <p>

                            @if($school->status)

                                <span class="badge bg-success">

                                    Active

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Blocked

                                </span>

                            @endif

                        </p>

                    </div>

                    <div class="col-md-12 mb-3">

                        <strong>Address</strong>

                        <p>{{ $school->address }}</p>

                    </div>

                </div>

            </div>

        </div>


        <div class="card mt-3">

            <div class="card-header">

                <h5 class="mb-0">

                    Statistics

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <div class="border rounded p-4 text-center">

                            <h6>Total Students</h6>

                            <h2>{{ $totalStudents }}</h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <div class="mt-3">

            <a href="{{ route('admin.schools.edit',$school->id) }}"
               class="btn btn-warning">

                Edit School

            </a>

        </div>

    </div>

</div>

@endsection