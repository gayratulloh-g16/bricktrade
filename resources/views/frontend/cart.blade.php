<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.shopping_cart')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{__('main.home')}}</a></li>
            <li>{{__('main.cart')}}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Cart Section -->
    <section class="cart-section">
        <div class="auto-container">
            <!-- Cart Outer -->
            <div class="cart-outer">
                <div class="table-outer">
                    <table class="cart-table" id="cartTable">
                        <thead class="cart-header">
                            <tr>
                                <th class="prod-column">{{__('main.product')}}</th>
                                <th>&nbsp;</th>
                                <th>{{__('main.quantity')}}</th>
                                <th>{{__('main.availability')}}</th>
                                <th class="price">{{__('main.price')}}</th>
                                <th>{{__('main.total')}}</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cart = session('cart', []);
                            @endphp
                            @if (count($cart) > 0)
                                @foreach ($cart as $productId => $item)
                                    @php
                                        $brick = \App\Models\Brick::find($productId);
                                    @endphp
                                    <tr data-product-id="{{ $productId }}"
                                        data-residual="{{ $brick ? $brick->residual : 0 }}">
                                        <td colspan="2" class="prod-column">
                                            <div class="column-box">
                                                <figure class="prod-thumb">
                                                    <a href="#">
                                                        <img src="{{ $item['image'] ? asset('/storage/' . $item['image']) : '/frontend/assets/images/resource/products/thumb-default.jpg' }}"
                                                            alt="">
                                                    </a>
                                                </figure>
                                                <h6 class="prod-title">{{ $item['name'] }}</h6>
                                            </div>
                                        </td>
                                        <td class="qty">
                                            <div class="quantity-controls">
                                                <button class="qty-minus"
                                                    data-product-id="{{ $productId }}">-</button>
                                                <input type="text" class="quantity-input"
                                                    value="{{ $item['quantity'] }}"
                                                    data-product-id="{{ $productId }}">
                                                <button class="qty-plus"
                                                    data-product-id="{{ $productId }}">+</button>
                                            </div>
                                        </td>
                                        <td class="availability">
                                            @if ($brick && $brick->residual >= $item['quantity'])
                                                <div class="available-info">
                                                    <span class="icon fa fa-check"></span>{{ __('main.in_stock')}}
                                                </div>
                                            @else
                                                <div class="available-info">
                                                    <span class="icon fa fa-times"></span>{{ __('main.out_of_stock')}}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="price">{{ number_format($item['price'], 2) }} So'm</td>
                                        <td class="sub-total">
                                            {{ number_format($item['price'] * $item['quantity'], 2) }} So'm</td>
                                        <td class="remove">
                                            <a href="#" class="remove-btn remove-from-cart"
                                                data-product-id="{{ $productId }}">
                                                <span class="flaticon-cancel-1"></span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">{{__('main.your_cart_is_empty')}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="coupon-outer clearfix">
                    <div class="pull-right">
                        <!-- Optionally, an "Update Cart" button -->
                        <button type="button" class="theme-btn btn-style-three" id="updateCart">
                            <span class="txt">{{__('main.update_cart')}}</span>
                        </button>
                    </div>
                </div>

                <div class="row clearfix">


                    <div class="column col-md-12 col-sm-12 col-xs-12">
                        <div class="title-box">
                            <h4>{{__('main.cart_totals')}}</h4>
                        </div>
                        <!-- Totals Table -->
                        <ul class="totals-table" id="totalsTable">
                            {{-- <li class="clearfix">
                                <span class="col col-title">Cart Subtotal</span>
                                <span class="col" id="cartSubtotal">
                                    {{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }), 2) }} So'm
                                </span>
                            </li> --}}
                            <li class="clearfix">
                                <span class="col col-title">{{__('main.shipping_and_handling')}}</span>
                                <span class="col" id="shippingInfo">{{__('main.free_shipping')}}</span>
                            </li>
                            <li class="clearfix">
                                <span class="col col-title">{{__('main.total_amount')}}</span>
                                <span class="col" id="orderTotal">
                                    {{ number_format(collect($cart)->sum(function ($item) {return $item['price'] * $item['quantity'];}),2) }}
                                    So'm
                                </span>
                            </li>
                        </ul>

                        <div class="padd-top-30 text-right">
                            <button type="button" class="theme-btn btn-style-three" id="proceedCheckout">
                                <span class="txt">{{__('main.proceed_to_checkout')}}</span>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#proceedCheckout').on('click', function() {
                window.location.href = "{{ route('checkout') }}";
            });
        });
    </script>
</x-layouts.frontend>
