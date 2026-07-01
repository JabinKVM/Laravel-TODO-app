@extends('layouts.master')

@section('content')

<div class="row mb-4">

    <div class="col-md-6">

        <h4 class="mb-0">
            High Priority Tasks
        </h4>

        <p class="text-muted">
            These tasks require immediate attention.
        </p>

    </div>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                <tr>

                    <th>SI No.</th>

                    <th>Task</th>

                    <th>Priority</th>

                    <th>Status</th>

                </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->title }}</td>

                        <td>

                            <span class="badge bg-danger">

                                High

                            </span>

                        </td>

                        <td>

                            @if($task->completed)

                                <span class="badge bg-success">

                                    Completed

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Pending

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">

                            No High Priority Tasks Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection