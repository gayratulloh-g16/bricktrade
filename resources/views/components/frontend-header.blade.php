<?php
use App\Models\ContactInfo;

$contact = ContactInfo::first();
?>
<!-- Header Style One / Three -->
<header class="main-header header-style-three">
    <!-- Header Top Three -->
    <div class="header-top-three">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <!-- Top Left -->
                <div class="top-left clearfix">
                    <div class="button-box">
                        <a class="theme-btn contact-btn" href="contact.html">{{ __('main.brick_trade') }}</a>
                    </div>
                    <div class="text">{{ __('main.welcome_message') }}</div>
                </div>
                <!-- Top Right -->
                <div class="top-right pull-right clearfix d-flex align-items-center justify-content-between">
                    <!-- User name with dropdown -->
                    @if (Auth::check())
                        <div class="dropdown">
                            <p class="mb-0" id="userDropdown">
                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                <i class="fas fa-chevron-down ms-2"></i>
                            </p>
                            <ul class="dropdown-menu" id="dropdownMenu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('frontend.profile')}}">
                                        <i class="fas fa-user me-2"></i>
                                        <span>{{ __('main.profile') }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders') }}">
                                        <i class="fas fa-box-open me-2"></i>
                                        <span>{{ __('main.orders') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endif
                    <ul class="social-box d-flex mb-0">
                        <li class="me-3">
                            <a href="https://www.facebook.com/" class="fab fa-facebook-f fa-2x"></a>
                        </li>
                        <li class="me-3">
                            <a href="https://www.twitter.com/" class="fab fa-twitter fa-2x"></a>
                        </li>
                        <li class="me-3">
                            <a href="https://www.linkedin.com/" class="fab fa-linkedin fa-2x"></a>
                        </li>
                        <li>
                            <a href="https://youtube.com/" class="fab fa-youtube fa-2x"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Three -->

    <!-- Header Upper -->
    <div class="header-upper">
        <div class="auto-container">
            <div class="clearfix">
                <div class="pull-left logo-box">
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="/frontend/assets/images/logo-2.png" alt=""
                                title="" /></a>
                    </div>
                </div>

                <div class="nav-outer clearfix">
                    <!-- Mobile Navigation Toggler -->
                    <div class="mobile-nav-toggler">
                        <span class="icon flaticon-menu"></span>
                    </div>
                    <!-- Main Menu -->
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <!-- Toggle Button -->
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                            <ul class="navigation clearfix">
                                <li><a href="{{ route('home') }}"><span>{{ __('main.home') }}</span></a></li>
                                <li><a href="{{ route('about') }}"><span>{{ __('main.about') }}</span></a></li>
                                <li><a href="{{ route('shop') }}"><span>{{ __('main.shop') }}</span></a></li>
                                <li><a href="{{ route('blog') }}"><span>{{ __('main.blog') }}</span></a></li>
                                <li><a href="{{ route('contact') }}"><span>{{ __('main.contact') }}</span></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        {{ strtoupper(app()->getLocale()) }}
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/en') }}">{{ __('main.english') }}</a></li>
                                        <li><a href="{{ url('/ru') }}">{{ __('main.russian') }}</a></li>
                                        <li><a href="{{ url('/uz') }}">{{ __('main.uzbek') }}</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- Main Menu End-->

                    <div class="outer-box d-flex align-items-center justify-content-end gap-3">
                        <!-- Cart Box -->
                        <div class="cart-box">
                            <div class="dropdown">
                                <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="flaticon-shopping-bag-1"></span>
                                    @php
                                        $cart = session('cart', []);
                                        $count = collect($cart)->sum('quantity');
                                    @endphp
                                    <span class="total-cart" id="cartCount">{{ $count }}</span>
                                </button>
                                <div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu3"
                                    id="cartPanel">
                                    <!-- Cart items will be rendered here -->
                                    {!! view('partials.cart', ['cart' => session('cart', [])])->render() !!}
                                </div>
                            </div>
                        </div>

                        <!-- User Authentication Check -->
                        @if (Auth::check())
                            <form method="POST" action="{{ route('frontend.logout') }}"
                                class="d-flex align-items-center">
                                @csrf
                                <button type="submit" class="btn d-flex align-items-center"
                                    style="margin-left: 10px; background-color: transparent; border: none; padding: 0;">
                                    <i class="fas fa-sign-out-alt fa-2x me-2" style="color: white;"></i>
                                </button>
                            </form>
                        @else
                            <!-- Login Button -->
                            <a href="{{ route('frontend.login') }}" class="btn d-flex align-items-center"
                                style="margin-left: 10px;">
                                <i class="fas fa-user fa-2x me-2" style="color: white;"></i>
                            </a>
                        @endif
                    </div>
                    <!-- Upper Right -->
                    <div class="upper-info pull-right clearfix">
                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box">
                                <span class="flaticon-telephone"></span>
                            </div>
                            <ul>
                                <li>
                                    {{ __('main.call_us') }}<br />
                                    <a href="tel:{{ $contact->phone_number }}">{{ $contact->phone_number }}</a>
                                </li>
                            </ul>
                        </div>

                        <!--Info Box-->
                        <div class="upper-column info-box">
                            <div class="icon-box">
                                <span class="flaticon-email"></span>
                            </div>
                            <ul>
                                <li>
                                    {{ __('main.email_us') }}<br />
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!-- Sticky Header  -->
    <div class="sticky-header">
        <div class="auto-container clearfix">
            <!--Logo-->
            <div class="logo pull-left">
                <a href="index.html" title=""><img src="/frontend/assets/images/logo-small.png" alt=""
                        title="" /></a>
            </div>
            <!--Right Col-->
            <div class="pull-right">
                <!-- Main Menu -->
                <nav class="main-menu">
                    <!--Keep This Empty / Menu will come through Javascript-->
                </nav>
                <!-- Main Menu End-->

                <div class="outer-box d-flex align-items-center">
                    <!-- Cart Box -->
                    <div class="cart-box me-3">
                        <div class="dropdown">
                            <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="flaticon-shopping-bag-1"></span>
                                @php
                                    $cart = session('cart', []);
                                    $count = collect($cart)->sum('quantity');
                                @endphp
                                <span class="total-cart" id="cartCount">{{ $count }}</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right cart-panel" aria-labelledby="dropdownMenu"
                                id="cartPanel">
                                <!-- Cart items will be rendered here -->
                                {!! view('partials.cart', ['cart' => session('cart', [])])->render() !!}
                            </div>
                        </div>
                    </div>

                    <!-- Auth Section -->
                    @if (Auth::check())
                        <form method="POST" action="{{ route('frontend.logout') }}"
                            class="d-flex align-items-center mb-0" style="margin-left: 20px;">
                            @csrf
                            <button type="submit" class="btn d-flex align-items-center"
                                style="border: none; padding: 0;">
                                <i class="fas fa-sign-out-alt fa-2x me-2"></i>
                            </button>
                        </form>
                    @else
                        <!-- Login Button -->
                        <a href="{{ route('frontend.login') }}" class="btn d-flex align-items-center"
                            style="margin-left: 20px;">
                            <i class="fas fa-user fa-2x me-2"></i>
                        </a>
                    @endif
                </div>


            </div>
        </div>
    </div>
    <!-- End Sticky Menu -->

    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn">
            <span class="icon flaticon-multiply"></span>
        </div>

        <nav class="menu-box">
            <div class="nav-logo">
                <a href="index.html"><img src="/frontend/assets/images/logo-small.png" alt=""
                        title="" /></a>
            </div>
            <div class="menu-outer">
                <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
</header>
<!-- End Main Header -->
