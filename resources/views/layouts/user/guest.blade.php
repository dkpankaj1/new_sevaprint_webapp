<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '') | User Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons -->
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('dashboard/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="bg-color">

    <!-- Begin page -->
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12">
                <div class="p-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6 col-xl-6 col-lg-6">
                            {{ $slot }}
                        </div>
                        <div
                            class="col-md-6 col-xl-6 col-lg-6 p-0 vh-100 d-flex justify-content-center account-page-bg">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('dashboard/libs/toastr/toastr.min.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('dashboard/js/app.js') }}"></script>
    <x-toastr />

</body>

</html>
