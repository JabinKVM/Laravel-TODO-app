@extends('layouts.master')

@section('title', 'Assign Task')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                    <h4 class="mb-sm-0">
                        Assign Task
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

                <form action="{{ route('school.tasks.store') }}"
                      method="POST">

                    @csrf

                    <div class="row">

                        <!-- Student -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Student

                            </label>

                            <select name="student_id"
                                    class="form-select"
                                    required>

                                <option value="">
                                    Select Student
                                </option>

                                @foreach($students as $student)

                                <option value="{{ $student->id }}">

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

                                <option value="High">
                                    High
                                </option>

                                <option value="Medium" selected>
                                    Medium
                                </option>

                                <option value="Low">
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
                                   value="{{ old('title') }}"
                                   required>

                        </div>

                        <!-- Description -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description"
                                      rows="5"
                                      class="form-control">{{ old('description') }}</textarea>

                        </div>

                        <!-- Due Date -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Due Date

                            </label>

                            <input type="date"
                                   name="due_date"
                                   class="form-control"
                                   value="{{ old('due_date') }}"
                                   required>

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

                            Assign Task

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection