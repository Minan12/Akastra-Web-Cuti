<div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
            <ul class="navbar-nav mr-3">
                <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
            </ul>
        </form>
        <ul class="navbar-nav navbar-right">
            <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @auth
                <div class="d-sm-none d-lg-inline-block">Hi,{{ auth()->user()->name }}</div></a>
                <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger w-50 ml-4 dropdown-item text-white font-weight-bold d-sm-inline align-text-bottom">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </form>
                </div>
                @endauth
            </li>
        </ul>
    </nav>
