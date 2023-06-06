<!DOCTYPE html>
<html lang="en">
<head>
    @include('auth::section.meta') {{-- Load Meta File --}}
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('auth::section.css') {{-- Load CSS File --}}
</head>
<body class="light rtl">
<!--  body  -->
@yield('content')
<!-- #END# body -->
@include('auth::section.js') {{-- Load JS File --}}
</body>
</html>