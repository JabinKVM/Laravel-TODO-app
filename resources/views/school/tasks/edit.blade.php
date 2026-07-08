@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4>Edit Task</h4>

            <a href="{{ route('school.tasks.index') }}"
               class="btn btn-secondary">

                Back

            </a>

        </div>

    </div>

</div>

@if($errors->any())

<div class="alert alert-danger">

    <ul class="mb-0">

        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif

<div class="card">

    <div class="card-body">

        <form action="{{ route('school.tasks.update',$task->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Student

                    </label>

                    <select name="user_id"
                            class="form-control"
                            required>

                        @foreach($students as $student)

                            <option value="{{ $student->user_id }}"
                                {{ $task->user_id == $student->user_id ? 'selected' : '' }}>

                                {{ $student->name }}

                                ({{ $student->student_id }})

                            </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Priority

                    </label>

                    <select name="priority"
                            class="form-control">

                        <option value="High"
                            {{ $task->priority=='High'?'selected':'' }}>

                            High

                        </option>

                        <option value="Medium"
                            {{ $task->priority=='Medium'?'selected':'' }}>

                            Medium

                        </option>

                        <option value="Low"
                            {{ $task->priority=='Low'?'selected':'' }}>

                            Low

                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title',$task->title) }}"
                           required>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description"
                              rows="5"
                              class="form-control">{{ old('description',$task->description) }}</textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Due Date

                    </label>

                    <input type="date"
                           name="due_date"
                           value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}"
                           class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <input type="text"
                           class="form-control"
                           value="{{ $task->completed ? 'Completed' : 'Pending' }}"
                           readonly>

                </div>

            </div>

            <button class="btn btn-primary">

                <i class="bx bx-save"></i>

                Update Task

            </button>

        </form>

    </div>

</div>

@endsection