@extends('layouts.master')

@section('title','Students')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">

                        Students

                    </h4>

                    <a href="{{ route('school.students.create') }}"
                       class="btn btn-primary">

                        <i class="bx bx-plus"></i>

                        Register Student

                    </a>

                </div>

            </div>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

   <table id="datatable"
       class="table table-bordered dt-responsive nowrap w-100">

        <thead>

            <tr>

                <th>Student ID</th>

                <th>Name</th>

                <th>Email</th>

                <th>Phone</th>

                <th>Status</th>

                <th>Edit</th>

            </tr>

        </thead>

        <tbody>

        @forelse($students as $student)

            <tr data-id="{{ $student->id }}">

                <td data-field="student_id">

                    {{ $student->student_id }}

                </td>

                <td data-field="name">

                    {{ $student->name }}

                </td>

                <td data-field="email">

                    {{ $student->email }}

                </td>

                <td data-field="phone">

                    {{ $student->phone }}

                </td>

                <td data-field="status">

                    @if($student->status)

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
    <div class="d-flex gap-2">

        <!-- View -->
        <a href="{{ route('school.students.show', $student->id) }}"
           class="btn btn-sm btn-outline-info"
           title="View">
            <i class="fas fa-eye"></i>
        </a>

        <!-- Edit -->
        <a href="{{ route('school.students.edit', $student->id) }}"
           class="btn btn-sm btn-outline-secondary"
           title="Edit">
            <i class="fas fa-pencil-alt"></i>
        </a>

        <!-- Block / Unblock -->
        @if($student->status)

            <form action="{{ route('school.students.block', $student->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-sm btn-outline-warning"
                        title="Block">
                    <i class="fas fa-ban"></i>
                </button>
            </form>

        @else

            <form action="{{ route('school.students.unblock', $student->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-sm btn-outline-success"
                        title="Unblock">
                    <i class="fas fa-check"></i>
                </button>
            </form>

        @endif

    </div>
</td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center">

                    No students found.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

                <div class="mt-3">

                    {{ $students->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection