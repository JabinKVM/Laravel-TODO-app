@extends('layouts.master')

@section('title','School Details')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0">

                School Details

            </h4>

            <a href="{{ route('schools.index') }}"
               class="btn btn-secondary">

                Back

            </a>

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

<div class="row">

    <div class="col-lg-4">

        <div class="card">

            <div class="card-body text-center">

                <img
                    src="{{ $school->user && $school->user->profile_photo
                        ? asset('storage/'.$school->user->profile_photo)
                        : asset('assets/images/users/avatar-1.jpg') }}"
                    class="rounded-circle img-thumbnail"
                    style="width:140px;height:140px;object-fit:cover;">

                <h4 class="mt-4">

                    {{ $school->name }}

                </h4>

                <p class="text-muted">

                    {{ $school->email }}

                </p>

                @if($school->status)

                    <span class="badge bg-success">

                        Active

                    </span>

                @else

                    <span class="badge bg-danger">

                        Blocked

                    </span>

                @endif

            </div>

        </div>

    </div>

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    School Information

                </h4>

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>

                        <th width="220">

                            School Name

                        </th>

                        <td>

                            {{ $school->name }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Email

                        </th>

                        <td>

                            {{ $school->email }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Phone

                        </th>

                        <td>

                            {{ $school->phone }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Address

                        </th>

                        <td>

                            {{ $school->address }}

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Login Role

                        </th>

                        <td>

                            School

                        </td>

                    </tr>

                    <tr>

                        <th>

                            Status

                        </th>

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

                    <tr>

                        <th>

                            Registered On

                        </th>

                        <td>

                            {{ $school->created_at->format('d M Y h:i A') }}

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h4>

                    Actions

                </h4>

            </div>

            <div class="card-body">

                <a href="{{ route('schools.edit',$school->id) }}"
                   class="btn btn-warning">

                    <i class="bx bx-edit"></i>

                    Edit

                </a>

                <form
                    action="{{ route('schools.status',$school->id) }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    @method('PATCH')

                    @if($school->status)

                        <button
                            class="btn btn-secondary">

                            <i class="bx bx-block"></i>

                            Block

                        </button>

                    @else

                        <button
                            class="btn btn-success">

                            <i class="bx bx-check-circle"></i>

                            Unblock

                        </button>

                    @endif

                </form>

                <form
                    action="{{ route('schools.destroy',$school->id) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Delete this school permanently?')">

                    @csrf

                    @method('DELETE')

                    <button
                        class="btn btn-danger">

                        <i class="bx bx-trash"></i>

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection