@extends('layouts.master')

@section('title','Register Student')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                Register Student

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('school.dashboard') }}">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="{{ route('school.students') }}">

                            Students

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Register Student

                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-body">

                <form action="{{ route('school.students.store') }}" method="POST">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">

                            Student ID

                        </label>

                        <input
                            type="text"
                            name="student_id"
                            class="form-control"
                            value="{{ old('student_id') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Student Name

                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            value="{{ old('name') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="{{ old('email') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Phone

                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control"
                            value="{{ old('phone') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Date of Birth

                        </label>

                        <input
                            type="date"
                            name="dob"
                            class="form-control"
                            value="{{ old('dob') }}"
                            required>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Gender

                        </label>

                        <select
                            name="gender"
                            class="form-select"
                            required>

                            <option value="">Select Gender</option>

                            <option value="Male">Male</option>

                            <option value="Female">Female</option>

                            <option value="Other">Other</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Department

                        </label>

                        <input
                            type="text"
                            name="department"
                            class="form-control"
                            value="{{ old('department') }}"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Password

                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control"
                            required>

                    </div>
                    <div class="mb-4">

    <label class="form-label">

        Confirm Password

    </label>

    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        required>

</div>

                    <div class="d-flex justify-content-between">

                        <a href="{{ route('school.students') }}"
                           class="btn btn-light border">

                            Back

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

</div>

@endsection