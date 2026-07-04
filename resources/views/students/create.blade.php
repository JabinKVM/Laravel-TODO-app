@extends('layouts.master')

@section('title')
Register Student
@endsection

@section('content')

<div class="container-fluid">

    <!-- Page Title -->
    <div class="row">
        <div class="col-12">

            <div class="page-title-box d-flex align-items-center justify-content-between">

                <h4 class="mb-0">
                    Register Student
                </h4>

                <div class="page-title-right">

                    <a href="{{ route('students.index') }}"
                       class="btn btn-secondary">

                        <i class="bx bx-arrow-back me-1"></i>

                        Back

                    </a>

                </div>

            </div>

        </div>
    </div>

    <!-- Registration Form -->

    <div class="card">

        <div class="card-body">

            <form action="{{ route('students.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <!-- Student ID -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Student ID
                        </label>

                        <input
                            type="text"
                            name="student_id"
                            class="form-control @error('student_id') is-invalid @enderror"
                            value="{{ old('student_id') }}">

                        @error('student_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Name -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name') }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Email -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}">

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Phone -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Phone
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control @error('phone') is-invalid @enderror"
                            value="{{ old('phone') }}">

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Date of Birth -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Date of Birth
                        </label>

                        <input
                            type="date"
                            name="dob"
                            class="form-control @error('dob') is-invalid @enderror"
                            value="{{ old('dob') }}">

                        @error('dob')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Gender -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Gender
                        </label>

                        <select
                            name="gender"
                            class="form-select @error('gender') is-invalid @enderror">

                            <option value="">Select Gender</option>

                            <option value="Male">Male</option>

                            <option value="Female">Female</option>

                            <option value="Other">Other</option>

                        </select>

                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Department -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Department
                        </label>

                        <input
                            type="text"
                            name="department"
                            class="form-control @error('department') is-invalid @enderror"
                            value="{{ old('department') }}">

                        @error('department')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Status -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select">

                            <option value="Active">Active</option>

                            <option value="Inactive">Inactive</option>

                        </select>

                    </div>

                    <!-- Profile Photo -->

                    <div class="col-md-12 mb-4">

                        <label class="form-label">
                            Profile Photo
                        </label>

                        <input
                            type="file"
                            name="profile_photo"
                            class="form-control">

                    </div>

                </div>

                <div class="text-end">

                    <a href="{{ route('students.index') }}"
                       class="btn btn-secondary">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Register Student

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection