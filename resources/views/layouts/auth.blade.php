<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />


    {{-- <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"> --}}



</head>

<body>

    <div class="container-scroller">

        @include('layouts.inc.admin.navber')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="d-flex align-items-end flex-wrap">
                                    <div class="me-md-3 me-xl-5">
                                        @if (request()->is('admin/dashboard'))
                                            <h2>Welcome back,</h2>
                                        @endif
                                        @if (session('success'))
                                            <p class="alert alert-success mb-md-0">{{ session('success') }}</p>
                                        @else
                                            <p class="mb-md-0">Admin dashboard all information.</p>
                                        @endif
                                    </div>
                                    <div class="d-flex">
                                        <i class="mdi mdi-home text-muted hover-cursor"></i>
                                        <p class="text-primary mb-0 hover-cursor">&nbsp;/&nbsp;{{ request()->path() }}&nbsp;/&nbsp;
                                        </p>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-end flex-wrap">
                                    <button type="button"
                                        class="btn btn-light bg-white btn-icon me-3 d-none d-md-block ">
                                        <i class="mdi mdi-download text-muted"></i>
                                    </button>
                                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                                        <i class="mdi mdi-clock-outline text-muted"></i>
                                    </button>
                                    <button type="button" class="btn btn-light bg-white btn-icon me-3 mt-2 mt-xl-0">
                                        <i class="mdi mdi-plus text-muted"></i>
                                    </button>
                                    <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @yield('content')
                </div>
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © <a
                                href="https://www.bootstrapdash.com/" target="_blank"> Techmion Solutions India Pvt.
                                Ltd. </a>All rights reserved.2023</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            we provide <a href="https://www.bootstrapdash.com/" target="_blank"> Support:
                                contact@techmion.com
                            </a>24/7</span>
                    </div>
                </footer>
            </div>
        </div>
    </div>



    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>

    <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>

    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <script src="{{ asset('admin/js/data-table.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="{{ asset('assets/js/jquery-3.6.4.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
