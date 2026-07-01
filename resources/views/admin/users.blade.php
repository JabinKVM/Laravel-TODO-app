@extends('layouts.master')

@section('title','User Management')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">User Management</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                    
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

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session('error') }}
    <button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="card">

    <div class="card-header">

        <h4 class="card-title mb-0">

            Registered Users

        </h4>

    </div>

    <div class="card-body">

        <form method="GET"
              action="{{ route('admin.users') }}"
              class="row g-3 mb-4">

            <div class="col-md-6">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search by name or email">

                    <button
                        class="btn btn-primary">

                        <i class="bx bx-search"></i>

                    </button>

                    @if(request('search'))

                    <a href="{{ route('admin.users') }}"
                       class="btn btn-secondary">

                        Clear

                    </a>

                    @endif

                </div>

            </div>

        </form>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Photo</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Status</th>

                        <th>Joined</th>

                        <th width="220">

                            Actions

                        </th>

                    </tr>

                </thead>

                <tbody>

@forelse($users as $user)

<tr>
        <td>

        @if($user->profile_photo)

            <img
                src="{{ asset('storage/' . $user->profile_photo) }}"
                class="rounded-circle avatar-md"
                style="width:50px;height:50px;object-fit:cover;">

        @else

            <img
                src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=556ee6&color=fff"
                class="rounded-circle avatar-md"
                style="width:50px;height:50px;object-fit:cover;">

        @endif

    </td>

    <td>

        <strong>{{ $user->name }}</strong>

    </td>

    <td>

        {{ $user->email }}

    </td>

    <td>

        @if($user->role == 'admin')

            <span class="badge bg-primary">
                Admin
            </span>

        @else

            <span class="badge bg-secondary">
                User
            </span>

        @endif

    </td>

    <td>

        @if($user->status == 'active')

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

        {{ $user->created_at->format('d M Y') }}

    </td>

    <td>

        <!-- View -->

        <a
            href="{{ route('admin.show', $user->id) }}"
            class="btn btn-info btn-sm">

            <i class="bx bx-show"></i>

        </a>

        @if($user->role != 'admin')

            <!-- Block / Unblock -->

            @if($user->status == 'active')

            <button
                type="button"
                class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#blockUser{{ $user->id }}">

                <i class="bx bx-block"></i>

            </button>  

            @else

                <button
    type="button"
    class="btn btn-success btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#activateUser{{ $user->id }}">

    <i class="bx bx-check-circle"></i>

</button>

            @endif

            <!-- Delete -->

            <button
                type="button"
                class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#deleteUser{{ $user->id }}">

                <i class="bx bx-trash"></i>

            </button>

        @endif

    </td>

</tr>
<!-- Delete User Modal -->

@if($user->role != 'admin')

<div class="modal fade"
     id="deleteUser{{ $user->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger">

                <h5 class="modal-title text-white">

                    Delete User

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bx bx-error-circle text-danger"
                   style="font-size:60px;"></i>

                <h4 class="mt-3">

                    Are you sure?

                </h4>

                <p class="text-muted">

                    You are about to permanently delete

                    <br><br>

                    <strong>{{ $user->name }}</strong>

                    <br><br>

                    This action cannot be undone.

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <form
                    action="{{ route('admin.delete', $user->id) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Delete

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endif
@if($user->role != 'admin')

<div class="modal fade"
     id="blockUser{{ $user->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-warning">

                <h5 class="modal-title text-dark">

                    Block User

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bx bx-block text-warning"
                   style="font-size:60px;"></i>

                <h4 class="mt-3">

                    Block this user?

                </h4>

                <p class="text-muted">

                    Are you sure you want to block

                    <strong>{{ $user->name }}</strong>?

                    <br><br>

                    The user will not be able to log in until unblocked.

                </p>

            </div>

            <div class="modal-footer">

                <button
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <form
                    action="{{ route('admin.block', $user->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn btn-warning">

                        Yes, Block User

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endif
@if($user->role != 'admin')

<div class="modal fade"
     id="activateUser{{ $user->id }}"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-success">

                <h5 class="modal-title text-white">

                    Activate User

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bx bx-check-circle text-success"
                   style="font-size:60px;"></i>

                <h4 class="mt-3">

                    Activate this user?

                </h4>

                <p class="text-muted">

                    Are you sure you want to activate

                    <strong>{{ $user->name }}</strong>?

                    <br><br>

                    The user will be able to log in and use TodoPro again.

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <form
                    action="{{ route('admin.unblock', $user->id) }}"
                    method="POST">

                    @csrf
                    @method('PATCH')

                    <button
                        type="submit"
                        class="btn btn-success">

                        Yes, Activate User

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endif
@empty

<tr>

    <td colspan="7" class="text-center py-5">

        <i class="bx bx-user-x display-4 text-muted"></i>

        <h5 class="mt-3">

            No Users Found

        </h5>

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

@endsection