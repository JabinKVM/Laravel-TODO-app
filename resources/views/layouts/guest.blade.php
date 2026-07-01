<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

</head>

<body>

<div class="container">

    <div class="row justify-content-center align-items-center"
         style="min-height:100vh;">

        <div class="col-md-5">

            @yield('content')

            {{ $slot }}

        </div>

    </div>

</div>

@include('layouts.scripts')

</body>

</html>