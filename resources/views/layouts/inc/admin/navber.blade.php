 <!-- partial:partials/_navbar.html -->
 <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
     <div class="navbar-brand-wrapper d-flex justify-content-center">
         <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
             <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}">
                 <img src="{{ asset('theme/images/logo.png') }}" alt="logo" />
                 {{-- TEchMion --}}
             </a>
             <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}"><img
                     src="{{ asset('theme/images/logo.png') }}" alt="logo" /></a>
             <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                 <span class="mdi mdi-sort-variant"></span>
             </button>
         </div>
     </div>
     <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
         {{-- <ul class="navbar-nav mr-lg-4 w-100">
             <li class="nav-item nav-search d-none d-lg-block w-100">
                 <form action="{{ url('admin/search') }}" method="GET">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="search">
                                 <button type="submit" class="btn mdi mdi-magnify"></button>
                             </span>
                         </div>
                         <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                             aria-describedby="search" name="search" value="{{ session('lastSearch') }}"
                             autocomplete="off" data-toggle="modal" data-target="#searchHistoryModal">

                         <div class="input-group-append">
                             <button type="submit" class="btn mdi mdi-account-search"></button>
                         </div>
                     </div>
                 </form>

                 @if (session()->has('searchHistory'))
                     <div class="modal fade" id="searchHistoryModal" tabindex="-1" role="dialog"
                         aria-labelledby="searchHistoryModalLabel" aria-hidden="true" data-backdrop="false">
                         <div class="modal-dialog" role="document">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h5 class="modal-title" id="searchHistoryModalLabel">Search History</h5>
                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                     </button>
                                 </div>
                                 <div class="modal-body">
                                     <ul class="list-group">
                                         @foreach (session('searchHistory') as $search)
                                             <li class="list-group-item"
                                                 onclick="document.querySelector('input[name=search]').value='{{ $search }}';">
                                                 {{ $search }}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endif
             </li>
         </ul> --}}
         <ul class="navbar-nav mr-lg-4 w-100">
             <li class="nav-item nav-search d-none d-lg-block w-100">
                 <form action="{{ url('admin/search') }}" method="GET">
                     <div class="input-group">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="search">
                                 <button type="submit" class="btn mdi mdi-magnify"></button>
                             </span>
                         </div>
                         <input type="text" class="form-control" placeholder="Search now" aria-label="search"
                             aria-describedby="search" name="search" value="{{ session('lastSearch') }}"
                             autocomplete="off">

                         <div class="input-group-append">
                             <button type="submit" class="btn mdi mdi-account-search"></button>
                         </div>
                     </div>
                 </form>
             </li>
         </ul>
         <ul class="navbar-nav navbar-nav-right">
             <li class="nav-item nav-profile dropdown">
                 <a class="nav-link dropdown-toggle" id="searchhistoryDropdown" href="#"
                     data-bs-toggle="dropdown">
                     <span class="nav-profile-name">Search History</span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="searchhistoryDropdown">
                     @if (session()->has('searchHistory'))
                         @foreach (session('searchHistory') as $search)
                             <a class="dropdown-item" href="{{ url('admin/search') }}?search={{ $search }}">
                                 {{ $search }}
                             </a>
                         @endforeach
                     @else
                         <a class="dropdown-item" href="#">No search history available</a>
                     @endif
                 </div>
             </li>
         </ul>



         <ul class="navbar-nav navbar-nav-right">
             <li class="nav-item dropdown me-4">
                 <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center notification-dropdown"
                     id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                     <i class="mdi mdi-bell mx-0"></i>
                     @if (count(session('notifications', [])) > 0)
                         <span class="count"></span>
                     @endif
                 </a>

                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="notificationDropdown">
                     <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                     @forelse(session('notifications', []) as $notification)
                         <a class="dropdown-item">
                             <div class="item-thumbnail">
                                 <div class="item-icon bg-success">
                                     <i class="mdi mdi-information mx-0"></i>
                                 </div>
                             </div>
                             <div class="item-content">
                                 <h6 class="font-weight-normal">{{ $notification['message'] ?? '' }}</h6>

                                 <p class="font-weight-light small-text mb-0 text-muted">
                                     {{ $notification['time'] ?? '' }}
                                 </p>
                             </div>
                         </a>
                     @empty
                         <p class="dropdown-item mb-0">No new notifications</p>
                     @endforelse
                 </div>


             </li>
             <li class="nav-item nav-profile dropdown">
                 <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                     <img src="{{ asset('admin/images/faces/face5.jpg ') }}" alt="profile" />
                     <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                     @if (Route::has('password.request'))
                         <a class="dropdown-item"href="{{ route('password.request') }}">
                             <i class="mdi mdi-settings text-primary"></i>
                             {{ __('Forgot Your Password?') }}
                         </a>
                     @endif

                     <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                         <i class="mdi mdi-logout text-primary"></i>
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                 </div>
             </li>
         </ul>
         <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
             data-toggle="offcanvas">
             <span class="mdi mdi-menu"></span>
         </button>
     </div>
 </nav>
