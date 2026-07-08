@extends('layouts.master')

@section('title','Edit Student')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                Edit Student

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

                        Edit Student

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

<div class="card">

    <div class="card-body">

        <form action="{{ route('school.students.update',$student->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Student ID

                    </label>

                    <input type="text"
                           name="student_id"
                           class="form-control"
                           value="{{ old('student_id',$student->student_id) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Student Name

                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name',$student->name) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email',$student->email) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Phone

                    </label>

                    <input type="text"
                           name="phone"
                           class="form-control"
                           value="{{ old('phone',$student->phone) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Date of Birth

                    </label>

                    <input type="date"
                           name="dob"
                           class="form-control"
                           value="{{ old('dob',$student->dob) }}"
                           required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Gender

                    </label>

                    <select name="gender"
                            class="form-select"
                            required>

                        <option value="Male" {{ $student->gender=='Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female" {{ $student->gender=='Female' ? 'selected' : '' }}>
                            Female
                        </option>

                        <option value="Other" {{ $student->gender=='Other' ? 'selected' : '' }}>
                            Other
                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-4">

                    <label class="form-label">

                        Department

                    </label>

                    <input type="text"
                           name="department"
                           class="form-control"
                           value="{{ old('department',$student->department) }}"
                           required>

                </div>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('school.students') }}"
                   class="btn btn-light border">

                    Back

                </a>

                <button type="submit"
                        class="btn btn-primary">

                    Update Student

                </button>

            </div>

        </form>

    </div>

</div>

@endsection