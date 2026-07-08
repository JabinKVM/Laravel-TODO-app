@extends('layouts.master')

@section('title','Task Details')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4 class="mb-0">

                Task Details

            </h4>

            <a href="{{ route('student.tasks') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back"></i>

                Back

            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title">

                    {{ $task->title }}

                </h4>

            </div>

            <div class="card-body">

                <div class="row mb-4">

                    <div class="col-md-6">

                        <strong>Priority</strong>

                        <br>

                        @if($task->priority == 'High')

                            <span class="badge bg-danger mt-2">

                                High

                            </span>

                        @elseif($task->priority == 'Medium')

                            <span class="badge bg-warning mt-2">

                                Medium

                            </span>

                        @else

                            <span class="badge bg-success mt-2">

                                Low

                            </span>

                        @endif

                    </div>

                    <div class="col-md-6">

                        <strong>Status</strong>

                        <br>

                        @if($task->completed)

                            <span class="badge bg-success mt-2">

                                Completed

                            </span>

                        @else

                            <span class="badge bg-danger mt-2">

                                Pending

                            </span>

                        @endif

                    </div>

                </div>

                <div class="row mb-4">

                    <div class="col-md-6">

                        <strong>Due Date</strong>

                        <p class="mt-2">

                            {{ $task->due_date ? $task->due_date->format('d M Y') : 'No Due Date' }}

                        </p>

                    </div>

                    <div class="col-md-6">

                        <strong>Assigned By</strong>

                        <p class="mt-2">

                            {{ optional($task->creator)->name }}

                        </p>

                    </div>

                </div>

                <div class="mb-4">

                    <strong>Description</strong>

                    <div class="border rounded p-3 mt-2 bg-light">

                        {!! nl2br(e($task->description ?? 'No Description')) !!}

                    </div>

                </div>

                <div class="mt-4">

                    @if(!$task->completed)

                        <form action="{{ route('student.tasks.complete',$task->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf

                            @method('PATCH')

                            <button class="btn btn-success">

                                <i class="bx bx-check-circle"></i>

                                Mark as Completed

                            </button>

                        </form>

                    @else

                        <form action="{{ route('student.tasks.pending',$task->id) }}"
                              method="POST"
                              class="d-inline">

                            @csrf

                            @method('PATCH')

                            <button class="btn btn-warning">

                                <i class="bx bx-reset"></i>

                                Mark as Pending

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection