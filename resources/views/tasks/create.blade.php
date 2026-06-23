<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">Add New Task</h3>
        </div>

        <div class="card-body">

            <form action="/store" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Task Name
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="Enter Task"
                           value="{{ old('title') }}">

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
                            {{ old('priority') == 'High' ? 'selected' : '' }}>
                            High
                        </option>

                        <option value="Medium"
                            {{ old('priority', 'Medium') == 'Medium' ? 'selected' : '' }}>
                            Medium
                        </option>

                        <option value="Low"
                            {{ old('priority') == 'Low' ? 'selected' : '' }}>
                            Low
                        </option>

                    </select>
                </div>

                <button type="submit"
                        class="btn btn-success">
                    Add Task
                </button>

                <a href="/"
                   class="btn btn-secondary">
                    Back
                </a>

            </form>

        </div>
    </div>

</div>

</body>
</html>