@extends('layouts.master')

@section('title','School Management')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0">

                School Management

            </h4>

            <div>

                <a href="{{ route('schools.create') }}"
                   class="btn btn-primary">

                    <i class="bx bx-plus"></i>

                    Register School

                </a>

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

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th width="5%">#</th>

                    <th>Name</th>

                    <th>Email</th>

                    <th>Phone</th>

                    <th>Status</th>

                    <th width="28%">Action</th>

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

                    </td>

                    <td>

                        <a href="{{ route('schools.show',$school->id) }}"
                           class="btn btn-info btn-sm">

                            <i class="bx bx-show"></i>

                        </a>

                        <a href="{{ route('schools.edit',$school->id) }}"
                           class="btn btn-warning btn-sm">

                            <i class="bx bx-edit"></i>

                        </a>

                        <form
                            action="{{ route('schools.status',$school->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('PATCH')

                            @if($school->status)

                                <button
                                    class="btn btn-secondary btn-sm">

                                    <i class="bx bx-block"></i>

                                </button>

                            @else

                                <button
                                    class="btn btn-success btn-sm">

                                    <i class="bx bx-check"></i>

                                </button>

                            @endif

                        </form>

                        <form
                            action="{{ route('schools.destroy',$school->id) }}"
                            method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Delete this school?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="btn btn-danger btn-sm">

                                <i class="bx bx-trash"></i>

                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-5">

                        <h5>

                            No Schools Found

                        </h5>

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $schools->links() }}

        </div>

    </div>

</div>

@endsection