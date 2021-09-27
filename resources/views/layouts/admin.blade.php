<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    @include('layouts.admin.css')

  </head>
  <body>


    <!-- top navigation bar -->
    @include('layouts.admin.topNav')
    <!-- top navigation bar -->



    <!-- offcanvas sidebar  -->
    @include('layouts.admin.sidebar')
    <!-- offcanvas  sidebar -->



    <!-- Main contents -->
    @yield('content')
    <!-- Main contents -->

    @include('layouts.admin.jsFileLink')

    @yield('script')
  </body>
</html>
