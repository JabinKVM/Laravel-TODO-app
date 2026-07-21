@extends('layouts.master')

@section('title', 'Schools')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">
                        Schools
                    </h4>

                    <a href="{{ route('admin.schools.create') }}"
                       class="btn btn-primary">

                        Register School

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

            <div class="card-header">

                <h5 class="mb-0">

                    School List

                </h5>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table id="datatable"
       class="table table-bordered dt-responsive nowrap w-100">

                        <thead class="table-light">

                            <tr>

                                <th width="60">#</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Phone</th>

                                <th>Status</th>

                                <th width="320">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($schools as $school)

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

                                    No schools found.

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

            @if($schools->hasPages())

                <div class="card-footer">

                    {{ $schools->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection