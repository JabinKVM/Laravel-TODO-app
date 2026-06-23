@extends('layouts.dashboard')

@section('content')

<h2>Pending Tasks</h2>

<table class="table">

@foreach($tasks as $task)

<tr>

    <td>{{ $task->title }}</td>

    <td>
        {{ $task->priority }}
    </td>

</tr>

@endforeach

</table>

@endsection