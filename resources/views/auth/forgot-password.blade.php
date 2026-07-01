<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />

    <title>Forgot Password | TodoPro</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="TodoPro Password Recovery">

    <meta name="author"
          content="Jabin KVM">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- App favicon -->

    <link rel="shortcut icon"
          href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}"
          rel="stylesheet">

    <!-- Icons -->

    <link href="{{ asset('assets/css/icons.min.css') }}"
          rel="stylesheet">

    <!-- App CSS -->

    <link href="{{ asset('assets/css/app.min.css') }}"
          rel="stylesheet">

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

Forgot Password?

</h5>

<p>

Enter your email to receive a password reset link.

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

<a href="{{ url('/') }}">

<div class="avatar-md profile-user-wid mb-4">

<span class="avatar-title rounded-circle bg-light">

<i class="bx bx-lock-open text-primary"
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

Password Recovery

</p>

</div>

@if(session('status'))

<div class="alert alert-success">

{{ session('status') }}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

<ul class="mb-0">

@foreach($errors->all() as $error)

<li>{{ $error }}</li>

@endforeach

</ul>

</div>

@endif
<div class="p-2">

    <div class="alert alert-info text-center mb-4">

        Enter your registered email address and we'll send you a password reset link.

    </div>

    <form method="POST"
          action="{{ route('password.email') }}">

        @csrf

        <!-- Email Address -->

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

                <div class="invalid-feedback">

                    {{ $message }}

                </div>

            @enderror

        </div>

        <!-- Reset Button -->

        <div class="d-grid mt-4">

            <button
                type="submit"
                class="btn btn-primary waves-effect waves-light">

                <i class="bx bx-mail-send me-2"></i>

                Send Password Reset Link

            </button>

        </div>

    </form>

</div>

</div>

</div>
<!-- Footer -->

<div class="mt-5 text-center">

    <p>

        Remember your password?

        <a href="{{ route('login') }}"
           class="fw-medium text-primary">

            Sign In

        </a>

    </p>

    @if (Route::has('register'))

    <p>

        Don't have an account?

        <a href="{{ route('register') }}"
           class="fw-medium text-primary">

            Create Account

        </a>

    </p>

    @endif

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

</div>

<!-- JAVASCRIPT -->

<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>

<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>

<script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>