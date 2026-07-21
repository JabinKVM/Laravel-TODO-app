<!-- ========== Left Sidebar Start ========== -->

<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">

           {{-- ========================= SCHOOL ========================= --}}

@if(Auth::user()->role == 'school')

    <li class="menu-title">MENU</li>

    <li>
        <a href="{{ route('school.dashboard') }}" class="waves-effect">
            <i class="bx bx-home-circle"></i>
            <span>Dashboard</span>
        </a>
    </li>

    {{-- Students --}}

    <li class="menu-title">STUDENTS</li>

    <li>

        <a href="javascript:void(0);" class="has-arrow waves-effect">

            <i class="bx bx-user"></i>

            <span>Student Management</span>

        </a>

        <ul class="sub-menu">

            <li>
                <a href="{{ route('school.students.create') }}">
                    Register Student
                </a>
            </li>

            <li>
                <a href="{{ route('school.students.index') }}">
                    View Students
                </a>
            </li>

        </ul>

    </li>

    {{-- Tasks --}}

    <li class="menu-title">TASKS</li>

    <li>

        <a href="javascript:void(0);" class="has-arrow waves-effect">

            <i class="bx bx-task"></i>

            <span>Task Management</span>

        </a>

        <ul class="sub-menu">

            <li>
                <a href="{{ route('school.tasks.create') }}">
                    Assign Task
                </a>
            </li>

            <li>
                <a href="{{ route('school.tasks.index') }}">
                    View Tasks
                </a>
            </li>

        </ul>

    </li>
    <!-- #chat -->
    <li class="menu-title">CHAT</li>

<li>

    <a href="{{ route('school.chat.index') }}" class="waves-effect">

        <i class="bx bx-message-rounded-dots"></i>

        <span>Messages</span>

    </a>

</li>

    {{-- Settings --}}

    <li class="menu-title">SETTINGS</li>

    <li>

        <a href="{{ route('profile.edit') }}">

            <i class="bx bx-user-circle"></i>

            <span>Profile</span>

        </a>

    </li>

    <li>

        <a href="#"
           onclick="event.preventDefault();
           document.getElementById('logout-form').submit();">

            <i class="bx bx-log-out-circle"></i>

            <span>Logout</span>

        </a>

    </li>

@endif


                {{-- ========================= STUDENT ========================= --}}

                @if(Auth::user()->role == 'student')

                    <li class="menu-title">MENU</li>

                    <li>

                        <a href="{{ route('student.dashboard') }}" class="waves-effect">

                            <i class="bx bx-home-circle"></i>

                            <span>Dashboard</span>

                        </a>

                    </li>

                    

                    <li class="menu-title">TASKS</li>

                    <li class="menu-title">TASKS</li>

<li>

    <a href="javascript:void(0);" class="has-arrow waves-effect">

        <i class="bx bx-task"></i>

        <span>My Tasks</span>

    </a>

    <ul class="sub-menu">

        <li>
            <a href="{{ route('student.tasks.index')}}">
                All Tasks
            </a>
        </li>

        <li>
            <a href="{{ route('student.tasks.pending')}}">
                Pending Tasks
            </a>
        </li>

        <li>
            <a href="{{ route('student.tasks.completed')}}">
                Completed Tasks
            </a>
        </li>

        <li>
            <a href="{{ route('student.tasks.high') }}">
                High Priority
            </a>
        </li>


        <li class="menu-title">CHAT</li>

<li>

    <a href="{{ route('student.chat.index') }}" class="waves-effect">

        <i class="bx bx-message-rounded-dots"></i>

        <span>Messages</span>

    </a>

</li>
    </ul>

</li>

                   

                    <li class="menu-title">SETTINGS</li>

                    <li>

                        <a href="{{ route('profile.edit') }}">

                            <i class="bx bx-user-circle"></i>

                            <span>Profile</span>

                        </a>

                    </li>

                    <li>

                        <a href="#"
                           onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">

                            <i class="bx bx-log-out-circle"></i>

                            <span>Logout</span>

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