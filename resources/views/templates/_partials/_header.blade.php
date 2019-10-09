<header class="navbar navbar-header navbar-header-fixed">
    <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
    <div class="navbar-brand">
        <a href="{{ route('admin.dashboard') }}" class="df-logo">pemi<span>los</span></a>
    </div><!-- navbar-brand -->
    @auth
        <div id="navbarMenu" class="navbar-menu-wrapper">
            <div class="navbar-menu-header">
                <a href="{{ route('admin.dashboard') }}" class="df-logo">pemi<span>los</span></a>
                <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
            </div><!-- navbar-menu-header -->
            <ul class="nav navbar-menu">
                <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Menu</li>
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link"><i data-feather="home"></i> Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('admin.candidate.index') }}" class="nav-link"><i data-feather="user"></i> Kandidat</a></li>
                <li class="nav-item"><a href="{{ route('admin.calculation.index') }}" class="nav-link"><i data-feather="bar-chart-2"></i> Kalkulasi</a></li>
                <li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link"><i data-feather="users"></i> User</a></li>
                {{-- <li class="nav-item with-sub">
                    <a href="javascript:void(0)" class="nav-link"><i data-feather="user-check"></i> Profile</a>
                    <div class="navbar-menu-sub">
                        <div class="d-lg-flex">
                        <ul>
                            <li class="nav-sub-item"><a href="{{ route('profile.index') }}" class="nav-sub-link"><i data-feather="user"></i> Edit Profile</a></li>
                            <li class="nav-sub-item"><a href="{{ route('profile.edit.password') }}" class="nav-sub-link"><i data-feather="lock"></i> Edit Kata Sandi</a></li>
                        </ul>
                        </div>
                    </div><!-- nav-sub -->
                </li> --}}
                {{-- <li class="nav-item"><a href="{{ route('setting.index') }}" class="nav-link"><i data-feather="box"></i> Pengaturan</a></li> --}}
            </ul>
        </div><!-- navbar-menu-wrapper -->
        <div class="navbar-right">
            <div class="dropdown dropdown-profile">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                    <div class="avatar avatar-sm"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                </a><!-- dropdown-link -->
                <div class="dropdown-menu dropdown-menu-right tx-13">
                    <div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                    <h6 class="tx-semibold mg-b-5">{{ auth()->user()->name }}</h6>
                    <p class="mg-b-25 tx-12 tx-color-03">{{ auth()->user()->roles[0]->guard_name }}</p>

                    {{-- <a href="{{ route('profile.index') }}" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
                    <a href="{{ route('profile.edit.password') }}" class="dropdown-item"><i data-feather="user"></i> Edit Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('setting.index') }}" class="dropdown-item"><i data-feather="settings"></i>Pengaturan</a> --}}
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i data-feather="log-out"></i>Keluar</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </div><!-- navbar-right -->
    @endauth
  </header><!-- navbar -->
