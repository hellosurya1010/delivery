<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <title>Star One</title>
    @include('layouts.partials._headerLinks')
    @yield('style')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.partials._navbar')
        <!-- ========== App Menu ========== -->
        @include('layouts.partials._sidebar')
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    @include('layouts.partials._titlebar')
                    @yield('content')
                    <!-- end page title -->
                </div>
                <!-- container-fluid -->
            </div>
            @include('layouts.partials._footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


    @include('layouts.partials._footerLinks')
    @yield('script')
</body>

</html>
