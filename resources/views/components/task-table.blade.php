@props([
    'tasks',
    'role'
])

<div class="table-responsive">

    <table class="table table-bordered table-hover align-middle">

        <thead>

        <tr>

            <th>#</th>

            <th>Student</th>

            <th>Title</th>

            <th>Priority</th>

            <th>Due Date</th>

            <th>Status</th>

            <th width="220">

                Action

            </th>

        </tr>

        </thead>

        <tbody>

        @forelse($tasks as $task)

        <tr>

            <td>{{ $loop->iteration }}</td>

            <td>{{ optional($task->user)->name }}</td>

            <td>{{ $task->title }}</td>

            <td>

                @if($task->priority=='High')

                    <span class="badge bg-danger">

                        High

                    </span>

                @elseif($task->priority=='Medium')

                    <span class="badge bg-warning">

                        Medium

                    </span>

                @else

                    <span class="badge bg-success">

                        Low

                    </span>

                @endif

            </td>

            <td>

                {{ $task->due_date ? $task->due_date->format('d M Y') : '-' }}

            </td>

            <td>

                @if($task->completed)

                    <span class="badge bg-success">

                        Completed

                    </span>

                @else

                    <span class="badge bg-danger">

                        Pending

                    </span>

                @endif

            </td>

            <td>

                {{-- School Buttons --}}

                @if($role == 'school')

                    <a href="{{ route('school.tasks.edit',$task->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form
                        action="{{ route('school.tasks.destroy',$task->id) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete Task?')">

                            Delete

                        </button>

                    </form>

                @endif

                {{-- Student Buttons --}}

                @if($role == 'student')

                    <a href="{{ route('student.tasks.show',$task->id) }}"
                       class="btn btn-info btn-sm">

                        View

                    </a>

                    @if(!$task->completed)

                        <form
                            action="{{ route('student.tasks.complete',$task->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-success btn-sm">

                                Complete

                            </button>

                        </form>

                    @else

                        <form
                            action="{{ route('student.tasks.pending',$task->id) }}"
                            method="POST"
                            class="d-inline">

                            @csrf
                            @method('PATCH')

                            <button class="btn btn-warning btn-sm">

                                Pending

                            </button>

                        </form>

                    @endif

                @endif

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="7" class="text-center">

                No Tasks Found

            </td>

        </tr>

        @endforelse

        </tbody>

    </table>

</div>