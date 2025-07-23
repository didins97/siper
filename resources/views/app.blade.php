<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Punggawa - Printing</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets') }}/css/sb-admin-2.min.css" rel="stylesheet">

    @yield('css')

</head>

<body id="page-top"
    {{ Request::segment(2) == 'jobs' && auth()->user()->role == 'operator' ? 'class="sidebar-toggled' : '' }}>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion {{ Request::segment(2) == 'jobs' && auth()->user()->role == 'operator' ? 'toggled' : '' }}"
            id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PD <sup>Printing</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link"
                    href="
                    @switch(auth()->user()->role)
                        @case('admin')
                            {{ route('admin.dashboard') }}
                            @break
                        @case('user')
                            {{ route('user.dashboard') }}
                            @break
                        @case('operator')
                            {{ route('operator.dashboard') }}
                            @break
                        @default

                    @endswitch
                ">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            @if (auth()->user()->role == 'admin')
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Master Data
                </div>

                <!-- Nav Item - Charts -->
                <li class="nav-item {{ Request::segment(2) == 'users' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>User</span></a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'user')
                <!-- Nav Item - Tables -->
                <li
                    class="nav-item {{ Request::segment(2) == 'products' || Request::segment(2) == 'items' ? 'active' : '' }}">
                    <a class="nav-link"
                        href=" {{ auth()->user()->role == 'admin' ? route('products.index') : route('user.items.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Item</span></a>
                </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Manage
            </div>

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'user')
                <li
                    class="nav-item {{ Request::segment(2) == 'orders' || Request::segment(2) == 'choose-items' ? 'active' : '' }}">
                    <a class="nav-link"
                        href="{{ auth()->user()->role == 'admin' ? route('admin.orders.index') : route('user.orders.index') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Pemesanan</span></a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'operator')
                <!-- Nav Item - Tables -->
                <li class="nav-item {{ Request::segment(2) == 'jobs' ? 'active' : '' }}">
                    <a class="nav-link"
                        href="{{ auth()->user()->role == 'admin' ? route('admin.jobs.index') : route('operator.jobs.index') }}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Manajemen Cetak</span></a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
                <!-- Heading -->
                <div class="sidebar-heading">
                    Laporan
                </div>

                <li class="nav-item {{ Request::segment(2) == 'reports' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.reports.index') }}">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Laporan</span></a>
                </li>
            @endif

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Title -->
                    <h5 class="text-secondary ml-3" style="font-weight: bold">Percetakan Punggawa Digital Printing</h5>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Notifikasi -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                                @if ($unreadCount > 0)
                                    <span class="badge badge-danger badge-counter">{{ $unreadCount }}</span>
                                @endif
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">Notifikasi</h6>

                                @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('notifications.read', $notification->id) }}">
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i class="fas fa-file-alt text-white"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                {{ $notification->created_at->diffForHumans() }}</div>
                                            <span class="font-weight-bold">{{ $notification->data['message'] }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <span class="dropdown-item text-center text-muted">Tidak ada notifikasi baru</span>
                                @endforelse

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-center text-primary small"
                                    href="{{ route('notifications.readAll') }}">
                                    Tandai semua telah dibaca
                                </a>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets') }}/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    @yield('content')

                    @yield('modal')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets') }}/js/sb-admin-2.min.js"></script>

    @stack('scripts')

</body>

</html>
