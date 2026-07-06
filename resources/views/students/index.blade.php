@extends('layouts.master')

@section('title')
Student Management
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Title -->
    <div class="row">
        <div class="col-12">

            <div class="page-title-box d-flex align-items-center justify-content-between">

                <h4 class="mb-0">
                    Student Management
                </h4>

                <div class="page-title-right">

                    <a href="{{ route('students.create') }}"
                       class="btn btn-primary">

                        <i class="bx bx-plus me-1"></i>

                        Register Student

                    </a>

                </div>

            </div>

        </div>
    </div>

    <!-- Student Table -->

    <div class="card">

        <div class="card-body">

            <table id="studentsTable"
                   class="table table-editable table-nowrap align-middle table-edits datatable">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Student ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Department</th>

                        <th>Status</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

@forelse($students as $student)

<tr id="student-row-{{ $student->id }}"
    data-id="{{ $student->id }}">

    <td class="student-id" style="width:80px">

        {{ $loop->iteration }}

    </td>

    <td class="student-student-id">

        {{ $student->student_id }}

    </td>

    <td class="student-name">

        {{ $student->name }}

    </td>

    <td class="student-email">

        {{ $student->email }}

    </td>

    <td class="student-department">

        {{ $student->department }}

    </td>

    <td class="student-status">

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

    <td class="student-actions text-center">

        <!-- View -->

        <a href="{{ route('students.show', $student->id) }}"
           class="btn btn-outline-secondary btn-sm"
           title="View Student">

            <i class="fas fa-eye"></i>

        </a>

        <!-- Edit -->

        <button
            type="button"
            class="btn btn-outline-secondary btn-sm edit-student"
            data-id="{{ $student->id }}"
            title="Edit Student">

            <i class="fas fa-pencil-alt"></i>

        </button>

    </td>

</tr>

@empty

@endforelse

</tbody>

            </table>

        </div>

    </div>

</div>

@endsection