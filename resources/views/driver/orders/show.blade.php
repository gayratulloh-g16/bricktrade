<x-layouts.driver>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('driver.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('driver.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Order #{{ $order->id }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #{{ $order->id }}</h5>
                            <div class="mb-3">
                                <p><strong>Order Date:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</p>
                                <p><strong>Total Amount:</strong> {{ number_format($order->total_amount, 2) }} So'm</p>
                                <p><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                                <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                            </div>
                            <h5>Order Items</h5>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $item->brick->images->first() ? asset('/storage/' . $item->brick->images->first()->image) : '/frontend/assets/images/resource/products/thumb-default.jpg' }}"
                                                             alt="{{ $item->brick->name_en }}"
                                                             style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                        <span>{{ $item->brick->name_en }}</span>
                                                    </div>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->unit_price, 2) }} So'm</td>
                                                <td>{{ number_format($item->subtotal, 2) }} So'm</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-end mt-3">
                                <a href="{{ route('driver.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.driver>
