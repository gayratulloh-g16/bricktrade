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
                      $newOrders = \App\Models\Order::where('order_status', 'new')
                          ->orderBy('created_at', 'desc')
                          ->get();
                  @endphp
                  <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                      <i class="bi bi-bell"></i>
                      <span class="badge bg-primary badge-number">{{ Auth::user()->unreadNotifications()->count() + $newOrders->count() }} </span>
                  </a><!-- End Notification Icon -->

                  

                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header d-flex justify-content-between align-items-center">
                        
                        <span>You have {{ Auth::user()->unreadNotifications()->count() + $newOrders->count() }} new notifications</span>
                        <a href="#" class="text-primary small" onclick="markAllAsRead()">Mark all as read</a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                
                    {{-- New Comments --}}
                    @foreach (Auth::user()->unreadNotifications as $notification)
                        <li class="notification-item d-flex align-items-center">
                            <i class="bi bi-chat-dots text-success fs-4 me-2"></i>
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.comments.show', $notification->data['comment_id']) }}"
                                   class="d-block text-dark fw-bold"
                                   onclick="markAsRead('{{ $notification->id }}')">
                                    New Comment for {{ $notification->data['blog_id'] }} blog
                                </a>
                                <small class="text-muted d-block">{{ Str::limit($notification->data['comment_text'], 50) }}</small>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endforeach
                
                    {{-- New Orders --}}
                    @foreach ($newOrders as $order)
                        <li class="notification-item d-flex align-items-center">
                            <i class="bi bi-info-circle text-primary fs-4 me-2"></i>
                            <div class="flex-grow-1">
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="d-block text-dark fw-bold">
                                    New Order #{{ $order->id }}
                                </a>
                                <small class="text-muted d-block">Shipping: {{ $order->shipping_address }}</small>
                                <small class="text-muted">{{ $order->created_at->diffForHumans() }}</small>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endforeach
                
                    @if(Auth::user()->unreadNotifications->isEmpty() && $newOrders->isEmpty())
                        <li class="text-center text-muted py-2">No new notifications</li>
                    @endif
                </ul>
                

              </li><!-- End Notification Nav -->



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
                          <a href="{{ route('admin.logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                              class="dropdown-item d-flex align-items-center">
                              <i class="bi bi-box-arrow-right"></i>
                              <span>Sign Out</span>
                          </a>
                          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                              style="display: none;">
                              @csrf
                          </form>
                      </li>
                  </ul><!-- End Profile Dropdown Items -->
              </li><!-- End Profile Nav -->

          </ul>
      </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
