@if(count($cart) > 0)
  @foreach($cart as $productId => $item)
    <div class="cart-product" data-product-id="{{ $productId }}">
      <div class="inner">
        <div class="cross-icon">
          <a href="{{ route('cart.view') }}" class="remove-btn remove-from-cart" data-product-id="{{ $productId }}">
            <span class="flaticon-cancel-1"></span>
          </a>
        </div>
        <div class="image">
          <img src="{{ $item['image'] ? asset('/storage/' . $item['image']) : '/frontend/assets/images/resource/products/thumb-default.jpg' }}" alt="">
        </div>
        <h3><a href="{{ route('cart.view') }}">{{ $item['name'] }}</a></h3>
        <div class="quantity-text">Quantity: {{ $item['quantity'] }}</div>
        <div class="price">{{ number_format($item['price'], 2) }} So'm</div>
      </div>
    </div>
  @endforeach
  <div class="cart-total">
    {{__('main.sub_total')}}: <span id="cartSubtotal">{{ number_format(collect($cart)->sum(function($item){ return $item['price'] * $item['quantity']; }), 2) }} So'm</span>
  </div>
  <ul class="btns-boxed">
    <li><a href="{{ route('cart.view') }}">{{__('main.view_cart')}}</a></li>
    <li><a href="{{ route('checkout')}}">{{__('main.checkout')}}</a></li>
  </ul>
@else
  <p>{{__('main.your_cart_is_empty')}}</p>
@endif
