<!doctype html>

<html lang="en">

@include('layouts.head')

<body data-sidebar="dark">

<div id="layout-wrapper">

    @include('layouts.header')

    @include('layouts.sidebar')

    <div class="main-content">

        <div class="page-content">

            <div class="container-fluid">

                @yield('content')

            </div>

        </div>

        @include('layouts.footer')

    </div>

</div>

<div class="rightbar-overlay"></div>

@include('layouts.scripts')

</body>

</html>