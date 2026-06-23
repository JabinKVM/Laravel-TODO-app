<!DOCTYPE html>
<html>
<head>
    <title>TodoPro Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            background:#f4f7fc;
        }

        .sidebar{
            position:fixed;
            left:0;
            top:0;
            width:250px;
            height:100vh;
            background:#1e293b;
            color:white;
        }

        .sidebar h3{
            text-align:center;
            padding:20px;
            border-bottom:1px solid #334155;
        }

        .sidebar a{
            display:block;
            color:white;
            text-decoration:none;
            padding:15px 20px;
        }

        .sidebar a:hover{
            background:#334155;
        }

        .content{
            margin-left:250px;
            padding:30px;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <h3>
    ✅ TodoPro
</h3>

<p class="text-center text-light small">
    Task Management System
</p>

    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>

    <a href="{{ route('create-task') }}">➕ Create Task</a>

    <a href="{{ route('pending') }}">⏳ Pending Tasks</a>

    <a href="{{ route('completed') }}">✅ Completed Tasks</a>

    <a href="{{ route('profile.edit') }}">👤 Profile</a>

    <form method="POST" action="{{ route('logout') }}" class="p-3">
        @csrf

        <button type="submit" class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>

<div class="content">

    <nav class="navbar navbar-expand-lg bg-white shadow-sm rounded mb-4">

    <div class="container-fluid">

        <h4 class="mb-0">
            TodoPro Dashboard
        </h4>

        <div class="dropdown">

            <button class="btn btn-light dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">

                @if(Auth::user()->profile_photo)

    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
         width="40"
         height="40"
         class="rounded-circle me-2">

@else

    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
         width="40"
         height="40"
         class="rounded-circle me-2">

@endif

{{ Auth::user()->name }}

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item"
                       href="{{ route('profile.edit') }}">
                        Profile
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>

                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger">

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    </div>

</nav>

    @yield('content')

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>