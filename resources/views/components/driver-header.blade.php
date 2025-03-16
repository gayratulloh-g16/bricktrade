  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center">
            <img src="/admin/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Standart Brick</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">
                @php
                    use Illuminate\Support\Facades\Auth;
                    $driverNotifications = Auth::user()->unreadNotifications()->latest()->limit(5)->get();
                @endphp
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">{{ $driverNotifications->count() }}</span>
                </a><!-- End Notification Icon -->
            
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have {{ $driverNotifications->count() }} unread notifications
                    </li>
                    <li><hr class="dropdown-divider"></li>
            
                    @foreach ($driverNotifications as $notification)
                        <a href="{{ route('driver.orders.show', $notification->data['order_id']) }}">
                            <li class="notification-item">
                                <i class="bi bi-truck text-success"></i>
                                <div>
                                    <h4>{{ $notification->data['message'] }}</h4>
                                    <p>{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                                </div>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        </a>
                    @endforeach
                </ul>
            </li>
            
            



            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('/admin/assets/img/profile-img.jpg') }}"
                        alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->first_name }}
                        {{ auth()->user()->last_name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a href="{{ route('driver.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('driver.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
