<!DOCTYPE html>
<html lang="en">
<head>
    @include('home::section.meta') {{-- Load Meta File --}}
    <title>@yield('title') | {{ config('app.name') }}</title>
    @include('home::section.css') {{-- Load CSS File --}}
</head>

<body class="light rtl">
<!-- Page Loader -->
{{--    @include('home::section.preloader')--}}
<!-- #END# Page Loader -->

<!-- nav Bar -->
@include('home::section.navbar')
<!-- #nav Bar -->
<div>
    <!-- Left Sidebar -->
    @include('home::section.right-Sidebar')
    <!-- #END# Left Sidebar -->


    <!-- Right Sidebar -->
    @include('home::section.left-sidebar')
    <!-- #END# Right Sidebar -->

</div>
<!--  body  -->
@yield('content')
<!-- #END# body -->



@include('home::section.js') {{-- Load JS File --}}
</body>
</html>