@extends('layouts.master')

@section('title','Edit School')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0">

                Edit School

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

<h4>

Update School Details

</h4>

</div>

<div class="card-body">

<form action="{{ route('schools.update',$school->id) }}"
      method="POST">

@csrf

@method('PUT')

<div class="mb-3">

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

<div class="mb-3">

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

<div class="mb-3">

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

<div class="mb-3">

<label class="form-label">

Address

</label>

<textarea
name="address"
rows="4"
class="form-control"
required>{{ old('address',$school->address) }}</textarea>

</div>

<div class="text-end">

<button
type="submit"
class="btn btn-primary">

<i class="bx bx-save"></i>

Update School

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

Account Information

</h4>

</div>

<div class="card-body">

<table class="table table-borderless">

<tr>

<th>Role</th>

<td>School</td>

</tr>

<tr>

<th>Status</th>

<td>

@if($school->status)

<span class="badge bg-success">

Active

</span>

@else

<span class="badge bg-danger">

Blocked

</span>

@endif

</td>

</tr>

<tr>

<th>Login Email</th>

<td>

{{ $school->email }}

</td>

</tr>

<tr>

<th>Password</th>

<td>

Not Changed

</td>

</tr>

</table>

<hr>

<div class="alert alert-info mb-0">

Updating the email here will also update the school's login email.

</div>

</div>

</div>

</div>

</div>

@endsection