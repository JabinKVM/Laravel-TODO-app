<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>Login | TodoPro</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="TodoPro Login">

    <meta name="author"
          content="Jabin KVM">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- Favicon -->

    <link rel="shortcut icon"
          href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- Icons -->

    <link href="{{ asset('assets/css/icons.min.css') }}"
          rel="stylesheet">

    <!-- App -->

    <link href="{{ asset('assets/css/app.min.css') }}"
          rel="stylesheet">

</head>

<body>

<div class="account-pages my-5 pt-sm-5">

<div class="container">

<div class="row justify-content-center">

<div class="col-md-8 col-lg-6 col-xl-5">

<div class="card overflow-hidden shadow-lg">

    <!-- Top Banner -->

    <div class="bg-primary bg-soft">

        <div class="row">

            <div class="col-7">

                <div class="text-primary p-4">

                    <h5 class="text-primary">

                        Welcome Back 👋

                    </h5>

                    <p class="mb-0">

                        Sign in to continue to

                        <strong>TodoPro</strong>

                    </p>

                </div>

            </div>

            <div class="col-5 align-self-end">

                <img
                    src="{{ asset('assets/images/profile-img.png') }}"
                    class="img-fluid">

            </div>

        </div>

    </div>

    <!-- Logo -->

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
            {{-- Success Message --}}
@if(session('success'))

<div class="alert alert-success alert-dismissible fade show" role="alert">

    {{ session('success') }}

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close">
    </button>

</div>

@endif

{{-- Error Messages --}}
@if ($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

    <button
        type="button"
        class="btn-close"
        data-bs-dismiss="alert"
        aria-label="Close">
    </button>

</div>

@endif
                       <!-- Login Form -->

        <div class="p-2">

            <form method="POST"
                  action="{{ route('login') }}">

                @csrf

                <!-- Email -->

                <div class="mb-3">

                    <label for="email"
                           class="form-label">

                        Email Address

                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email"
                        required
                        autofocus>

                    @error('email')

                        <span class="invalid-feedback">

                            <strong>{{ $message }}</strong>

                        </span>

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
                            id="password"
                            type="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Enter your password"
                            required>

                        <button
                            class="btn btn-light"
                            type="button"
                            id="togglePassword">

                            <i class="mdi mdi-eye-outline"></i>

                        </button>

                        @error('password')

                            <span class="invalid-feedback d-block">

                                <strong>{{ $message }}</strong>

                            </span>

                        @enderror

                    </div>

                </div>

                <!-- Remember Me -->

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="remember_me"
                        name="remember">

                    <label
                        class="form-check-label"
                        for="remember_me">

                        Remember Me

                    </label>

                </div>

                <!-- Login Button -->

                <div class="mt-4 d-grid">

                    <button
                        class="btn btn-primary waves-effect waves-light"
                        type="submit">

                        <i class="bx bx-log-in-circle me-2"></i>

                        Sign In

                    </button>

                </div>

                <!-- Forgot Password -->

                @if (Route::has('password.request'))

                <div class="mt-4 text-center">

                    <a href="{{ route('password.request') }}"
                       class="text-muted">

                        <i class="mdi mdi-lock me-1"></i>

                        Forgot your password?

                    </a>

                </div>

                @endif

                @if (Route::has('register'))
<div class="mt-3 text-center">
    <span class="text-muted">Don't have an account?</span>

    <a href="{{ route('register') }}" class="fw-bold text-primary">
        Register
    </a>
</div>
@endif

            </form>

        </div>

    </div>

</div>


</div>

</div>

</div>

</div>

</div>

<!-- JAVASCRIPT -->



</body>

</html>