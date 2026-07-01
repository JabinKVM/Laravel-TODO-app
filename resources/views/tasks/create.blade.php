@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-flex justify-content-between align-items-center">

            <h4 class="mb-0">
                Create Task
            </h4>

            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">

                <i class="bx bx-arrow-back"></i>

                Back

            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    Add New Task
                </h5>

            </div>

            <div class="card-body">

                <form action="{{ route('tasks.store') }}" method="POST">

                    @csrf

                    <!-- Task Title -->

                    <div class="mb-3">

                        <label class="form-label">

                            Task Title

                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter task title"
                            value="{{ old('title') }}">

                        @error('title')

                            <div class="invalid-feedback">

                                {{ $message }}

                            </div>

                        @enderror

                    </div>

                    <!-- Priority -->

                    <div class="mb-3">

                        <label class="form-label">

                            Priority

                        </label>

                        <select
                            name="priority"
                            class="form-select">

                            <option value="Low">

                                Low

                            </option>

                            <option value="Medium">

                                Medium

                            </option>

                            <option value="High">

                                High

                            </option>

                        </select>

                    </div>

                    <!-- Buttons -->

                    <div class="mt-4">

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bx bx-save"></i>

                            Save Task

                        </button>

                        <a
                            href="{{ route('tasks.index') }}"
                            class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <!-- Right Card -->

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                Task Information

            </div>

            <div class="card-body">

                <p>

                    Use this page to create a new task.

                </p>

                <ul>

                    <li>Select the appropriate priority.</li>

                    <li>High priority tasks appear separately.</li>

                    <li>Tasks are initially marked as Pending.</li>

                    <li>You can edit or complete tasks later.</li>

                </ul>

            </div>

        </div>

    </div>

</div>

@endsection