@extends('layouts.master')

@section('title', $title)

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">
                        {{ $title }}
                    </h4>

                </div>

            </div>

        </div>

        <!-- Success Message -->

        @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"></button>

        </div>

        @endif

        <!-- Card -->

        <div class="card">

            <div class="card-body">

                @if($role == 'school')

                <div class="mb-3">

                    <a href="{{ route('school.tasks.create') }}"
                       class="btn btn-primary">

                        <i class="mdi mdi-plus"></i>

                        Assign Task

                    </a>

                </div>

                @endif

                <table id="datatable"
                       class="table table-bordered dt-responsive nowrap w-100">

                    <thead>

                    <tr>

                        <th>#</th>

                        <th>Student</th>

                        <th>Title</th>

                        <th>Priority</th>

                        <th>Due Date</th>

                        <th>Status</th>

                        <th width="180">Action</th>

                    </tr>

                    </thead>

                    <tbody>

                    @foreach($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->student->name }}</td>

                        <td>{{ $task->title }}</td>

                        <td>

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

                        </td>

                        <td>

                            {{ $task->due_date->format('d M Y') }}

                        </td>

                        <td>

                            @if($task->status == 'Completed')

                                <span class="badge bg-success">

                                    Completed

                                </span>

                            @else

                                <span class="badge bg-warning">

                                    Pending

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($role == 'school')

                            <div class="d-flex gap-2">

                                <!-- View -->

                                <a href="{{ route('school.tasks.show',$task->id) }}"
                                   class="btn btn-sm btn-outline-info">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <!-- Edit -->

                                <a href="{{ route('school.tasks.edit',$task->id) }}"
                                   class="btn btn-sm btn-outline-secondary">

                                    <i class="fas fa-pencil-alt"></i>

                                </a>

                                <!-- Delete -->

                                <form action="{{ route('school.tasks.destroy',$task->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('DELETE')

                                    <button class="btn btn-sm btn-outline-danger">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                            @else

                            <div class="d-flex gap-2">

                                <!-- View -->

                                <a href="{{ route('student.tasks.show',$task->id) }}"
                                   class="btn btn-sm btn-outline-info">

                                    <i class="fas fa-eye"></i>

                                </a>

                                @if($task->status == 'Pending')

                                <form action="{{ route('student.tasks.complete',$task->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PATCH')

                                    <button class="btn btn-sm btn-outline-success">

                                        <i class="fas fa-check"></i>

                                    </button>

                                </form>

                                @else

                                <form action="{{ route('student.tasks.markPending',$task->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PATCH')

                                    <button class="btn btn-sm btn-outline-warning">

                                        <i class="fas fa-undo"></i>

                                    </button>

                                </form>

                                @endif

                            </div>

                            @endif

                        </td>

                    </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection