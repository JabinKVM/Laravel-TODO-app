@extends('layouts.master')

@section('title','All Tasks')

@section('content')

<!-- start page title -->

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                All Tasks

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('dashboard') }}">

                            Dashboard

                        </a>

                    </li>

                    

                </ol>

            </div>

        </div>

    </div>

</div>

<!-- end page title -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start mb-4">

                    <div>

                        

                    </div>

                    <div>

                        <a href="{{ route('tasks.create') }}"

                           class="btn btn-primary">

                            <i class="bx bx-plus me-1"></i>

                            New Task

                        </a>

                    </div>

                </div>

                <div class="table-responsive">

                    <table id="tasksTable"
                        class="table table-editable table-nowrap align-middle table-edits datatable">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Task</th>

                                <th>Priority</th>

                                <th>Status</th>

                                <th>Edit</th>

                            </tr>

                        </thead>

                 <tbody>

@forelse($tasks as $task)

<tr data-id="{{ $task->id }}">

    <td class="task-id" style="width:80px">
        {{ $loop->iteration }}
    </td>

    <td class="task-title">
        {{ $task->title }}
    </td>

    <td class="task-priority">
        {{ $task->priority }}
    </td>

    <td class="task-status">
        {{ $task->completed ? 'Completed' : 'Pending' }}
    </td>

    <td class="task-actions" style="width:120px">

        <button
            type="button"
            class="btn btn-outline-secondary btn-sm edit-task"
            data-id="{{ $task->id }}"
            title="Edit">

            <i class="fas fa-pencil-alt"></i>

        </button>

    </td>

</tr>

@empty

@endforelse

</tbody>

                    </table>
                    @if($tasks->isEmpty())

<div class="text-center py-5">

    <i class="bx bx-folder-open display-4 text-muted"></i>

    <h5 class="mt-3">

        No Tasks Found

    </h5>

    <p class="text-muted">

        Create your first task to get started.

    </p>

    <a href="{{ route('tasks.create') }}"
       class="btn btn-primary">

        <i class="bx bx-plus me-1"></i>

        Create Task

    </a>

</div>

@endif

                </div>

                

            </div>

        </div>

    </div>

</div>
<!-- =======================================
     Task Confirmation Modal
======================================= -->

<div class="modal fade"
     id="taskActionModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title"
                    id="taskModalTitle">

                    Confirm Action

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">
                </button>

            </div>

            <div class="modal-body">

                <p id="taskModalMessage">

                    Are you sure?

                </p>

            </div>

            <div class="modal-footer">

                <button
                    type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">

                    Cancel

                </button>

                <button
                    type="button"
                    class="btn btn-primary"
                    id="confirmTaskAction">

                    Confirm

                </button>

            </div>

        </div>

    </div>

</div>

@endsection