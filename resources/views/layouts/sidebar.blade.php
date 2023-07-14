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
                @if (Auth::check())
                    <a href="{{ route('profile.show', encrypt(Auth::user()->id)) }}" class="d-block">
                        {{ Auth::user()->name }}</a>
                @endif
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
                        class="{{ request()->is(['admin/dashboard', 'staff/dashboard', 'home', 'user-dashboard']) ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                    @if (Auth::check())
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
                                class="{{ request()->is(['user-bursary/apply', '']) ? 'nav-link active' : 'nav-link' }}">
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
                @endif
                </li>

                {{-- Applications --}}
                @if (Gate::check('manage bursary'))
                    <li class="nav-header">APPLICATIONS</li>
                    {{-- Admin check bursary applications --}}
                    <li class="nav-item">
                        <a href="{{ url('bursary') }}"
                            class="{{ request()->is(['bursary', 'bursary/*', 'admin/bursary/*']) ? 'nav-link active' : 'nav-link' }}">
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
                @endif
                {{-- ./Applications --}}

                {{-- Locations --}}

                @if (Gate::check('manage location'))
                    <li class="nav-header">LOCATIONS</li>

                    {{-- county --}}
                    <li
                        class="{{ request()->is(['admin/county', 'admin/county/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/county', 'admin/county/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Counties
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('county.index') }}"
                                    class="{{ request()->is(['admin/county']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('county.create') }}"
                                        class="{{ request()->is(['admin/county/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./county --}}

                    {{-- constituency --}}
                    <li
                        class="{{ request()->is(['admin/constituency', 'admin/county-constituency/create-multiple', 'admin/constituency/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/constituency', 'admin/county-constituency/create-multiple', 'admin/constituency/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Constituencies
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('constituency.index') }}"
                                    class="{{ request()->is(['admin/constituency']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('constituency.create') }}"
                                        class="{{ request()->is(['admin/constituency/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('constituency.create.multiple') }}"
                                        class="{{ request()->is(['admin/county-constituency/create-multiple']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add Multiple</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./constituent --}}

                    {{-- ward --}}
                    <li
                        class="{{ request()->is(['admin/ward', 'admin/county-ward/create-multiple', 'admin/ward/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/ward', 'admin/county-ward/create-multiple', 'admin/ward/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Wards
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('ward.index') }}"
                                    class="{{ request()->is(['admin/ward']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('ward.create') }}"
                                        class="{{ request()->is(['admin/ward/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('ward.create.multiple') }}"
                                        class="{{ request()->is(['admin/county-ward/create-multiple']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add Multiple</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./ward --}}

                    {{-- location --}}
                    <li
                        class="{{ request()->is(['admin/location', 'admin/locations/create-multiple', 'admin/location/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/location', 'admin/locations/create-multiple', 'admin/location/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Locations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('location.index') }}"
                                    class="{{ request()->is(['admin/location']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('location.create') }}"
                                        class="{{ request()->is(['admin/location/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('location.create.multiple') }}"
                                        class="{{ request()->is(['admin/locations/create-multiple']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add Multiple</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./location --}}

                    {{-- sub-location --}}
                    <li
                        class="{{ request()->is(['admin/sub-location', 'admin/sub-locations/create-multiple', 'admin/sub-location/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/sub-location', 'admin/sub-locations/create-multiple', 'admin/sub-location/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Sub-locations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('sub-location.index') }}"
                                    class="{{ request()->is(['admin/sub-location']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('sub-location.create') }}"
                                        class="{{ request()->is(['admin/sub-location/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('sub-location.create.multiple') }}"
                                        class="{{ request()->is(['admin/sub-locations/create-multiple']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add Multiple</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./sub-location --}}

                    {{-- polling stations --}}
                    <li
                        class="{{ request()->is(['admin/polling-station', 'admin/polling-stations/create-multiple', 'admin/polling-station/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                        <a href="#"
                            class="{{ request()->is(['admin/polling-station', 'admin/polling-stations/create-multiple', 'admin/polling-station/*']) ? 'nav-link active' : 'nav-link' }}">
                            <i class="nav-icon fas fa-map-marker"></i>
                            <p>
                                Polling-stations
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('polling-station.index') }}"
                                    class="{{ request()->is(['admin/polling-station']) ? 'nav-link active' : 'nav-link' }}">
                                    &nbsp
                                    <i class="fas fa-list"></i>
                                    <p>&nbsp List</p>
                                </a>
                            </li>
                            @can('create location')
                                <li class="nav-item">
                                    <a href="{{ route('polling-station.create') }}"
                                        class="{{ request()->is(['admin/polling-station/create']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('polling-station.create.multiple') }}"
                                        class="{{ request()->is(['admin/polling-stations/create-multiple']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-plus-circle"></i>
                                        <p>&nbsp Add Multiple</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                    {{-- ./polling stations --}}
                @endif

                {{-- ./Locations --}}

                @if (Gate::check('manage user') ||
                        Gate::check('manage staff') ||
                        Gate::check('manage role') ||
                        Gate::check('manage permission') ||
                        Gate::check('manage application period') ||
                        Gate::check('manage system setting'))

                    <li class="nav-header">ADMINISTRATION</li>


                    {{-- Permissions --}}
                    {{-- @if (Gate::check('manage permission'))
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
                                @can('create permission')
                                    <li class="nav-item">
                                        <a href="{{ route('permission.create') }}"
                                            class="{{ request()->is(['admin/permission/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif --}}
                    {{-- /Permissions --}}


                    {{-- Roles --}}
                    @if (Gate::check('manage role'))
                        <li
                            class="{{ request()->is(['admin/role', 'admin/role/*']) ? 'nav-item menu-open' : 'nav-item' }}">
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
                                @can('create role')
                                    <li class="nav-item">
                                        <a href="{{ route('role.create') }}"
                                            class="{{ request()->is(['admin/role/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                    {{-- /Roles --}}


                    {{-- Staff --}}
                    @if (Gate::check('manage staff'))
                        <li
                            class="{{ request()->is(['admin/staff-users', 'admin/staff-users/*', 'admin/staff-user-edit/*', 'admin/staff-user-view-approved-tasks/*', 'admin/staff-user-view-rejected-tasks/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                            <a href="#"
                                class="{{ request()->is(['admin/staff-users', 'admin/staff-users/*', 'admin/staff-user-edit/*', 'admin/staff-user-view-approved-tasks/*', 'admin/staff-user-view-rejected-tasks/*']) ? 'nav-link active' : 'nav-link' }}">
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
                                @can('create staff')
                                    <li class="nav-item">
                                        <a href="{{ route('admin/staff_users/create') }}"
                                            class="{{ request()->is(['admin/staff-users/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                    {{-- /Staff --}}


                    {{-- Users --}}
                    @if (Gate::check('manage user'))
                        <li
                            class="{{ request()->is(['admin/user', 'admin/user/*']) ? 'nav-item menu-open' : 'nav-item' }}">
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
                                @can('create user')
                                    <li class="nav-item">
                                        <a href="{{ route('user.create') }}"
                                            class="{{ request()->is(['admin/user/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                    {{-- /Users --}}

                    {{-- Application Period --}}
                    @if (Gate::check('manage application period'))
                        <li
                            class="{{ request()->is(['admin/application-period', 'admin/application-period/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                            <a href="#"
                                class="{{ request()->is(['admin/application-period', 'admin/application-period/*']) ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Application Period
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('application-period.index') }}"
                                        class="{{ request()->is(['admin/application-period']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-list"></i>
                                        <p>&nbsp List</p>
                                    </a>
                                </li>
                                @can('create application period')
                                    <li class="nav-item">
                                        <a href="{{ route('application-period.create') }}"
                                            class="{{ request()->is(['admin/application-period/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                    {{-- /Application Period --}}

                    {{-- System Settings --}}
                    @if (Gate::check('manage system setting'))
                        <li
                            class="{{ request()->is(['admin/system-setting', 'admin/system-setting/*']) ? 'nav-item menu-open' : 'nav-item' }}">
                            <a href="#"
                                class="{{ request()->is(['admin/system-setting', 'admin/system-setting/*']) ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    System Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>


                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('system-setting.index') }}"
                                        class="{{ request()->is(['admin/system-setting']) ? 'nav-link active' : 'nav-link' }}">
                                        &nbsp
                                        <i class="fas fa-list"></i>
                                        <p>&nbsp List</p>
                                    </a>
                                </li>
                                @can('create system setting')
                                    <li class="nav-item">
                                        <a href="{{ route('system-setting.create') }}"
                                            class="{{ request()->is(['admin/system-setting/create']) ? 'nav-link active' : 'nav-link' }}">
                                            &nbsp
                                            <i class="fas fa-plus-circle"></i>
                                            <p>&nbsp Add</p>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                    {{-- /System Settings --}}
                @endif

            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
