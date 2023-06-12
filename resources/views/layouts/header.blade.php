<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
       
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="avatar avatar-sm avatar-circle">
                    <img class="avatar-img" src="/assets/image/default_image.png" alt="Image Description"
                        style="width:30px;height:30px;border-radius:100px">
                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                </div>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media align-items-center">
                        <div class="avatar avatar-sm avatar-circle mr-2">
                            <img class="avatar-img" src="/assets/image/default_image.png" alt="Image Description"
                                style="width:30px;height:30px;border-radius:100px">
                        </div>
                        <div class="media-body">
                            <span class="card-text">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <p>My Settings</p>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <p>Create Users</p>
                </a>
                <div class="dropdown-divider"></div>

                <div class="row p-2">
                    <div class="col-md-4">
                        <p>
                        <a class='h5' href="{{route('profile.show',encrypt(Auth::user()->id))}}" class="d-block"> Profile</a>
                        </p>
                        

                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <p style="float:right">
                            <!-- Authentication Links -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <input type="submit" style="border:unset;" value="Sign Out">
                        </form>
                        </p>

                    </div>
                </div>

            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

    </ul>
</nav>
<!-- /.navbar -->