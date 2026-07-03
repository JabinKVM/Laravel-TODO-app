<header id="page-topbar">

    <div class="navbar-header">

        <div class="d-flex">

            <!-- LOGO -->

            <div class="navbar-brand-box">

                <a href="{{ route('dashboard') }}"
                   class="logo logo-dark">

                    <span class="logo-sm">

                        <span class="logo-txt fw-bold fs-3">

                            T

                        </span>

                    </span>

                    <span class="logo-lg">

                        <span class="logo-txt fw-bold fs-4">

                            TodoPro
                           

                        </span>

                    </span>

                </a>

                <a href="{{ route('dashboard') }}"
                   class="logo logo-light">

                    <span class="logo-sm">

                        <span class="logo-txt text-white fw-bold fs-3">

                            T

                        </span>

                    </span>

                    <span class="logo-lg">

                        <span class="logo-txt text-white fw-bold fs-4">

                            TodoPro

                        </span>

                    </span>

                </a>

            </div>

            <!-- MENU BUTTON -->

            <button type="button"
                    class="btn btn-sm px-3 font-size-16 header-item waves-effect"
                    id="vertical-menu-btn">

                <i class="fa fa-fw fa-bars"></i>

            </button>

            

        </div>

        <div class="d-flex">

            <!-- FULLSCREEN -->

            <div class="dropdown d-none d-lg-inline-block ms-1">

                <button type="button"
                        class="btn header-item noti-icon waves-effect"
                        data-bs-toggle="fullscreen">

                    <i class="bx bx-fullscreen"></i>

                </button>

            </div>

            <!-- USER -->

            <div class="dropdown d-inline-block">

                <button type="button"
                        class="btn header-item waves-effect"
                        id="page-header-user-dropdown"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false">

                   <img
    class="rounded-circle header-profile-user"
    src="{{ Auth::user()->profile_photo
            ? asset('storage/' . Auth::user()->profile_photo)
            : asset('assets/images/users/avatar-1.jpg') }}"
    alt="{{ Auth::user()->name }}">

                    <span class="d-none d-xl-inline-block ms-2">

                        {{ Auth::user()->name }}

                    </span>

                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                </button>

                <div class="dropdown-menu dropdown-menu-end">

                    <a class="dropdown-item"
                       href="{{ route('profile.edit') }}">

                        <i class="bx bx-user me-2"></i>

                        View Profile

                    </a>

                    <div class="dropdown-divider"></div>

                    <form action="{{ route('logout') }}"
                          method="POST">

                        @csrf

                        <button class="dropdown-item text-danger"
                                type="submit">

                            <i class="bx bx-power-off me-2"></i>

                            Logout

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</header>