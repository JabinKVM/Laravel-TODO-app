@extends('layouts.master')

@section('title')
Student Profile
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Title -->

    <div class="row">

        <div class="col-12">

            <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                <h4 class="mb-sm-0 font-size-18">

                    Student Profile

                </h4>

                <div class="page-title-right">

                    <a href="{{ route('students.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-arrow-left me-1"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>

    </div>

    <!-- Profile Card -->

    <div class="card">

        <div class="card-body">

            <div class="row">

                <!-- Photo -->

                <div class="col-md-3 text-center">

                    @if($student->profile_photo)

                        <img src="{{ asset('storage/'.$student->profile_photo) }}"
                             class="rounded-circle img-thumbnail"
                             width="180"
                             height="180">

                    @else

                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                             class="rounded-circle img-thumbnail"
                             width="180"
                             height="180">

                    @endif

                </div>

                <!-- Details -->

                <div class="col-md-9">

                    <table class="table table-bordered align-middle">

                        <tbody>

                            <tr>

                                <th width="220">

                                    Student ID

                                </th>

                                <td>

                                    {{ $student->student_id }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Name

                                </th>

                                <td>

                                    {{ $student->name }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Email

                                </th>

                                <td>

                                    {{ $student->email }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Phone

                                </th>

                                <td>

                                    {{ $student->phone }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Date of Birth

                                </th>

                                <td>

                                    {{ $student->dob }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Gender

                                </th>

                                <td>

                                    {{ $student->gender }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Department

                                </th>

                                <td>

                                    {{ $student->department }}

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Status

                                </th>

                                <td>

                                    @if($student->status == 'Active')

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    @else

                                        <span class="badge bg-danger">

                                            Inactive

                                        </span>

                                    @endif

                                </td>

                            </tr>

                            <tr>

                                <th>

                                    Registered On

                                </th>

                                <td>

                                    {{ $student->created_at->format('d M Y') }}

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection