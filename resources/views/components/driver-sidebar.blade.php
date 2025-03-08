  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-heading">Dashboard</li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('driver.dashboard') ? 'active' : '' }}"
                href="{{ route('driver.dashboard') }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('driver.orders.*') ? 'active' : '' }}"
                href="{{ route('driver.orders.index') }}">
                <i class="bi bi-cart"></i>
                <span>Order</span>
            </a>
        </li>
        <!-- Pages Heading -->
        {{-- <li class="nav-heading">Pages</li> --}}

    </ul>

</aside><!-- End Sidebar-->
