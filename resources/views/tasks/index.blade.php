<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1>My Tasks</h1>

        <a href="/create" class="btn btn-primary">
            Add New Task
        </a>

    </div>

    @if($tasks->count() > 0)

    <table class="table table-bordered table-hover">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Task</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @foreach($tasks as $task)

            <tr>

                <td>{{ $task->id }}</td>

                <td>

                    @if($task->completed)
                        <span class="text-success fw-bold">
                            ✓ {{ $task->title }}
                        </span>
                    @else
                        {{ $task->title }}
                    @endif

                </td>

                <td>

                    @if($task->priority == 'High')
                        <span class="badge bg-danger">
                            High
                        </span>

                    @elseif($task->priority == 'Medium')
                        <span class="badge bg-warning text-dark">
                            Medium
                        </span>

                    @else
                        <span class="badge bg-info">
                            Low
                        </span>
                    @endif

                </td>

                <td>

                    @if($task->completed)

                        <span class="badge bg-success">
                            Completed
                        </span>

                    @else

                        <span class="badge bg-secondary">
                            Pending
                        </span>

                    @endif

                </td>

                <td>

                    @if(!$task->completed)

                    <form action="/complete/{{$task->id}}"
                          method="POST"
                          style="display:inline;">

                        @csrf
                        @method('PUT')

                        <button class="btn btn-success btn-sm">
                            Complete
                        </button>

                    </form>

                    @endif

                    <a href="/edit/{{$task->id}}"
                       class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <form action="/delete/{{$task->id}}"
                          method="POST"
                          style="display:inline;">

                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    @else

        <div class="alert alert-info">
            No tasks available.
        </div>

    @endif

</div>

</body>
</html>