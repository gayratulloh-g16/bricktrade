<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Shipping Address</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ optional($order->user)->first_name ?? 'N/A' }} {{ optional($order->user)->last_name ?? 'N/A' }}</td>
                    
                    <td>{{ $order->order_date }}</td>
                    <td>{{ $order->total_amount }}</td>
                    <td>{{ $order->order_status }}</td>
                    <td>{{ $order->shipping_address }}</td>
                    <td class="text-end">
                        <a href="{{ route('driver.orders.show', $order->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('driver.orders.edit', $order->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('driver.orders.destroy', $order->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this order?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No orders found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
