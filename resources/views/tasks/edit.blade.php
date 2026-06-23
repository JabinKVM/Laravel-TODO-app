<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3>Edit Task</h3>
        </div>

        <div class="card-body">

            <form action="/update/{{$task->id}}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Task Name
                    </label>

                    <input type="text"
                           name="title"
                           value="{{$task->title}}"
                           class="form-control">

                    @error('title')
                        <div class="text-danger mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Priority
                    </label>

                    <select name="priority" class="form-select">

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

                <button class="btn btn-success">
                    Update Task
                </button>

                <a href="/" class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>