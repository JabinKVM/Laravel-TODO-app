@extends('layouts.master')

@section('title','My Tasks')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-1">

                    My Tasks

                </h4>

                <p class="text-muted mb-0">

                    View and manage your assigned tasks.

                </p>

            </div>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Title</th>

                        <th>Description</th>

                        <th>Priority</th>

                        <th>Due Date</th>

                        <th>Status</th>

                        <th width="220">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $task->title }}</td>

                    <td>{{ Str::limit($task->description,40) }}</td>

                    <td>

                        @if($task->priority=='High')

                            <span class="badge bg-danger">

                                High

                            </span>

                        @elseif($task->priority=='Medium')

                            <span class="badge bg-warning">

                                Medium

                            </span>

                        @else

                            <span class="badge bg-success">

                                Low

                            </span>

                        @endif

                    </td>

                    <td>

                        {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}

                    </td>

                    <td>

                        @if($task->completed)

                            <span class="badge bg-success">

                                Completed

                            </span>

                        @else

                            <span class="badge bg-danger">

                                Pending

                            </span>

                        @endif

                    </td>

                    <td>                        <a href="{{ route('student.tasks.show', $task->id) }}"
                           class="btn btn-info btn-sm">

                            <i class="bx bx-show"></i>

                            View

                        </a>

                        @if(!$task->completed)

                            <form action="{{ route('student.tasks.complete', $task->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('PATCH')

                                <button class="btn btn-success btn-sm">

                                    <i class="bx bx-check"></i>

                                    Complete

                                </button>

                            </form>

                        @else

                            <form action="{{ route('student.tasks.pending', $task->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('PATCH')

                                <button class="btn btn-warning btn-sm">

                                    <i class="bx bx-reset"></i>

                                    Pending

                                </button>

                            </form>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7" class="text-center">

                        No Tasks Assigned.

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">

            {{ $tasks->links() }}

        </div>

    </div>

</div>

@endsection