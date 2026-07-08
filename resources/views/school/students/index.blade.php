@extends('layouts.master')

@section('title','Student Management')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                Student Management

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('school.dashboard') }}">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Students

                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="card">

    <div class="card-body">

        <div class="d-flex justify-content-end mb-3">

            <a href="{{ route('school.students.create') }}"
               class="btn btn-primary">

                <i class="bx bx-plus"></i>

                Register Student

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered align-middle datatable">

                <thead>

                <tr>

                    <th>SI NO.</th>

                    <th>Student ID</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Department</th>

                    <th>Status</th>

                    <th width="150">

                        Action

                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($students as $student)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $student->student_id }}</td>

                    <td>{{ $student->name }}</td>

                    <td>{{ $student->email }}</td>

                    

                    <td>{{ $student->department }}</td>

                    <td>

                        @if($student->status=='Active')

                            <span class="badge bg-success">

                                Active

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Inactive

                            </span>

                        @endif

                    </td>

                    <td>

                        <a href="{{ route('school.students.edit',$student->id) }}"
                           class="btn btn-outline-secondary btn-sm">

                            <i class="fas fa-pencil-alt"></i>

                        </a>

                        <form
                            action="{{ route('school.students.status',$student->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf

                            @method('PATCH')

                            <button
                                class="btn btn-outline-secondary btn-sm">

                                <i class="fas fa-ban"></i>

                            </button>

                        </form>

                        <form
                            action="{{ route('school.students.destroy',$student->id) }}"
                            method="POST"
                            style="display:inline;">

                            @csrf

                            @method('DELETE')

                            <button
                                class="btn btn-outline-secondary btn-sm"
                                onclick="return confirm('Delete this student?')">

                                <i class="fas fa-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No students found.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection