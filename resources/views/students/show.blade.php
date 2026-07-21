@extends('layouts.master')

@section('title','Student Details')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">

                        Student Details

                    </h4>

                    <a href="{{ route('school.students.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Student Information

                </h4>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="fw-bold">

                            Name

                        </label>

                        <p>

                            {{ $student->name }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="fw-bold">

                            Email

                        </label>

                        <p>

                            {{ $student->email }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="fw-bold">

                            Phone

                        </label>

                        <p>

                            {{ $student->phone }}

                        </p>

                    </div>

                    <div class="col-md-6 mb-4">

                        <label class="fw-bold">

                            Status

                        </label>

                        <p>

                            @if($student->status)

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

                    <div class="col-md-12">

                        <label class="fw-bold">

                            Address

                        </label>

                        <p>

                            {{ $student->address }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection