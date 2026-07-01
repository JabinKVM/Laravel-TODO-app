@extends('layouts.master')

@section('title', 'My Profile')

@section('content')

<!-- Page Title -->

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                My Profile

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                    </li>

                    

                </ol>

            </div>

        </div>

    </div>

</div>

            <!-- End Page Title -->



            <div class="row">

                <!-- Left Profile Card -->

                <div class="col-xl-4">

                    <div class="card overflow-hidden">

                        <div class="bg-primary bg-soft">

                            <div class="row">

                                <div class="col-7">

                                    <div class="text-primary p-3">

                                        <h5 class="text-primary">

                                            Welcome Back!

                                        </h5>

                                        <p>

                                            TodoPro Profile

                                        </p>

                                    </div>

                                </div>

                                <div class="col-5 align-self-end">

                                    <img src="{{ asset('assets/images/profile-img.png') }}"

                                         class="img-fluid">

                                </div>

                            </div>

                        </div>



                        <div class="card-body pt-0">

                            <div class="text-center">

                                <div class="text-center mt-4">

    @if($user->profile_photo)

        <img
            src="{{ asset('storage/'.$user->profile_photo) }}"
            alt="Profile Photo"
            class="rounded-circle avatar-xl img-thumbnail"
            style="width:140px;height:140px;object-fit:cover;">

    @else

        <img
            src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=300&background=556ee6&color=fff"
            alt="Profile Photo"
            class="rounded-circle avatar-xl img-thumbnail"
            style="width:140px;height:140px;object-fit:cover;">

    @endif

       </div>

            <div class="text-center mt-3">

                <h4 class="mb-1">{{ $user->name }}</h4>

                <p class="text-muted mb-0">{{ $user->email }}</p>

            </div>

                                

         </div>

                           
                            <!-- User Statistics -->

<div class="table-responsive">

    <table class="table table-borderless mb-0">

        <tbody>

            <tr>

                <th scope="row">

                    Member Since

                </th>

                <td>

                    {{ $user->created_at->format('d M Y') }}

                </td>

            </tr>

            

           

            

                

        </tbody>

    </table>

</div>

<hr>


</div>

</div>

</div>

<!-- Right Side -->

<div class="col-xl-8">

    <div class="card">

        <div class="card-header">

            <h4 class="card-title">

                <i class="bx bx-user me-2"></i>

                Profile Information

            </h4>

        </div>

        <div class="card-body">

            <form method="POST"

                  action="{{ route('profile.update') }}"

                  enctype="multipart/form-data">

                @csrf

                @method('PATCH')

                <div class="row">

                    <!-- Name -->

                    <div class="col-md-6">

                        <div class="mb-3">

                            <label class="form-label">

                                Full Name

                            </label>

                            <input

                                type="text"

                                class="form-control"

                                name="name"

                                value="{{ old('name',$user->name) }}"

                                required>

                        </div>

                    </div>

                    <!-- Email -->

                    <div class="col-md-6">
    <div class="mb-3">

        <label class="form-label">
            Email Address
        </label>

        <input
            type="email"
            class="form-control"
            name="email"
            value="{{ old('email', $user->email) }}"
            required>

        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>
</div>

                    
                                        <!-- Profile Photo -->

                    <div class="col-md-12">

                        <div class="mb-3">

                            <label class="form-label">

                                Profile Photo

                            </label>

                            <input
                                id="profile_photo"
                                type="file"
                                name="profile_photo"
                                class="form-control"
                                accept="image/*">

                        </div>

                    </div>

                    <!-- Save Button -->

                    <div class="col-md-12">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bx bx-save me-1"></i>

                            Save Changes

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>



    <!-- Change Password -->

    <div class="card">

        <div class="card-header">

            <h4 class="card-title">

                <i class="bx bx-lock me-2"></i>

                Change Password

            </h4>

        </div>

        <div class="card-body">

            <form method="POST"
                  action="{{ route('password.update') }}">

                @csrf

                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">

                        Current Password

                    </label>

                    <input
                        type="password"
                        name="current_password"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        New Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">

                        Confirm Password

                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control">

                </div>

                <button
                    class="btn btn-success">

                    <i class="bx bx-check-circle me-1"></i>

                    Update Password

                </button>

            </form>

        </div>

    </div>



    <!-- Danger Zone -->

    <div class="card border border-danger">

        <div class="card-header bg-danger text-white">

            <h4 class="card-title text-white mb-0">

                <i class="bx bx-trash me-2"></i>

                Danger Zone

            </h4>

        </div>

        <div class="card-body">

            <p class="text-muted">

                Permanently delete your TodoPro account.

                This action cannot be undone.

            </p>

            <button
    type="button"
    class="btn btn-danger waves-effect waves-light"
    data-bs-toggle="modal"
    data-bs-target="#deleteAccountModal">

    <i class="bx bx-trash me-1"></i>

    Delete Account

</button>

        </div>

    </div>

</div>
<!-- Delete Account Modal -->

<div class="modal fade"
     id="deleteAccountModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title">

                    <i class="bx bx-error-circle me-2"></i>

                    Delete Account

                </h5>

                <button
                    type="button"
                    class="btn-close btn-close-white"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bx bx-trash text-danger"
                   style="font-size:60px;"></i>

                <h4 class="mt-3">
                    Are you sure?
                </h4>

                <p class="text-muted">

                    This will permanently delete your account.

                    <br>

                    All your tasks and profile information will be removed permanently.

                    <br><br>

                    <strong>This action cannot be undone.</strong>

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <form method="POST"
      action="{{ route('profile.destroy') }}">

    @csrf
    @method('DELETE')

    <div class="mb-3">

        <label class="form-label">

            Confirm Password

        </label>

        <input
            type="password"
            name="password"
            class="form-control"
            placeholder="Enter your password"
            required>

    </div>

    <button
        type="submit"
        class="btn btn-danger">

        <i class="bx bx-trash me-1"></i>

        Continue Delete

    </button>

</form>

            </div>

        </div>

    </div>

</div>
@endsection