@extends('layouts.master')

@section('title','Edit Student')

@section('content')

<div class="page-content">

    <div class="container-fluid">

        <!-- Page Title -->

        <div class="row">

            <div class="col-12">

                <div class="page-title-box d-flex align-items-center justify-content-between">

                    <h4 class="mb-0">

                        Edit Student

                    </h4>

                    <a href="{{ route('school.students.index') }}"
                       class="btn btn-secondary">

                        Back

                    </a>

                </div>

            </div>

        </div>

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

            <div class="card-header">

                <h4 class="card-title">

                    Update Student

                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('school.students.update',$student->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Student Name

                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name',$student->name) }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Email

                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email',$student->email) }}"
                                   required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Phone

                            </label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   value="{{ old('phone',$student->phone) }}"
                                   required>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Address

                            </label>

                            <textarea name="address"
                                      rows="4"
                                      class="form-control"
                                      required>{{ old('address',$student->address) }}</textarea>

                        </div>

                    </div>

                    <div class="text-end">

                        <a href="{{ route('school.students.index') }}"
                           class="btn btn-secondary">

                            Cancel

                        </a>

                        <button type="submit"
                                class="btn btn-primary">

                            Update Student

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection