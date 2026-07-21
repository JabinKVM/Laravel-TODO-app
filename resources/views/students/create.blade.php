@extends('layouts.master')

@section('title', 'Register Student')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">

                        Register Student

                    </h4>

                </div>

            </div>

        </div>

        <!-- Validation Errors -->

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Success Message -->

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    Student Information

                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('school.students.store') }}"
                      method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Student Name

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name') }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email') }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Phone

                            </label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone') }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Password

                            </label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Confirm Password

                            </label>

                            <input type="password"
                                   name="password_confirmation"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Address

                            </label>

                            <textarea name="address"
                                      rows="4"
                                      class="form-control"
                                      required>{{ old('address') }}</textarea>

                        </div>

                    </div>

                    <div class="text-end">

                        <a href="{{ route('school.students.index') }}"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                        <button type="submit"
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