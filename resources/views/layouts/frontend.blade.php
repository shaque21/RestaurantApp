<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>

    @include('layouts.frontend.frontcss')


  </head>
  <body>

    <!-- Main contents -->
    @yield('content')
    <!-- Main contents -->

    @include('layouts.frontend.frontJs')

    @yield('script')
  </body>
</html>
