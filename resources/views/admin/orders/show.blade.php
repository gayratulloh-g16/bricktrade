<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Order Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #{{ $order->id }}</h5>
                            <div class="mb-3">
                                <p><strong>User:</strong> {{ optional($order->user)->first_name ?? 'N/A' }} {{ optional($order->user)->last_name ?? 'N/A' }}</p>
                                <p><strong>Driver:</strong> {{ optional($order->driver)->first_name }} {{ optional($order->driver)->last_name }}</p>
                                <p><strong>Order Date:</strong> {{ $order->order_date }}</p>
                                <p><strong>Total Amount:</strong> {{ $order->total_amount }}</p>
                                <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
                                <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                            </div>
                            <div class="mb-3">
                                <h6>Order Items:</h6>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Brick</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $item)
                                            <tr>
                                                <td>{{ optional($item->brick)->name_en }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->unit_price }}</td>
                                                <td>{{ $item->subtotal }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($order->feedback)
                                <div class="mb-3">
                                    <h6>Feedback:</h6>
                                    <p>{{ $order->feedback->text }}</p>
                                </div>
                            @endif
                            <div class="d-flex">
                                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
