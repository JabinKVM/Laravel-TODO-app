@extends('layouts.dashboard')

@section('content')

<h2></h2>

<div class="row">

    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5>Total Tasks</h5>
                <h2>{{ $totalTasks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5>Completed</h5>
                <h2>{{ $completedTasks }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h5>Pending</h5>
                <h2>{{ $pendingTasks }}</h2>
            </div>
        </div>
    </div>

    

</div>

@endsection