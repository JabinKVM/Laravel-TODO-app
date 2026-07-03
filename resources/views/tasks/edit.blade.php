@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex align-items-center justify-content-between">

            <div>

                <h4 class="mb-1">
                    Edit Task
                </h4>

                <p class="text-muted mb-0">
                    Update your task details.
                </p>

            </div>

            <a href="{{ route('tasks.index') }}"
               class="btn btn-secondary">

                <i class="bx bx-arrow-back me-1"></i>

                Back

            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header">

                <h4 class="card-title mb-0">
                    Edit Task
                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('tasks.update',$task->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">

                            Task Title

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title',$task->title) }}"
                            required>

                        @error('title')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Priority

                        </label>

                        <select
                            name="priority"
                            class="form-select">

                            <option value="High"
                                {{ $task->priority=='High' ? 'selected':'' }}>
                                High
                            </option>

                            <option value="Medium"
                                {{ $task->priority=='Medium' ? 'selected':'' }}>
                                Medium
                            </option>

                            <option value="Low"
                                {{ $task->priority=='Low' ? 'selected':'' }}>
                                Low
                            </option>

                        </select>

                    </div>

                 <div class="d-flex justify-content-between mt-4">

    <a href="{{ route('tasks.index') }}"
       class="btn btn-secondary">

        Back

    </a>

    <div>

        <button type="submit"
                class="btn btn-primary me-2">

            <i class="bx bx-save"></i>

            Update Task

        </button>

        <form action="{{ route('tasks.destroy',$task->id) }}"
              method="POST"
              class="d-inline"
              onsubmit="return confirm('Delete this task?')">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger">

                <i class="bx bx-trash"></i>

                Delete

            </button>

        </form>

    </div>

</div>   
            </div>

        </div>

    </div>

</div>

@endsection