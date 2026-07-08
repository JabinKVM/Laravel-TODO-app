@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4>Assign Task</h4>

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

        <form action="{{ route('school.tasks.store') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Student

                    </label>

                    <select name="user_id" class="form-control" required>

                        <option value="">Select Student</option>

                        @foreach($students as $student)

                            <option value="{{ $student->user_id }}">

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

                    <select name="priority" class="form-control" required>

                        <option value="High">High</option>

                        <option value="Medium" selected>Medium</option>

                        <option value="Low">Low</option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Task Title

                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title') }}"
                           required>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description"
                              rows="5"
                              class="form-control">{{ old('description') }}</textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Due Date

                    </label>

                    <input type="date"
                           name="due_date"
                           class="form-control"
                           value="{{ old('due_date') }}">

                </div>

            </div>

            <button class="btn btn-primary">

                <i class="bx bx-save"></i>

                Assign Task

            </button>

        </form>

    </div>

</div>

@endsection