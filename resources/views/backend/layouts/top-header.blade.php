@section('top-header')
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{route('dashboard')}}" class="logo d-flex align-items-center">
                <span class="d-none d-lg-block">
                    {{ucfirst(auth()->user()->account_type->name)}} - Dashboard
                </span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="col-md-5 d-flex justify-content-between">
            <a href="{{route('index')}}" target="_blank" class="btn btn-sm" style="margin-left: 80px;">Visit Website</a>

        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        @if(Auth::user()->image)
                            <img src="{{url(Auth::user()->image)}}" alt="Profile" class="rounded-circle">
                        @else
                            <img src="{{url('icons/user.png')}}" alt="Profile" class="rounded-circle">
                        @endif
                        <span class="d-none d-md-block dropdown-toggle ps-2">
                            {{ Auth::user()->name}}
                        </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>Account Role</h6>
                            <span>
                                @foreach(Auth::user()->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{route('user-profile')}}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center"
                               href="{{route('update-profile')}}">
                                <i class="bi bi-pencil-square"></i>
                                <span>Update Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{route('change-password')}}">
                                <i class="bi bi-lock-fill"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Sign Out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>

    </header>
@endsection

@section('scripts')


@endsection