<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        {{ $title ?? 'User | Kyroshopu' }}
    </title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/stars-rating.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/plugins/jquery-3.7.0.min.js') }}"></script>
    <link href="{{ asset('assets/css/lightbox.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/plugins/lightbox.min.js') }}"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">


    @guest
    @include('layouts.navbars.guest.navbar')
    @yield('content')
    @endguest

    @auth
    @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
    @yield('content')
    @else
    @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    @endif
    @include('layouts.navbars.guest.navbar')
    <main class="main-content border-radius-lg">
        <div class="container-fluid my-5 py-2 position-sticky">
            <div class="row mb-5">
                <div class="col-lg-3">
                    <div class="card position-sticky top-1 mt-6">
                        <ul class="nav flex-column bg-white border-radius-lg p-3">
                            <li class="nav-item">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{ route('user.profile') }}">
                                    <i class="ni ni-spaceship me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#basic-info">
                                    <i class="ni ni-books me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Basic Info</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{ route('user.address') }}">
                                    <i class="ni ni-atom me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">My Address</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{ route('user.transaction') }}">
                                    <i class="ni ni-ui-04 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Transactions</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="{{ route('user.store.open') }}">
                                    <i class="ni ni-badge me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">My Store</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#notifications">
                                    <i class="ni ni-bell-55 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Notifications</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#sessions">
                                    <i class="ni ni-watch-time me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Sessions</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-body d-flex align-items-center" data-scroll="" href="#delete">
                                    <i class="ni ni-settings-gear-65 me-2 text-dark opacity-6"></i>
                                    <span class="text-sm">Delete Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-lg-0 mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
    @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js') }}"></script>
    @stack('js');
</body>

</html>