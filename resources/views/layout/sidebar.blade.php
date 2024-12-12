        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header">
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="bi bi-list"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="bi bi-list"></i>
                    </button>

                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ Route::is('kontak.masuk') ? 'active' : '' }}">
                            <a href="{{ route('kontak.masuk') }}" class="collapsed" aria-expanded="false">
                                <i class="bi bi-inbox"></i>
                                <p>Kotak Masuk</p>
                            </a>
                        </li>
                        {{-- <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li> --}}
                        <li class="nav-item {{ Route::is('statistik') ? 'active' : '' }}">
                            <a href="{{ route('statistik') }}" class="collapsed" aria-expanded="false">
                                <i class="bi bi-bar-chart-fill"></i>
                                <p>Statistik</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="bi bi-list"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="bi bi-list"></i>
                    </button>

                    <!-- Logo Header -->
                    <div class="logo-header">
                        <a href="{{ route('kontak.masuk') }}" class="logo">
                            <img src="{{ url('assets/img/logo-infidea.png') }}" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a>
                    </div>
                    <!-- End Logo Header -->
                </div>

                {{-- NAVBAR --}}
                @include('layout.navbar')
            </div>
