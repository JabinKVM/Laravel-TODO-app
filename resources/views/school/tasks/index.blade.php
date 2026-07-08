@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4>Assigned Tasks</h4>

            <a href="{{ route('school.tasks.create') }}"
               class="btn btn-primary">

                <i class="bx bx-plus"></i>

                Assign Task

            </a>

        </div>

    </div>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Student</th>

                        <th>Title</th>

                        <th>Priority</th>

                        <th>Status</th>

                        <th>Due Date</th>

                        <th width="180">Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->user->name }}</td>

                        <td>{{ $task->title }}</td>

                        <td>

                            @if($task->priority=='High')

                                <span class="badge bg-danger">High</span>

                            @elseif($task->priority=='Medium')

                                <span class="badge bg-warning">Medium</span>

                            @else

                                <span class="badge bg-success">Low</span>

                            @endif

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

                        <td>

                            {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}

                        </td>

                        <td>

                            <a href="{{ route('school.tasks.edit',$task->id) }}"
                               class="btn btn-sm btn-warning">

                                Edit

                            </a>

                            <form action="{{ route('school.tasks.destroy',$task->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-sm btn-danger"
                                        onclick="return confirm('Delete Task?')">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            No Tasks Assigned

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