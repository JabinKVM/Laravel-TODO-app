@extends('layouts.master')

@section('title','Change Password')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">
                        Change Password
                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">

                            {{ session('success') }}

                        </div>

                    @endif

                    <form method="POST"
                          action="{{ route(auth()->user()->role.'.profile.password.update') }}">

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

                            @error('current_password')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                New Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control">

                            @error('password')

                                <small class="text-danger">

                                    {{ $message }}

                                </small>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control">

                        </div>

                        <button type="submit"
                                class="btn btn-primary">

                            Update Password

                        </button>

                        <a href="{{ route(auth()->user()->role.'.profile.index') }}"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection