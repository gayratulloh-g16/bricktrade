<table class="table table-borderless datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if($sales->count())
            @foreach($sales as $sale)
                @php
                    $status = $sale->order_status;
                    $colors = [
                        'new'       => 'bg-primary',
                        'process'   => 'bg-warning',
                        'completed' => 'bg-success',
                        'cancelled' => 'bg-danger'
                    ];
                    $color = $colors[$status] ?? 'bg-secondary';
                @endphp
                <tr>
                    <td><a href="#">#{{ $sale->id }}</a></td>
                    <td>{{ $sale->user->first_name }} {{ $sale->user->last_name }}</td>
                    <td>
                        <a href="#" class="text-primary">
                            {{ $sale->orderItems->first()->brick->name_en ?? 'N/A' }}
                        </a>
                    </td>
                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                    <td>
                        <span class="badge {{ $color }}">{{ ucfirst($status) }}</span>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">No sales found.</td>
            </tr>
        @endif
    </tbody>
</table>
