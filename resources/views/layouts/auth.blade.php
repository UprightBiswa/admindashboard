<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title> Admin Dashboard</title>
    <!-- theme meta -->
    <meta name="theme-name" content="mono" />
    <!-- GOOGLE FONTS -->
    <link href="{{ asset('theme/https://fonts.googleapis.com/css?family=Karla:400,700|Roboto') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('theme/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/https://cdn.quilljs.com/1.3.6/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="{{ asset('theme/css/style.css') }}" />
    <!-- FAVICON -->
    <link href="{{ asset('theme/images/favicon.png') }}" rel="shortcut icon" />
    <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="{{ asset('theme/https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js') }}"></script>
    <script src="{{ asset('theme/https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
  <![endif]-->
    <script src="{{ asset('theme/plugins/nprogress/nprogress.js') }}"></script>
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body  class="navbar-fixed sidebar-fixed" id="body" style="background: linear-gradient(90deg, rgb(186, 171, 248) 0%, rgb(211, 211, 211) 67%, rgb(217, 218, 221) 100%);">

    <!-- ====================================
    ——— WRAPPER
    ===================================== -->
    <div class="wrapper">
        <!-- ====================================
          ——— LEFT SIDEBAR WITH OUT FOOTER
        ===================================== -->
        <aside class="left-sidebar" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer" style="background: linear-gradient(90deg, rgb(86, 175, 253) 0%, rgb(56, 162, 255) 65%, rgb(92, 119, 251) 100%);";
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="{{ url('home') }}">
                        <img src="{{ asset('theme/images/logo.png') }}" alt="Techmion">
                        {{-- <span class="brand-name">Techmion Logistics</span> --}}
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">

                        <li >
                            <a class="sidenav-item-link" href="{{ url('admin/dashboard') }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="text-dark">dashboard</span>
                            </a>
                        </li>


                        <li >
                            <a class="sidenav-item-link" href="{{ url('admin/customers') }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="text-dark">customer</span>
                            </a>
                        </li>
                        <li >
                            <a class="sidenav-item-link" href="{{ url('admin/services') }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="text-dark">service</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidenav-item-link" href="{{ url('admin/invoice') }}">
                                <i class="mdi mdi-chart-line"></i>
                                <span class="text-dark">invoice</span>
                            </a>
                        </li>

                        <li>
                            <a class="sidenav-item-link" href="{{ url('admin/quotations') }}">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="text-dark"> quotation</span>
                            </a>
                        </li>


                    </ul>
                </div>
            </div>
        </aside>



        <!-- ====================================
      ——— PAGE WRAPPER
      ===================================== -->
        <div class="page-wrapper">

            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-light" style="background: linear-gradient(90deg, rgb(129, 207, 255) 0%, rgb(82, 136, 244) 50%, rgb(155, 155, 155) 100%);" id="navbar">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle"></button>
                    <span class="page-title">dashboard</span>
                    <div class="navbar-right ">
                        <ul class="nav navbar-nav">
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{ asset('theme/images/user/user-xs-01.jpg') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">biswajit das</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right" style="background: linear-gradient(90deg, rgb(62, 91, 255) 0%, rgb(1, 59, 204) 50%, rgb(0, 33, 151) 100%);">
                                    <li>
                                        <a class="dropdown-link-item" href="#">
                                            <i class="mdi mdi-account-outline"></i>
                                            <span class="nav-text">My Profile</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a class="dropdown-link-item" href="#">
                                            <i class="mdi mdi-settings"></i>
                                            <span class="nav-text">EDIT Profile</span>
                                        </a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-link-item">
                                            <i class="mdi mdi-logout"></i> Log Out
                                        </button>
                                    </form>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
     {{-- CONTENT WRAPPER --}}
            @yield('content')

        </div>
    </div>
</div>






    <script src="{{ asset('theme/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/https://unpkg.com/hotkeys-js/dist/hotkeys.min.js') }}"></script>

    <script src="{{ asset('theme/plugins/apexcharts/apexcharts.js') }}"></script>

    <script src="{{ asset('theme/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('theme/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>

    <script src="{{ asset('theme/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('theme/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('theme/https://cdn.quilljs.com/1.3.6/quill.js') }}"></script>

    <script src="{{ asset('theme/plugins/toaster/toastr.min.js') }}"></script>

    <script src="{{ asset('theme/js/mono.js') }}"></script>

    <script src="{{ asset('theme/js/custom.js') }}"></script>


</body>

</html>
