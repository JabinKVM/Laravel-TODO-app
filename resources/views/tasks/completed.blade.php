@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <h4 class="mb-0">
                Completed Tasks
            </h4>

            <a href="{{ route('tasks.index') }}" class="btn btn-primary">
                <i class="bx bx-arrow-back"></i>
                Back to All Tasks
            </a>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert">
    </button>

</div>

@endif

<div class="card">

    <div class="card-header">

        <h4 class="card-title mb-0">
            Completed Task List
        </h4>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>

                        <th>SI NO.</th>

                        <th>Task</th>

                        <th>Priority</th>

                        <th>Status</th>

                        <th width="180">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->title }}</td>

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

                            <span class="badge bg-success">

                                Completed

                            </span>

                        </td>

                        <td>

                            <a href="{{ route('tasks.edit',$task->id) }}"
                               class="btn btn-primary btn-sm">

                                Edit

                            </a>

                            <form
                                action="{{ route('tasks.destroy',$task->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Delete this task?')"
                                    class="btn btn-danger btn-sm">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center text-muted">

                            No Completed Tasks Found.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection