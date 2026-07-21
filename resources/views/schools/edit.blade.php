@extends('layouts.master')

@section('title', 'Edit School')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">

                        Edit School

                    </h4>

                    <a href="{{ route('admin.schools.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

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

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    School Information

                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('admin.schools.update',$school->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                School Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$school->name) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email',$school->email) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Phone

                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="{{ old('phone',$school->phone) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="{{ $school->status ? 'Active' : 'Blocked' }}"
                                readonly>

                        </div>

                        <div class="col-12 mb-3">

                            <label class="form-label">

                                Address

                            </label>

                            <textarea
                                name="address"
                                rows="5"
                                class="form-control"
                                required>{{ old('address',$school->address) }}</textarea>

                        </div>

                    </div>

                    <div class="text-end">

                        <a href="{{ route('admin.schools.index') }}"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            Update School

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection