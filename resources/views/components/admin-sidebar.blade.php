  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <!-- Dashboard -->
          <li class="nav-heading">Dashboard</li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                  href="{{ route('admin.dashboard') }}">
                  <i class="bi bi-speedometer2"></i>
                  <span>Dashboard</span>
              </a>
          </li>

          <!-- Resources -->
          <li class="nav-heading">Resources</li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                  href="{{ route('admin.users.index') }}">
                  <i class="bi bi-people-fill"></i>
                  <span>Users</span>
              </a>
          </li>


          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                  href="{{ route('admin.categories.index') }}">
                  <i class="bi bi-folder"></i>
                  <span>Category</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                  href="{{ route('admin.blogs.index') }}">
                  <i class="bi bi-journal-text"></i>
                  <span>Blog</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}"
                  href="{{ route('admin.contacts.index') }}">
                  <i class="bi bi-telephone"></i>
                  <span>Contact</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.contact-info.*') ? 'active' : '' }}"
                  href="{{ route('admin.contact-info.index') }}">
                  <i class="bi bi-info-circle"></i>
                  <span>Contact Information</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}"
                  href="{{ route('admin.drivers.index') }}">
                  <i class="bi bi-truck"></i>
                  <span>Driver</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.partner-logos.*') ? 'active' : '' }}"
                  href="{{ route('admin.partner-logos.index') }}">
                  <i class="bi bi-building"></i>
                  <span>Partner Logo</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.comments.*') ? 'active' : '' }}"
                  href="{{ route('admin.comments.index') }}">
                  <i class="bi bi-chat"></i>
                  <span>Comment</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.bricks.*') ? 'active' : '' }}"
                  href="{{ route('admin.bricks.index') }}">
                  <i class="bi bi-box-seam"></i>
                  <span>Brick</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                  href="{{ route('admin.orders.index') }}">
                  <i class="bi bi-cart"></i>
                  <span>Order</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.feedback.*') ? 'active' : '' }}"
                  href="{{ route('admin.feedback.index') }}">
                  <i class="bi bi-chat-square-text"></i>
                  <span>Feedback</span>
              </a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}"
                  href="{{ route('admin.reviews.index') }}">
                  <i class="bi bi-star"></i>
                  <span>Review</span>
              </a>
          </li>

          <!-- Pages Heading -->
          {{-- <li class="nav-heading">Pages</li> --}}


      </ul>

  </aside><!-- End Sidebar-->
