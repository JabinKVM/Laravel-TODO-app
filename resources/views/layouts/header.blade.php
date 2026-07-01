<header id="page-topbar">

    <div class="navbar-header">

        <!-- LEFT SIDE -->
        <div class="d-flex align-items-center">

            <!-- Sidebar Toggle -->
            <button
                type="button"
                class="btn btn-sm px-3 header-item"
                id="vertical-menu-btn">

                <i class="fa fa-bars font-size-22"></i>

            </button>

            <!-- Project Name -->
            

        </div>

        <!-- RIGHT SIDE -->
        <div class="d-flex align-items-center">

            <!-- Search -->
            <form action="{{ route('tasks.index') }}" method="GET" class="d-none d-lg-block me-4">

                <div class="position-relative">

                    <input
                        type="text"
                        name="search"
                        class="form-control rounded-pill ps-5"
                        placeholder="Search Tasks..."
                        value="{{ request('search') }}">

                    <i class="bx bx-search position-absolute"
                       style="left:18px;top:12px;color:#74788d;"></i>

                </div>

            </form>

            <!-- User -->
            <div class="dropdown">

                <button
                    class="btn header-item d-flex align-items-center"
                    data-bs-toggle="dropdown">

                    @if(Auth::user()->profile_photo)

                        <img
                            src="{{ asset('storage/'.Auth::user()->profile_photo) }}"
                            class="rounded-circle"
                            width="36"
                            height="36">

                    @else

                        <img
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                            class="rounded-circle"
                            width="36">

                    @endif

                    <span class="ms-2 d-none d-xl-inline-block">

                        {{ Auth::user()->name }}

                    </span>

                    <i class="mdi mdi-chevron-down ms-1"></i>

                </button>

                <div class="dropdown-menu dropdown-menu-end">

                    <a
                        class="dropdown-item"
                        href="{{ route('profile.edit') }}">

                        <i class="bx bx-user me-2"></i>

                        My Profile

                    </a>

                    <div class="dropdown-divider"></div>

                    <form
                        action="{{ route('logout') }}"
                        method="POST">

                        @csrf

                        <button
                            class="dropdown-item">

                            <i class="bx bx-log-out me-2"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>