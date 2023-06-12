<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="{{ url('home') }}" class="brand-link">

        <img src="{{ url('./assets/image/cdfLogo.png') }}" alt="Logo"
            class="brand-image img-circle elevation-3 bg-light"
            style="opacity: .8;border-radius:100px;width:35px;height:40px">
        <span class="brand-text font-weight-light">Bursary</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img class="img-circle elevation-2" alt="User Image" src="/assets/image/default_image.png">

            </div>
            <div class="info">
                <a href="{{ route('profile.show', encrypt(Auth::user()->id)) }}" class="d-block">
                    {{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="{{ request()->is(['admin/dashboard']) ? 'nav-item' : 'nav-item' }}">
                        <a href="{{ url('home') }}"
                            class="{{ request()->is(['admin/dashboard', 'staff/dashboard','home']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                   

                    @if (Auth::user()->roles->count() === 0)
                       
                        {{-- Bursary Application --}}
                        <li class="{{ request()->is(['user-bursary/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                            <a href="#" class="{{ request()->is(['user-bursary/*']) ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Bursary
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user.bursary.create.form') }}"
                                        class="{{ request()->is(['user-bursary/create', '']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-hand-holding"></i>
                                        <p>&nbsp Apply bursary</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.bursary.history', encrypt(Auth::user()->id)) }}"
                                        class="{{ request()->is(['user-bursary/history/*']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-history"></i>
                                        <p>&nbsp History</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        {{-- Bursary Application --}}

                        {{-- notifications --}}
                        <li class="nav-item">
                            <a href="{{ url('notifications') }}"
                                class="{{ request()->is(['notifications']) ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-bell"></i>
                                <p>
                                    Notifications
                                </p>
                            </a>
                        </li>
                        {{-- /notifications --}}

                    @endif
                </li>

                @canany(['approve bursary','reject bursary','view bursary','edit bursary','delete bursary'])

                    <li class="nav-header">APPLICATIONS</li>
                    {{-- Admin check bursary applications --}}
                    <li class="nav-item">
                        <a href="{{ url('bursary') }}"
                            class="{{ request()->is(['bursary','bursary/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-hand-holding"></i>
                            <p>
                                Bursary Applications
                            </p>
                        </a>
                    </li>
                    {{-- /Admin check bursary applications --}}

                    {{-- application status --}}
                    <li
                        class="{{ request()->is(['approved-applications', 'rejected-applications']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['approved-applications', 'rejected-applications']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-info-circle"></i>
                            <p>
                                Application Status
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('approved.applications') }}"
                                    class="{{ request()->is(['approved-applications']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-thumbs-up"></i>
                                    <p>&nbsp Approved Applications</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('rejected.applications') }}"
                                    class="{{ request()->is(['rejected-applications']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-thumbs-down"></i>
                                    <p>&nbsp Rejected Applications</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- application status --}}
                @endcanany

                @canany(['create user', 'view user','edit user', 'delete user', 'create staff','view staff','edit staff','delete staff','create role', 'view role','edit role','delete role','create permission','delete permission',])
                
                    <li class="nav-header">ADMINISTRATION</li>
                    
                    {{-- Permissions --}}
                    @can('create permission','delete permission')
                    <li
                        class="{{ request()->is(['admin/permission', 'admin/permission/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/permission', 'admin/permission/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                Permissions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('permission.index') }}"
                                    class="{{ request()->is(['admin/permission']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('permission.create') }}"
                                    class="{{ request()->is(['admin/permission/create']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-plus-circle"></i>
                                    <p>&nbsp Add</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    {{-- /Permissions --}}
                    
                    
                    {{-- Roles --}}
                    @can(['create role', 'view role','edit role','delete role'])
                    <li class="{{ request()->is(['admin/role', 'admin/role/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/role', 'admin/role/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('role.index') }}"
                                    class="{{ request()->is(['admin/role']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('role.create') }}"
                                    class="{{ request()->is(['admin/role/create']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-plus-circle"></i>
                                    <p>&nbsp Add</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    {{-- /Roles --}}

                    {{-- Staff --}}
                    @can(['create staff','view staff','edit staff','delete staff'])
                    <li
                        class="{{ request()->is(['admin/staff-users', 'admin/staff-users/*', 'admin/staff-user-edit/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/staff-users', 'admin/staff-users/*', 'admin/staff-user-edit/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Staffs
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('staff_users.list') }}"
                                    class="{{ request()->is(['admin/staff-users']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('admin/staff_users/create') }}"
                                    class="{{ request()->is(['admin/staff-users/create']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-plus-circle"></i>
                                    <p>&nbsp Add</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    {{-- /Staff --}}

                    {{-- Users --}}
                    @can(['create user', 'view user','edit user', 'delete user'])
                    <li class="{{ request()->is(['admin/user', 'admin/user/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/user', 'admin/user/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-user-secret"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="{{ request()->is(['admin/user']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="{{ request()->is(['admin/user/create']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-plus-circle"></i>
                                    <p>&nbsp Add</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    {{-- /Users --}}

                    {{-- System Settings --}}
                    @can(['create user', 'view user','edit user', 'delete user', 'create staff','view staff','edit staff','delete staff','create role', 'view role','edit role','delete role','create permission','delete permission',])
                    <li
                        class="{{ request()->is(['admin/system-settings', 'admin/system-settings/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/system-settings', 'admin/system-settings/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                System Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('system.settings') }}"
                                    class="{{ request()->is(['admin/system-settings']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    {{-- /System Settings --}}

                @endcanany   
                    

                </ul>
            </nav>
        </div>
        <!-- /.sidebar -->
    </aside>
