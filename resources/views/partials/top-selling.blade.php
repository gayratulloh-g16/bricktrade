<table class="table table-borderless">
    <thead>
        <tr>
            <th scope="col">Preview</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Sold</th>
            <th scope="col">Revenue</th>
        </tr>
    </thead>
    <tbody>
        @if(count($bricks) > 0)
            @foreach($bricks as $brick)
                <tr>
                    <th scope="row">
                        <a href="#">
                            <img src="{{ $brick->images->first() ? asset('/storage/' . $brick->images->first()->image) : '/frontend/assets/images/resource/products/thumb-default.jpg' }}"
                                alt="{{ $brick->name_en }}" style="width: 50px; height: 50px; object-fit: cover;">
                        </a>
                    </th>
                    <td>
                        <a href="#" class="text-primary fw-bold">{{ $brick->name_en }}</a>
                    </td>
                    <td>{{ number_format($brick->price, 2) }} So'm</td>
                    <td class="fw-bold">{{ $brick->total_sold }}</td>
                    <td>{{ number_format($brick->total_revenue, 2) }} So'm</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">No sales data available.</td>
            </tr>
        @endif
    </tbody>
</table>
