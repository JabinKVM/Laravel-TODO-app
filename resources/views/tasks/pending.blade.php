@extends('layouts.master')

@section('title','Pending Tasks')

@section('content')

<!-- start page title -->

<div class="row">

    <div class="col-12">

        <div class="page-title-box d-sm-flex align-items-center justify-content-between">

            <h4 class="mb-sm-0 font-size-18">

                Pending Tasks

            </h4>

            <div class="page-title-right">

                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item">

                        <a href="{{ route('dashboard') }}">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item">

                        Tasks

                    </li>

                    

                </ol>

            </div>

        </div>

    </div>

</div>

<!-- end page title -->

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button class="btn-close" data-bs-dismiss="alert"></button>

</div>

@endif

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">

                

                <div class="table-responsive">

                    <table class="table table-editable table-nowrap align-middle table-edits datatable">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Task</th>

                                <th>Priority</th>

                                <th>Status</th>

                                <th>Edit</th>

                            </tr>

                        </thead>

                        <tbody>

@forelse($tasks as $task)

<tr data-id="{{ $task->id }}">

    <td data-field="id" style="width:80px">

        {{ $loop->iteration }}

    </td>

    <td data-field="name">

        {{ $task->title }}

    </td>

    <td data-field="age">

        {{ $task->priority }}

    </td>

    <td data-field="gender">

        Pending

    </td>

    <td style="width:100px">

        <a href="{{ route('tasks.edit',$task->id) }}"
           class="btn btn-outline-secondary btn-sm edit"
           title="Edit">

            <i class="fas fa-pencil-alt"></i>

        </a>

    </td>

</tr>
@empty

<tr>

    <td colspan="5" class="text-center py-5">

        No Pending Tasks Found

    </td>

</tr>

@endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection