<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.checkout')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{__('main.home')}}</a></li>
            <li>{{__('main.checkout')}}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    @if(Auth::check())
    <!-- Checkout Page for Authenticated User -->
    <div class="checkout-page">
        <div class="auto-container">
            <!-- Checkout Details -->
            <div class="checkout-form">
                <form method="post" action="{{ route('checkout.process') }}">
                    @csrf
                    <div class="row clearfix">
                        <!-- Billing Address Column (Essential Fields Only) -->
                        <div class="column col-md-6 col-sm-12 col-xs-12">
                            <div class="checkout-title">
                                <h4>{{__('main.order_information')}}</h4>
                            </div>
                            <div class="row clearfix">
                                <!-- First Name -->
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">{{__('main.first_name')}} <sup>*</sup></div>
                                    <input type="text" name="first_name" value="{{ old('first_name', Auth::user()->first_name) }}" placeholder="">
                                </div>
                                <!-- Last Name -->
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <div class="field-label">{{__('main.last_name')}} <sup>*</sup></div>
                                    <input type="text" name="last_name" value="{{ old('last_name', Auth::user()->last_name) }}" placeholder="">
                                </div>
                                <!-- Email -->
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">{{__('main.email')}} <sup>*</sup></div>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email Address">
                                </div>
                                <!-- Phone Number -->
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone_number) }}" placeholder="Phone Number">
                                </div>
                                <!-- Address -->
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">{{__('main.shipping_address')}} <sup>*</sup></div>
                                    <input type="text" name="address" value="{{ old('address', Auth::user()->address) }}" placeholder="">
                                </div>
                                <!-- Town/City -->
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <div class="field-label">{{__('main.city')}}<sup>*</sup></div>
                                    <input type="text" name="city" value="{{ old('city', Auth::user()->city) }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <!-- (Optional) You can add more columns if needed -->
                    </div>
                    <div class="clearfix">
                        <button type="submit" class="theme-btn btn-style-three">
                            <span class="txt">{{__('main.place_order')}}</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- End Checkout Details -->

            <!-- Lower Content: Order Summary and Cart Totals -->
            <div class="lower-content">
                <div class="row clearfix">
                    <!-- Order Summary Column -->
                    <div class="order-column column col-md-6 col-sm-12 col-xs-12">
                        <div class="checkout-title">
                            <h4>{{__('main.order_details')}}</h4>
                        </div>
                        <div class="cart-outer">
                            <table class="cart-table">
                                <thead class="cart-header">
                                    <tr>
                                        <th class="prod-column">{{__('main.product')}}</th>
                                        <th>{{__('main.quantity')}}</th>
                                        <th>{{__('main.total_amount')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cart = session('cart', []);
                                    @endphp
                                    @if(count($cart) > 0)
                                        @foreach($cart as $productId => $item)
                                            <tr>
                                                <td class="prod-column">
                                                    <div class="column-box">
                                                        <figure class="prod-thumb">
                                                            <img src="{{ $item['image'] ? asset('/storage/' . $item['image']) : '/frontend/assets/images/resource/products/thumb-default.jpg' }}" alt="">
                                                        </figure>
                                                        <h6 class="prod-title">{{ $item['name'] }}</h6>
                                                    </div>
                                                </td>
                                                <td class="qty">
                                                    <input type="text" value="{{ $item['quantity'] }}" readonly>
                                                </td>
                                                <td class="sub-total">
                                                    {{ number_format($item['price'] * $item['quantity'], 2) }} So'm
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3">{{__('main.your_cart_is_empty')}}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Cart Totals Column -->
                    <div class="column col-md-6 col-sm-12 col-xs-12">
                        <div class="checkout-title">
                            <h4>{{__('main.cart_totals')}}</h4>
                        </div>
                        <ul class="totals-table">
                            <li class="clearfix">
                                <span class="col col-title">{{__('main.sub_total')}}</span>
                                <span class="col" id="cartSubtotal">
                                    {{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }), 2) }} So'm
                                </span>
                            </li>
                            <li class="clearfix">
                                <span class="col col-title">{{__('main.shipping_and_handling')}}</span>
                                <span class="col" id="shippingInfo">{{__('main.free_shipping')}}</span>
                            </li>
                            <li class="clearfix">
                                <span class="col col-title">{{__('main.total_amount')}}</span>
                                <span class="col" id="cartSubtotal">
                                    {{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }), 2) }} So'm
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Lower Content -->
        </div>
    </div>
    <!-- End CheckOut Page -->
    @else
        <!-- If the user is not authenticated, prompt them to log in -->
        <div class="auto-container">
            <div class="alert alert-info text-center">
                <p>{{__('main.you_must_be_logged_in_to_proceed_to_checkout')}}</p>
                <a href="{{ route('frontend.login') }}" class="theme-btn btn-style-three">
                    <span class="txt">{{__('main.click_here_to_login')}}</span>
                </a>
            </div>
        </div>
    @endif
</x-layouts.frontend>
