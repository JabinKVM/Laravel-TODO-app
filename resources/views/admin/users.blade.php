@extends('layouts.master')

@section('title', 'User Management')

@section('content')

<!-- Page Title -->
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

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">

    {{ session('error') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>
@endif

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="userTable"
                           class="table table-editable table-nowrap align-middle table-edits datatable">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Role</th>

                                <th>Status</th>

                                <th>Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    {{ $user->name }}

                                </td>

                                <td>

                                    {{ $user->email }}

                                </td>

                                <td>

                                    {{ ucfirst($user->role) }}

                                </td>

                                <td class="user-status">

                                    {{ ucfirst($user->status) }}

                                </td>

                                <td class="text-center">

                                    <!-- View -->

                                    <a href="{{ route('admin.show', $user->id) }}"
                                       class="btn btn-outline-secondary btn-sm"
                                       title="View Profile">

                                        <i class="fas fa-eye text-dark"></i>

                                    </a>

                                    @if(strtolower($user->role) != 'admin')

                                        <span class="block-container">

                                            @if($user->status == 'Active')

                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary btn-sm block-user"
                                                    data-id="{{ $user->id }}"
                                                    title="Block User">

                                                    <i class="fas fa-ban text-dark"></i>

                                                </button>

                                            @else

                                                <button
                                                    type="button"
                                                    class="btn btn-outline-secondary btn-sm unblock-user"
                                                    data-id="{{ $user->id }}"
                                                    title="Unblock User">

                                                    <i class="fas fa-lock text-dark"></i>

                                                </button>

                                            @endif

                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <i class="bx bx-user display-4 text-muted"></i>

                                    <h5 class="mt-3">

                                        No Users Found

                                    </h5>

                                </td>

                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =========================
     Confirmation Modal
========================= -->

<div class="modal fade"
     id="userActionModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Confirm Action

                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p id="userActionMessage"></p>

                <input type="hidden" id="selectedUserId">

                <input type="hidden" id="selectedAction">

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-light"
                        data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button"
                        class="btn btn-primary"
                        id="confirmUserAction">

                    Confirm

                </button>

            </div>

        </div>

    </div>

</div>

@endsection