@extends('layouts.master')

@section('title','User Management')

@section('content')

<!-- start page title -->

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                User Management

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('admin.dashboard') }}">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Users

                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>

<!-- end page title -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show">

    {{ session('error') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <h4 class="card-title">

                    Table Edit

                </h4>

                <p class="card-title-desc">

                    Manage registered users.

                </p>

                <div class="table-responsive">

                    <table class="table table-editable table-nowrap align-middle table-edits">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Role</th>

                                <th>Status</th>

                                <th>Edit</th>

                            </tr>

                        </thead>

                        <tbody>

@forelse($users as $user)

<tr data-id="{{ $user->id }}">

    <td data-field="id" style="width:80px">

        {{ $loop->iteration }}

    </td>

    <td data-field="name">

        {{ $user->name }}

    </td>

    <td data-field="email">

        {{ $user->email }}

    </td>

    <td data-field="role">

        {{ ucfirst($user->role) }}

    </td>

    <td data-field="status">

        {{ ucfirst($user->status) }}

    </td>

    <td style="width:100px">

        <a href="{{ route('admin.show',$user->id) }}"
           class="btn btn-outline-secondary btn-sm edit"
           title="View">

            <i class="fas fa-pencil-alt"></i>

        </a>

    </td>

</tr>
@empty

<tr>

    <td colspan="6" class="text-center py-5">

        No Users Found

    </td>

</tr>

@endforelse

                        </tbody>

                    </table>

                </div>

                <div class="mt-4">

                    {{ $users->links() }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection