@extends('layouts.master')

@section('title','My Profile')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <h4 class="mb-0">

                My Profile

            </h4>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif


<div class="card overflow-hidden shadow-sm">

    <!-- Cover -->

    <div class="bg-primary bg-soft">

        <div style="height:170px;"></div>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- LEFT PANEL -->

            <div class="col-xl-3 col-lg-4">

                <div class="text-center">

                    <div class="position-relative d-inline-block">

                        <img

                            id="preview-image"

                            src="{{ Auth::user()->profile_photo
                                ? asset('storage/'.Auth::user()->profile_photo)
                                : asset('assets/images/users/avatar-1.jpg') }}"

                            class="rounded-circle img-thumbnail"

                            style="width:170px;
                                   height:170px;
                                   object-fit:cover;
                                   margin-top:-100px;">

                        <label

                            for="profile_photo"

                            class="btn btn-primary btn-sm rounded-circle"

                            style="position:absolute;
                                   bottom:10px;
                                   right:10px;">

                            <i class="bx bx-camera"></i>

                        </label>

                    </div>

                    <h3 class="mt-3">

                        {{ Auth::user()->name }}

                    </h3>

                    <p class="text-muted">

                        {{ ucfirst(Auth::user()->role) }}

                    </p>

                </div>

            </div>

            <!-- RIGHT PANEL -->

            <div class="col-xl-9 col-lg-8">

                <div class="card border">

                    <div class="card-header">

                        <h5 class="mb-0">

                            Personal Information

                        </h5>

                    </div>

                    <div class="card-body">

                        <form
                            action="{{ route('profile.update') }}"
                            method="POST">

                            @csrf

                            @method('PATCH')

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Name

                                    </label>

                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name',$user->name) }}">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label class="form-label">

                                        Email

                                    </label>

                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        value="{{ old('email',$user->email) }}">

                                </div>
                                                            </div>

                            <div class="mt-2">

                                <button
                                    type="submit"
                                    class="btn btn-success">

                                    <i class="bx bx-save"></i>

                                    Save Changes

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

                <!-- Upload Profile Picture -->

                <div class="card border mt-4">

                    <div class="card-header">

                        <h5 class="mb-0">

                            Profile Picture

                        </h5>

                    </div>

                    <div class="card-body">

                        <form
                            action="{{ route('profile.photo') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf

                            <input
                                type="file"
                                id="profile_photo"
                                name="profile_photo"
                                class="d-none"
                                onchange="previewImage(event)">

                            <p class="text-muted mb-3">

                                Click the camera icon on your profile picture to
                                choose a new image.

                            </p>

                            <button
                                type="submit"
                                class="btn btn-primary">

                                <i class="bx bx-upload"></i>

                                Upload New Picture

                            </button>

                        </form>

                    </div>

                </div>

                <!-- Statistics -->

                <div class="row mt-4">

                    <div class="col-md-3">

                        <div class="card mini-stats-wid shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <p class="text-muted">

                                            Total Tasks

                                        </p>

                                        <h3>

                                            {{ $totaltasks }}

                                        </h3>

                                    </div>

                                    <div>

                                        <i class="bx bx-task display-6 text-primary"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card mini-stats-wid shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <p class="text-muted">

                                            Completed

                                        </p>

                                        <h3 class="text-success">

                                            {{ $completedTasks }}

                                        </h3>

                                    </div>

                                    <div>

                                        <i class="bx bx-check-circle display-6 text-success"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card mini-stats-wid shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <p class="text-muted">

                                            Pending

                                        </p>

                                        <h3 class="text-warning">

                                            {{ $pendingTasks }}

                                        </h3>

                                    </div>

                                    <div>

                                        <i class="bx bx-time-five display-6 text-warning"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="card mini-stats-wid shadow-sm">

                            <div class="card-body">

                                <div class="d-flex justify-content-between">

                                    <div>

                                        <p class="text-muted">

                                            High Priority

                                        </p>

                                        <h3 class="text-danger">

                                            {{ $highPriorityTasks }}

                                        </h3>

                                    </div>

                                    <div>

                                        <i class="bx bx-error-circle display-6 text-danger"></i>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- Account Information -->

<div class="card mt-4">

    <div class="card-header bg-light">

        <h5 class="mb-0">

            Account Information

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-3">

                <label class="text-muted">

                    Role

                </label>

                <h6>

                    {{ ucfirst($user->role) }}

                </h6>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Member Since

                </label>

                <h6>

                    {{ $user->created_at->format('d M Y') }}

                </h6>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Account Status

                </label>

                <br>

                <span class="badge bg-success">

                    Active

                </span>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Last Updated

                </label>

                <h6>

                    {{ $user->updated_at->format('d M Y') }}

                </h6>

            </div>

        </div>

        <hr>

        @if($user->role=='school' && $school)

        <div class="row">

            <div class="col-md-4">

                <label class="text-muted">

                    School Name

                </label>

                <h6>

                    {{ $school->name }}

                </h6>

            </div>

            <div class="col-md-4">

                <label class="text-muted">

                    Phone

                </label>

                <h6>

                    {{ $school->phone }}

                </h6>

            </div>

            <div class="col-md-4">

                <label class="text-muted">

                    Address

                </label>

                <h6>

                    {{ $school->address }}

                </h6>

            </div>

        </div>

        @endif


        @if($user->role=='student' && $student)

        <div class="row">

            <div class="col-md-3">

                <label class="text-muted">

                    Student ID

                </label>

                <h6>

                    {{ $student->student_id }}

                </h6>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Class

                </label>

                <h6>

                    {{ $student->class }}

                </h6>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Phone

                </label>

                <h6>

                    {{ $student->phone }}

                </h6>

            </div>

            <div class="col-md-3">

                <label class="text-muted">

                    Status

                </label>

                <br>

                @if($student->status)

                    <span class="badge bg-success">

                        Active

                    </span>

                @else

                    <span class="badge bg-danger">

                        Inactive

                    </span>

                @endif

            </div>

        </div>

        @endif

    </div>

</div>



<!-- Change Password -->

<div class="card mt-4">

    <div class="card-header bg-light">

        <h5 class="mb-0">

            Change Password

        </h5>

    </div>

    <div class="card-body">

        <form
            action="{{ route('profile.password') }}"
            method="POST">

            @csrf

            @method('PATCH')

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Current Password

                    </label>

                    <input
                        type="password"
                        name="current_password"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        New Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Confirm Password

                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control"
                        required>

                </div>

            </div>

            <button
                type="submit"
                class="btn btn-warning">

                <i class="bx bx-lock-alt"></i>

                Change Password

            </button>

        </form>

    </div>

</div>
@push('scripts')

<script>

function previewImage(event)
{
    const preview = document.getElementById('preview-image');

    preview.src = URL.createObjectURL(event.target.files[0]);
}

document.addEventListener("DOMContentLoaded", function () {

    const avatar = document.getElementById("preview-image");
    const fileInput = document.getElementById("profile_photo");

    if (avatar && fileInput) {

        avatar.style.cursor = "pointer";

        avatar.addEventListener("click", function () {

            fileInput.click();

        });

    }

});

</script>

@endpush

@endsection