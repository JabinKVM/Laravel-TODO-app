@extends('layouts.master')

@section('title', 'Task Details')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">

                        Task Details

                    </h4>

                    <div>

                        <a href="{{ url()->previous() }}"
                           class="btn btn-secondary">

                            <i class="fas fa-arrow-left"></i>

                            Back

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">

                            Task Information

                        </h4>

                    </div>

                    <div class="card-body">

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Student</strong>

                            </div>

                            <div class="col-md-8">

                                {{ $task->student->name }}

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Student ID</strong>

                            </div>

                            <div class="col-md-8">

                                {{ $task->student->student_id }}

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Task Title</strong>

                            </div>

                            <div class="col-md-8">

                                {{ $task->title }}

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Description</strong>

                            </div>

                            <div class="col-md-8">

                                {!! nl2br(e($task->description)) !!}

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Priority</strong>

                            </div>

                            <div class="col-md-8">

                                @if($task->priority == 'High')

                                    <span class="badge bg-danger">

                                        High

                                    </span>

                                @elseif($task->priority == 'Medium')

                                    <span class="badge bg-warning">

                                        Medium

                                    </span>

                                @else

                                    <span class="badge bg-success">

                                        Low

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Status</strong>

                            </div>

                            <div class="col-md-8">

                                @if($task->status == 'Completed')

                                    <span class="badge bg-success">

                                        Completed

                                    </span>

                                @else

                                    <span class="badge bg-warning">

                                        Pending

                                    </span>

                                @endif

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Due Date</strong>

                            </div>

                            <div class="col-md-8">

                                {{ optional($task->due_date)->format('d M Y') }}

                            </div>

                        </div>

                        <div class="row mb-4">

                            <div class="col-md-4">

                                <strong>Created On</strong>

                            </div>

                            <div class="col-md-8">

                                {{ $task->created_at->format('d M Y h:i A') }}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Right Side -->

            <div class="col-lg-4">

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">

                            Actions

                        </h4>

                    </div>

                    <div class="card-body">

                        @if($role == 'school')

                            <a href="{{ route('school.tasks.edit',$task->id) }}"
                               class="btn btn-primary w-100 mb-3">

                                <i class="fas fa-edit"></i>

                                Edit Task

                            </a>

                            <form action="{{ route('school.tasks.destroy',$task->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger w-100"
                                        onclick="return confirm('Delete this task?')">

                                    <i class="fas fa-trash"></i>

                                    Delete Task

                                </button>

                            </form>

                        @else

                            @if($task->status == 'Pending')

                                <form action="{{ route('student.tasks.complete',$task->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-success w-100">

                                        <i class="fas fa-check"></i>

                                        Mark as Completed

                                    </button>

                                </form>

                            @else

                                <form action="{{ route('student.tasks.pending',$task->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button class="btn btn-warning w-100">

                                        <i class="fas fa-undo"></i>

                                        Mark as Pending

                                    </button>

                                </form>

                            @endif

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
