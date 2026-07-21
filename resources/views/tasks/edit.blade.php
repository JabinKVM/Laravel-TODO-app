@extends('layouts.master')

@section('title', 'Edit Task')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row">
            <div class="col-12">

                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">
                        Edit Task
                    </h4>

                    <div class="page-title-right">

                        <a href="{{ route('school.tasks.index') }}"
                           class="btn btn-secondary">

                            <i class="fas fa-arrow-left"></i>

                            Back

                        </a>

                    </div>

                </div>

            </div>
        </div>

        <!-- Validation Errors -->

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <div class="card">

            <div class="card-body">

                <form action="{{ route('school.tasks.update', $task->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <!-- Student -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Student

                            </label>

                            <select name="student_id"
                                    class="form-select"
                                    required>

                                @foreach($students as $student)

                                    <option value="{{ $student->id }}"
                                        {{ $student->id == $task->student_id ? 'selected' : '' }}>

                                        {{ $student->student_id }}
                                        -
                                        {{ $student->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- Priority -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Priority

                            </label>

                            <select name="priority"
                                    class="form-select"
                                    required>

                                <option value="High"
                                    {{ $task->priority == 'High' ? 'selected' : '' }}>

                                    High

                                </option>

                                <option value="Medium"
                                    {{ $task->priority == 'Medium' ? 'selected' : '' }}>

                                    Medium

                                </option>

                                <option value="Low"
                                    {{ $task->priority == 'Low' ? 'selected' : '' }}>

                                    Low

                                </option>

                            </select>

                        </div>

                        <!-- Title -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Task Title

                            </label>

                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title', $task->title) }}"
                                   required>

                        </div>

                        <!-- Description -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description"
                                      rows="5"
                                      class="form-control">{{ old('description', $task->description) }}</textarea>

                        </div>

                        <!-- Due Date -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Due Date

                            </label>

                            <input type="date"
                                   name="due_date"
                                   class="form-control"
                                   value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}"
                                   required>

                        </div>

                        <!-- Status -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

                            <select name="status"
                                    class="form-select">

                                <option value="Pending"
                                    {{ $task->status == 'Pending' ? 'selected' : '' }}>

                                    Pending

                                </option>

                                <option value="Completed"
                                    {{ $task->status == 'Completed' ? 'selected' : '' }}>

                                    Completed

                                </option>

                            </select>

                        </div>

                    </div>

                    <hr>

                    <div class="text-end">

                        <a href="{{ route('school.tasks.index') }}"
                           class="btn btn-light">

                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            <i class="fas fa-save"></i>

                            Update Task

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection