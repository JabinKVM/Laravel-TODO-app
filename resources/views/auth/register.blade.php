<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>Register | TodoPro</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="TodoPro Registration">

    <meta name="author" content="Jabin KVM">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Icons Css -->

    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet">

    <!-- App Css -->

    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">

    <!-- Plugin -->

    <script src="{{ asset('assets/js/plugin.js') }}"></script>

</head>

<body>

<div class="account-pages my-5 pt-sm-5">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8 col-lg-6 col-xl-5">

                <div class="card overflow-hidden shadow-lg">

                    <div class="bg-primary-subtle">

                        <div class="row">

                            <div class="col-7">

                                <div class="text-primary p-4">

                                    <h5 class="text-primary">

                                        Create Your Account

                                    </h5>

                                    <p>

                                        Join TodoPro and organize your daily tasks efficiently.

                                    </p>

                                </div>

                            </div>

                            <div class="col-5 align-self-end">

                                <img src="{{ asset('assets/images/profile-img.png') }}"
                                     class="img-fluid">

                            </div>

                        </div>

                    </div>

                    <div class="card-body pt-0">

                        <div class="auth-logo">

                            <a href="{{ url('/') }}"
                               class="auth-logo-dark">

                                <div class="avatar-md profile-user-wid mb-4">

                                    <span class="avatar-title rounded-circle bg-light">

                                        <i class="bx bx-task text-primary"
                                           style="font-size:35px;"></i>

                                    </span>

                                </div>

                            </a>

                        </div>

                        <div class="text-center mb-4">

                            <h4>

                                TodoPro

                            </h4>

                            <p class="text-muted">

                                Smart Task Management System

                            </p>

                        </div>

                        @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                        @endif
                        <div class="p-2">

    <form method="POST"
          action="{{ route('register') }}">

        @csrf

        <!-- Name -->

        <div class="mb-3">

            <label for="name" class="form-label">

                Full Name

            </label>

            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Enter your full name"
                required
                autofocus>

            @error('name')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Email -->

        <div class="mb-3">

            <label for="email" class="form-label">

                Email Address

            </label>

            <input
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
                required>

            @error('email')

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Password -->

        <div class="mb-3">

            <label for="password"
                   class="form-label">

                Password

            </label>

            <div class="input-group auth-pass-inputgroup">

                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    placeholder="Enter password"
                    required>

                <button
                    class="btn btn-light"
                    type="button"
                    id="togglePassword">

                    <i class="mdi mdi-eye-outline"></i>

                </button>

            </div>

            @error('password')

                <div class="invalid-feedback d-block">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Confirm Password -->

        <div class="mb-3">

            <label for="password_confirmation"
                   class="form-label">

                Confirm Password

            </label>

            <div class="input-group auth-pass-inputgroup">

                <input
                    type="password"
                    class="form-control"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    required>

                <button
                    class="btn btn-light"
                    type="button"
                    id="toggleConfirmPassword">

                    <i class="mdi mdi-eye-outline"></i>

                </button>

            </div>

        </div>

        <div class="mt-4 d-grid">

            <button
                class="btn btn-primary waves-effect waves-light"
                type="submit">

                <i class="bx bx-user-plus me-2"></i>

                Create Account

            </button>

        </div>

        <div class="mt-4 text-center">

            <p class="mb-0">

                By registering you agree to the

                <a href="#"
                   class="text-primary">

                    Terms & Conditions

                </a>

            </p>

        </div>

    </form>


</div>
                        </div>

                    </div>

                </div>

                <!-- Footer -->

                <div class="mt-5 text-center">

                    <p>

                        Already have an account?

                        <a href="{{ route('login') }}"
                           class="fw-medium text-primary">

                            Sign In

                        </a>

                    </p>

                    <p class="text-muted">

                        © {{ date('Y') }}

                        TodoPro

                        <br>

                        <small>

                            Powered by Laravel 12 & Skote Admin Template

                        </small>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- JAVASCRIPT -->

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>

<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>

<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

<!-- Password Toggle -->

<script>

document.getElementById('togglePassword').addEventListener('click', function () {

    const password = document.getElementById('password');

    const icon = this.querySelector('i');

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('mdi-eye-outline');

        icon.classList.add('mdi-eye-off-outline');

    } else {

        password.type = 'password';

        icon.classList.remove('mdi-eye-off-outline');

        icon.classList.add('mdi-eye-outline');

    }

});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {

    const password = document.getElementById('password_confirmation');

    const icon = this.querySelector('i');

    if (password.type === 'password') {

        password.type = 'text';

        icon.classList.remove('mdi-eye-outline');

        icon.classList.add('mdi-eye-off-outline');

    } else {

        password.type = 'password';

        icon.classList.remove('mdi-eye-off-outline');

        icon.classList.add('mdi-eye-outline');

    }

});

</script>

</body>

</html>