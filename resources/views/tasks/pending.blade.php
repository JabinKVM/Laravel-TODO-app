@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <h4 class="mb-0">

                Pending Tasks

            </h4>

            <a href="{{ route('tasks.index') }}"
               class="btn btn-primary">

                <i class="bx bx-list-ul"></i>

                All Tasks

            </a>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover">

                <thead class="table-light">

                <tr>

                    <th>SI No.</th>

                    <th>Task</th>

                    <th>Priority</th>

                    <th>Actions</th>

                </tr>

                </thead>

                <tbody>

                @forelse($tasks as $task)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $task->title }}</td>

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

                            <form
                                action="{{ route('tasks.complete',$task->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                @method('PATCH')

                                <button
                                    class="btn btn-success btn-sm">

                                    Complete

                                </button>

                            </form>

                            <a href="{{ route('tasks.edit',$task->id) }}"
                               class="btn btn-primary btn-sm">

                                Edit

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4"
                            class="text-center">

                            No Pending Tasks

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection