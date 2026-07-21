@extends('layouts.master')

@section('title', 'School Details')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

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

        <div class="card">

            <div class="card-header">
                <h4 class="card-title mb-0">
                    School Information
                </h4>
            </div>

            <div class="card-body">

               <table id="datatable"
       class="table table-bordered dt-responsive nowrap w-100"></table>

                    <tr>
                        <th width="250">School Name</th>
                        <td>{{ $school->name }}</td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td>{{ $school->email }}</td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td>{{ $school->phone }}</td>
                    </tr>

                    <tr>
                        <th>Address</th>
                        <td>{{ $school->address }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>

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

                    </tr>

                </table>

            </div>

        </div>

        <div class="row mt-3">

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6>Total Students</h6>

                        <h2>{{ $totalStudents }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6>Pending Tasks</h6>

                        <h2>{{ $pendingTasks }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-body text-center">

                        <h6>Completed Tasks</h6>

                        <h2>{{ $completedTasks }}</h2>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection