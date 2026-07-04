<!-- ========== Left Sidebar Start ========== -->

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- Sidebar Menu -->

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">

                <!-- ================= MENU ================= -->

                <li class="menu-title" key="t-menu">
                    Menu
                </li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- ================= TASKS ================= -->

                <li class="menu-title" key="t-tasks">
                    Tasks
                </li>

                <li>

                    <a href="javascript:void(0);" class="has-arrow waves-effect">

                        <i class="bx bx-task"></i>

                        <span>Task Management</span>

                    </a>

                    <ul class="sub-menu" aria-expanded="false">

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
                <!-- ================= Students ================= -->
                <li class="menu-title" key="t-tasks">
                    Student Management
                </li>
                <li>

                    <a href="javascript:void(0);" class="has-arrow waves-effect">

                        <i class="bx bx-user"></i>

                        <span>Students</span>

                    </a>

                    <ul class="sub-menu" aria-expanded="false">

                        <li>

                        <a href="{{ route('students.index') }}">

                             Student Management

                        </a>

                        </li>

                        <li>

                            <a href="{{ route('students.create') }}">

                                Register Student

                            </a>

                        </li>

                    </ul>

                </li>

                <!-- ================= SETTINGS ================= -->

                <li class="menu-title" key="t-settings">
                    Settings
                </li>

                <li>

                    <a href="{{ route('profile.edit') }}" class="waves-effect">

                        <i class="bx bx-user-circle"></i>

                        <span>Profile</span>

                    </a>

                </li>

                <li>

                    <a href="#"
                       class="waves-effect"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">

                        <i class="bx bx-log-out-circle"></i>

                        <span>Logout</span>

                    </a>

                </li>

                @if(Auth::user()->role == 'admin')

                <!-- ================= ADMIN ================= -->

                <li class="menu-title" key="t-admin">
                    Admin
                </li>

                <li>

                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">

                        <i class="bx bx-shield-quarter"></i>

                        <span>Admin Dashboard</span>

                    </a>

                </li>

                <li>

                    <a href="{{ route('admin.users') }}" class="waves-effect">

                        <i class="bx bx-group"></i>

                        <span>User Management</span>

                    </a>

                </li>

                @endif

            </ul>

        </div>

    </div>

</div>

<form id="logout-form"
      action="{{ route('logout') }}"
      method="POST"
      class="d-none">

    @csrf

</form>

<!-- Left Sidebar End -->