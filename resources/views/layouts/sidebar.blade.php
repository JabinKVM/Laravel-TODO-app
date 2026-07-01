<div class="vertical-menu">

    <!-- Logo -->
    <div class="navbar-brand-box">

        <a href="{{ route('dashboard') }}" class="text-decoration-none text-center">

            <h2 class="text-white fw-bold mb-0">
                TodoPro
            </h2>

            <small class="text-light">
                Task Manager
            </small>

        </a>

    </div>

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- MENU -->
                <li class="menu-title">
                    Menu
                </li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- TASKS -->
                <li class="menu-title">
                    Tasks
                </li>

                <li>

                    <a href="javascript:void(0);" class="has-arrow">

                        <i class="bx bx-task"></i>

                        <span>Task Management</span>

                    </a>

                    <ul class="sub-menu">

                        <li>
                            <a href="{{ route('tasks.index') }}">
                                All Tasks
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tasks.create') }}">
                                Create Task
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tasks.pending') }}">
                                Pending Tasks
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tasks.completed') }}">
                                Completed Tasks
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('tasks.high-priority') }}">
                                High Priority
                            </a>
                        </li>

                    </ul>

                </li>
                <!-- =========================
        SETTINGS
========================== -->

<li class="menu-title">
    Settings
</li>

<li>
    <a href="{{ route('profile.edit') }}">
        <i class="bx bx-user-circle"></i>
        <span>View Profile</span>
    </a>
</li>

<li>
    <a href="{{ route('logout') }}"
       onclick="event.preventDefault();
       document.getElementById('logout-form').submit();">

        <i class="bx bx-log-out"></i>
        <span>Logout</span>

    </a>

    <form id="logout-form"
          action="{{ route('logout') }}"
          method="POST"
          class="d-none">
        @csrf
    </form>
</li>
                

                @if(auth()->user()->role == 'admin')

                <!-- ADMIN -->

                <li class="menu-title">
                    Admin
                </li>

                <li>

                    <a href="{{ route('admin.dashboard') }}">

                        <i class="bx bx-shield"></i>

                        <span>Admin Dashboard</span>

                    </a>

                </li>

                <li>

                    <a href="{{ route('admin.users') }}">

                        <i class="bx bx-group"></i>

                        <span>User Management</span>

                    </a>

                </li>

                @endif

            </ul>

        </div>

    </div>

</div>