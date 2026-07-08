@extends('layouts.master')

@section('title','Register School')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0">

                Register School

            </h4>

            <a href="{{ route('schools.index') }}"
               class="btn btn-secondary">

                Back

            </a>

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

<div class="card-header">

<h4 class="card-title">

School Details

</h4>

</div>

<div class="card-body">

<form action="{{ route('schools.store') }}"
      method="POST">

@csrf


<div class="mb-3">

<label class="form-label">

School Name

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

Email Address

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

Phone Number

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

Address

</label>

<textarea
name="address"
rows="4"
class="form-control"
required>{{ old('address') }}</textarea>

</div>


<div class="row">

<div class="col-md-6">

<div class="mb-3">

<label class="form-label">

Password

</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

</div>


<div class="col-md-6">

<div class="mb-3">

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

</div>


<div class="text-end">

<button
type="submit"
class="btn btn-primary">

<i class="bx bx-save"></i>

Register School

</button>

</div>

</form>

</div>

</div>

</div>



<div class="col-lg-4">

<div class="card">

<div class="card-header">

<h4>

Information

</h4>

</div>

<div class="card-body">

<ul>

<li>

A login account will be created automatically.

</li>

<li>

Role will be assigned as <strong>School</strong>.

</li>

<li>

Status will be <strong>Active</strong>.

</li>

<li>

The school can log in using the registered email and password.

</li>

</ul>

</div>

</div>

</div>

</div>

@endsection