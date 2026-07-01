@extends('layouts.master')

@section('title','User Profile')

@section('content')

<div class="row">

<div class="col-12">

<div class="page-title-box d-sm-flex align-items-center justify-content-between">

<h4 class="mb-sm-0">

User Profile

</h4>

<div class="page-title-right">

<ol class="breadcrumb m-0">

<li class="breadcrumb-item">

<a href="{{ route('admin.dashboard') }}">

Admin

</a>

</li>

<li class="breadcrumb-item">

<a href="{{ route('admin.users') }}">

Users

</a>

</li>

<li class="breadcrumb-item active">

{{ $user->name }}

</li>

</ol>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-xl-4">

<div class="card">

<div class="card-body text-center">
    @if($user->profile_photo)

<img
src="{{ asset('storage/'.$user->profile_photo) }}"
class="rounded-circle img-thumbnail"
style="width:150px;height:150px;object-fit:cover;">

@else

<img
src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
class="rounded-circle img-thumbnail"
style="width:150px;height:150px;object-fit:cover;">

@endif

<h4 class="mt-4">

{{ $user->name }}

</h4>

<p class="text-muted">

{{ $user->email }}

</p>

<hr>

<div class="text-start">

<p>

<strong>Role :</strong>

{{ ucfirst($user->role) }}

</p>

<p>

<strong>Status :</strong>

{{ ucfirst($user->status) }}

</p>

<p>

<strong>Joined :</strong>

{{ $user->created_at->format('d M Y') }}

</p>

</div>

</div>

</div>

</div>
<div class="col-xl-8">

<div class="card">

<div class="card-header">

<h4>

Task Statistics

</h4>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-3">

<div class="card border">

<div class="card-body text-center">

<h2>

{{ $totalTasks }}

</h2>

<p>Total</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card border">

<div class="card-body text-center">

<h2>

{{ $completedTasks }}

</h2>

<p>Completed</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card border">

<div class="card-body text-center">

<h2>

{{ $pendingTasks }}

</h2>

<p>Pending</p>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card border">

<div class="card-body text-center">

<h2>

{{ $highPriorityTasks }}

</h2>

<p>High Priority</p>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection