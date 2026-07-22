@extends('layouts.master')

@section('title', 'My Profile')

@section('content')

<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">My Profile</h4>

                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route(auth()->user()->role.'.dashboard') }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active">
                            Profile
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- Profile Card -->
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body text-center">

                        @if($user->profile_photo)
                            <img src="{{ asset('storage/'.$user->profile_photo) }}"
                                 class="rounded-circle avatar-xl img-thumbnail"
                                 alt="Profile">
                        @else
                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}"
                                 class="rounded-circle avatar-xl img-thumbnail"
                                 alt="Profile">
                        @endif

                        <h4 class="mt-3 mb-1">
                            {{ $user->name }}
                        </h4>

                        <p class="text-muted">
                            {{ ucfirst($user->role) }}
                        </p>

                        @if($user->status)
                            <span class="badge bg-success">
                                Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Blocked
                            </span>
                        @endif

                    </div>
                </div>

            </div>

            <!-- Profile Details -->
            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            Profile Information
                        </h4>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tr>
                                <th width="220">Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>

                            <tr>
                                <th>Role</th>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    {{ $user->status ? 'Active' : 'Blocked' }}
                                </td>
                            </tr>

                            <tr>
                                <th>Member Since</th>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                            </tr>

                        </table>

                        <div class="mt-4">

                            <a href="{{ route(auth()->user()->role.'.profile.edit') }}"
                               class="btn btn-primary">

                                <i class="bx bx-edit"></i>
                                Edit Profile

                            </a>

                            <a href="{{ route(auth()->user()->role.'.profile.password') }}"
                               class="btn btn-warning">

                                
                                Change Password

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection