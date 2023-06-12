<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="#" class="brand-link">

        <img src="{{ url('./assets/image/cdfLogo.png') }}" alt="Logo"
            class="brand-image img-circle elevation-3 bg-light"
            style="opacity: .8;border-radius:100px;width:35px;height:40px">
        <span class="brand-text font-weight-light">Bursary management system</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" alt="User Image" src="/assets/image/default_image.png">

            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                @hasrole('SchoolRole')
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Check Roles
                            </p>
                        </a>
                    </li>
                @endhasrole

                @if (Auth::user()->user_type == 0)
                    <li class="nav-item menu-open">
                        <a href="{{ url('home') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Apply Bursary
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-bell"></i>
                            <p>
                                Notifications
                            </p>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->user_type == 1)
                    <li class="{{ request()->is(['admin/dashboard']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="{{ url('admin/dashboard') }}"
                            class="{{ request()->is(['admin/dashboard', 'home']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>

                    <li class="nav-header">ADMINISTRATION</li>


                    <li class="nav-item">
                    <li
                        class="{{ request()->is(['admin/role', 'admin/permission', 'admin/user', 'admin/role/*', 'admin/permission/*', 'admin/user/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/role', 'admin/permission', 'admin/user', 'admin/role/*', 'admin/permission/*', 'admin/user/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="{{ request()->is(['admin/role', 'admin/role/*']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-tasks"></i>
                                    <p>&nbsp Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}"
                                    class="{{ request()->is(['admin/permission', 'admin/permission/*']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-lock"></i>
                                    <p>&nbsp Permissions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="{{ request()->is(['admin/user', 'admin/user/*']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-users"></i>
                                    <p>&nbsp Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Application Status
                            </p>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->user_type == 2)
                    <li class="nav-item menu-open">
                        <a href="{{ url('staff/dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Staff
                            </p>
                        </a>
                    </li>
                @endif


                @if (Auth::user()->user_type == 3)
                    <li class="nav-item menu-open">
                        <a href="{{ url('school/dashboard') }}" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                School
                            </p>
                        </a>
                    </li>
                @endif

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
