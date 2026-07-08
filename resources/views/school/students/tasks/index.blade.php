@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4>My Tasks</h4>

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

                        <th>Title</th>

                        <th>Description</th>

                        <th>Priority</th>

                        <th>Status</th>

                        <th>Assigned By</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->title }}</td>

                        <td>{{ $task->description }}</td>

                        <td>

                            @if($task->priority=='High')

                                <span class="badge bg-danger">

                                    High

                                </span>

                            @elseif($task->priority=='Medium')

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

                                <span class="badge bg-danger">

                                    Pending

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ optional($task->creator)->name }}

                        </td>

                        <td>

                            @if(!$task->completed)

                                <form action="{{ route('student.tasks.complete',$task->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PATCH')

                                    <button class="btn btn-success btn-sm">

                                        Complete

                                    </button>

                                </form>

                            @else

                                <form action="{{ route('student.tasks.pending',$task->id) }}"
                                      method="POST">

                                    @csrf

                                    @method('PATCH')

                                    <button class="btn btn-warning btn-sm">

                                        Mark Pending

                                    </button>

                                </form>

                            @endif

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