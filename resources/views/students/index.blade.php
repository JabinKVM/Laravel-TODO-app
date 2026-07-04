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

                    <tr>

                        <td style="width:80px">

                            {{ $loop->iteration }}

                        </td>

                        <td>

                            {{ $student->student_id }}

                        </td>

                        <td>

                            {{ $student->name }}

                        </td>

                        <td>

                            {{ $student->email }}

                        </td>

                        <td>

                            {{ $student->department }}

                        </td>

                        <td>

                            {{ $student->status }}

                        </td>

                        <td style="width:150px">

                            <!-- View -->

                            <a href="{{ route('students.show',$student->id) }}"
                               class="btn btn-outline-secondary btn-sm"
                               title="View Student">

                                <i class="fas fa-eye"></i>

                            </a>

                            <!-- Edit -->

                            <a href="{{ route('students.edit',$student->id) }}"
                               class="btn btn-outline-secondary btn-sm"
                               title="Edit Student">

                                <i class="fas fa-pencil-alt"></i>

                            </a>

                            <!-- Delete -->

                            <form action="{{ route('students.destroy',$student->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-secondary btn-sm"
                                    onclick="return confirm('Delete this student?')"
                                    title="Delete Student">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

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