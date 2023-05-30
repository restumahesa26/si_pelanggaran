<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPELSIS - @yield('title')</title>
    @include('includes.style')
    @stack('addon-style')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('includes.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('includes.navbar')
            <!--  Header End -->
            <div class="container-fluid">
                @include('sweetalert::alert')
                @yield('content')
                @include('includes.footer')
            </div>
        </div>
    </div>
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
