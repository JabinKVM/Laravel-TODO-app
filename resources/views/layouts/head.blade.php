<head>

    <meta charset="utf-8" />

    <title>@yield('title','TodoPro | Task Management System')</title>

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="description"
          content="TodoPro - Task Management System">

    <meta name="author"
          content="Jabin KVM">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <!-- App favicon -->

    <link rel="shortcut icon"
          href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->

    <link href="{{ asset('assets/css/bootstrap.min.css') }}"
          id="bootstrap-style"
          rel="stylesheet"
          type="text/css" />

    <!-- Icons Css -->

    <link href="{{ asset('assets/css/icons.min.css') }}"
          rel="stylesheet"
          type="text/css" />

    <!-- App Css -->

    <link href="{{ asset('assets/css/app.min.css') }}"
          id="app-style"
          rel="stylesheet"
          type="text/css" />

    <!-- Select2 -->

    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}"
          rel="stylesheet"
          type="text/css" />

    <!-- Bootstrap Datepicker -->

    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}"
          rel="stylesheet"
          type="text/css" />

    <!-- Editable Table -->

    <link href="{{ asset('assets/libs/table-edits/build/table-edits.css') }}"
          rel="stylesheet"
          type="text/css" />

    <!-- TodoPro CSS -->

    <link href="{{ asset('assets/css/todopro.css') }}"
          rel="stylesheet"
          type="text/css" />

</head>