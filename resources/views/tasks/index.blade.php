@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <h4 class="mb-0">
                All Tasks
            </h4>

            <a href="{{ route('tasks.create') }}"
               class="btn btn-primary waves-effect waves-light">

                <i class="bx bx-plus me-1"></i>

                Create Task

            </a>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    <i class="bx bx-check-circle me-1"></i>

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

@endif

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th width="70">
                            SI No.
                        </th>

                        <th>
                            Task
                        </th>

                        <th width="120">
                            Priority
                        </th>

                        <th width="120">
                            Status
                        </th>

                        <th width="260">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

@forelse($tasks as $task)

<tr>

    <td>
        {{ $loop->iteration }}
    </td>

    <td>

        <strong>
            {{ $task->title }}
        </strong>

    </td>

    <td>

        @if($task->priority == 'High')

            <span class="badge bg-danger">
                High
            </span>

        @elseif($task->priority == 'Medium')

            <span class="badge bg-warning text-dark">
                Medium
            </span>

        @else

            <span class="badge bg-success">
                Low
            </span>

        @endif

    </td>

    <td>

        @if($task->completed)

            <span class="badge bg-success">
                Completed
            </span>

        @else

            <span class="badge bg-secondary">
                Pending
            </span>

        @endif

    </td>

    <td>

        <a href="{{ route('tasks.edit',$task->id) }}"
           class="btn btn-primary btn-sm waves-effect waves-light">

            <i class="bx bx-edit"></i>

        </a>

        @unless($task->completed)

        <form action="{{ route('tasks.complete',$task->id) }}"
              method="POST"
              class="d-inline">

            @csrf
            @method('PATCH')

            <button class="btn btn-success btn-sm waves-effect waves-light">

                <i class="bx bx-check"></i>

            </button>

        </form>

        @endunless

        <button
            type="button"
            class="btn btn-danger btn-sm waves-effect waves-light"
            data-bs-toggle="modal"
            data-bs-target="#deleteTaskModal{{ $task->id }}">

            <i class="bx bx-trash"></i>

        </button>

</td>

</tr>
<!-- Delete Task Modal -->
<div class="modal fade"
     id="deleteTaskModal{{ $task->id }}"
     tabindex="-1"
     aria-labelledby="deleteTaskModalLabel{{ $task->id }}"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header bg-danger text-white">

                <h5 class="modal-title"
                    id="deleteTaskModalLabel{{ $task->id }}">

                    <i class="bx bx-error-circle me-2"></i>

                    Delete Task

                </h5>

                <button type="button"
                        class="btn-close btn-close-white"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>

            <div class="modal-body text-center">

                <i class="bx bx-trash text-danger"
                   style="font-size:60px;"></i>

                <h4 class="mt-3">

                    Are you sure?

                </h4>

                <p class="text-muted">

                    You are about to permanently delete

                    <br>

                    <strong>{{ $task->title }}</strong>

                    <br><br>

                    This action cannot be undone.

                </p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-light waves-effect"
                        data-bs-dismiss="modal">

                    Cancel

                </button>

                <form action="{{ route('tasks.destroy', $task->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger waves-effect waves-light">

                        <i class="bx bx-trash me-1"></i>

                        Delete Task

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
@empty

<tr>

    <td colspan="5" class="text-center py-5">

        <i class="bx bx-task text-muted"
           style="font-size:60px;"></i>

        <h5 class="mt-3 text-muted">

            No Tasks Found

        </h5>

        <p class="text-muted mb-0">

            Create your first task to get started.

        </p>

    </td>

</tr>

@endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection