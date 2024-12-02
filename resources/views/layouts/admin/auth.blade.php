<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'default title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ $brandSetting->favicon ?? asset('backend/images/favicon.ico')}}">

    @yield('datatable-css')
    <!-- App css -->
    <link href="{{ asset('backend/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons -->
    <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    @yield('page-head')

</head>

<!-- body start -->

<body data-menu-color="dark" data-sidebar="default">

    <!-- Begin page -->
    <div id="app-layout">

        <!-- Topbar Start -->
        @include('layouts.admin._admin.topbar')
        <!-- end Topbar -->

        <!-- Left Sidebar Start -->
        <div class="app-sidebar-menu">
            <div class="h-100" data-simplebar>

                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    <div class="logo-box">
                        <a href="index.html" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{ asset('backend/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('backend/images/logo-light.png') }}" alt="" height="24">
                            </span>
                        </a>
                        <a href="index.html" class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="{{ asset('backend/images/logo-sm.png') }}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('backend/images/logo-dark.png') }}" alt="" height="24">
                            </span>
                        </a>
                    </div>

                    {{-- sidebar::begin --}}
                    @include('layouts.admin._admin.sidebar')
                    {{-- sidebar::end --}}

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content px-3">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-18 fw-semibold m-0">@yield('page-title')</h4>
                    </div>

                    <div class="text-end">
                        @yield('breadcrumb')
                    </div>
                </div>
                {{ $slot }}

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col fs-13 text-muted text-center">
                            &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                                href="#!" class="text-reset fw-semibold">Cortex It Solution</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Vendor -->

    <script src="{{ asset('backend/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('backend/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/libs/toastr/toastr.min.js') }}"></script>

    <!-- App js-->
    @yield('datatable-js')
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <x-toastr />

    @yield('page-js')

</body>

</html>
