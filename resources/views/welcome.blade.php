<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Laravel</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset("admin/vendors/base/vendor.bundle.base.css") }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset("admin/css/style.css") }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset("admin/images/favicon.png") }}" />
</head>

<body class="antialiased">

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth lock-full-bg">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-transparent text-left p-5 text-center">
              <img src="{{ asset("admin/images/faces/face13.jpg") }}" class="lock-profile-img" alt="img">
              <form class="pt-5">
                <div>
                    @if (Route::has('login'))
                        <div >
                            @auth
                                <a class="btn btn-block btn-success btn-lg font-weight-medium" href="{{ url('/admin/dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn btn-block btn-success btn-lg font-weight-medium" href="{{ route('login') }}">Log in</a>

                                @if (Route::has('register'))
                                    <a class="btn btn-block btn-success btn-lg font-weight-medium" href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>


              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset("admin/vendors/base/vendor.bundle.base.js") }}"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="{{ asset("admin/js/off-canvas.js") }}"></script>
  <script src="{{ asset("admin/js/hoverable-collapse.js") }}"></script>
  <script src="{{ asset("admin/js/template.js") }}"></script>
  <!-- endinject -->
</body>

</html>
