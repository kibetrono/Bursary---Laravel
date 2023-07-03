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
                        style="width:30px;height:30px;border-radius:100px"> &nbsp;
                    <span class="card-text">
                        @if(Auth::check())
                        {{ Auth::user()->name }}
                        @endif
                    </span>
                </div>

            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <div class="media align-items-center">
                        <div class="avatar avatar-sm avatar-circle mr-2">


                        </div>
                        <div class="media-body text-center">
                            <img class="avatar-img" src="/assets/image/default_image.png" alt="Image Description"
                                style="width:90px;height:90px;border-radius:100px">
                            <p>
                                @if(Auth::check())
                                Joined: {{ Auth::user()->created_at->format('Y-m-d') }} 
                                @endif
                            </p>
                        </div>
                    </div>
                </a>

                <div class="dropdown-divider"></div>
                <div class="row p-2">
                    <div class="col-md-4 user_btns">
                        <p>
                            @if(Auth::check())
                            <a class='profile_btn btn-sm btn btn-secondary bg-transparent text-dark'
                                href="{{ route('profile.show', encrypt(Auth::user()->id)) }}" class="d-block">
                                Profile</a>
                            @endif
                        </p>

                    </div>
                    <div class="col-md-4 user_btns"></div>
                    <div class="col-md-4 user_btns">
                        <p>
                    @if(Auth::check())

                            <!-- Authentication Links -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="profile_btn btn-sm btn btn-secondary bg-transparent text-dark">Sign
                                out</button>
                            {{-- <input type="submit" style="border:unset;" value="Sign Out"> --}}
                        </form>
                        </p>
                    @endif

                    </div>
                </div>
                <div class="dropdown-divider "></div>

            </div>
        </li>


    </ul>
</nav>
<!-- /.navbar -->
