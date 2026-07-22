
@extends('layouts.master')

@section('title','Edit Profile')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="card">

                <div class="card-header">

                    <h4 class="card-title">
                        Edit Profile
                    </h4>

                </div>

                <div class="card-body">

                    @if(session('success'))

                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>

                    @endif

                    <form method="POST"
                          action="{{ route(auth()->user()->role.'.profile.update') }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">

                            @if($user->profile_photo)

                                <img
                                    src="{{ asset('storage/'.$user->profile_photo) }}"
                                    class="rounded-circle"
                                    width="130"
                                    height="130">

                            @else

                                <img
                                    src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                    class="rounded-circle"
                                    width="130"
                                    height="130">

                            @endif

                        </div>

                        <div class="mb-3">

                            <label>Name</label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$user->name) }}">

                            @error('name')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$user->email) }}">

                            @error('email')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        <div class="mb-4">

                            <label>Profile Photo</label>

                            <input
                                type="file"
                                name="profile_photo"
                                class="form-control">

                            @error('profile_photo')

                                <small class="text-danger">
                                    {{ $message }}
                                </small>

                            @enderror

                        </div>

                        <button class="btn btn-primary">

                            Update Profile

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