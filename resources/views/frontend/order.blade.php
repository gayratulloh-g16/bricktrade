<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.my_orders') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{ __('main.my_orders') }}</li>
        </ul>
    </section>
    <!-- End Page Title -->
    <div class="auto-container my-5">
        <h2 class="mb-4">{{ __('main.order_history') }}</h2>
        @if ($orders->isEmpty())
            <p>{{ __('main.you_have_not_placed') }}</p>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('main.order_number') }}</th>
                            <th>{{ __('main.order_date') }}</th>
                            <th>{{ __('main.total_amount') }}</th>
                            <th>{{ __('main.status') }}</th>
                            <th>{{ __('main.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                                <td>{{ number_format($order->total_amount, 2) }} So'm</td>
                                @php
                                    $status = $order->order_status;
                                    $colors = [
                                        'new' => '#007bff', // blue
                                        'processing' => '#fd7e14', // orange
                                        'completed' => '#28a745', // green
                                        'cancelled' => '#dc3545', // red
                                    ];
                                    $color = $colors[$status] ?? '#6c757d'; // default grey
                                @endphp

                                <td>
                                    <span
                                        style="background-color: {{ $color }}; color: #fff; padding: 5px 10px; border-radius: 12px; font-size: 0.9rem;">
                                        {{ __('main.' . $status) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('order.detail', $order->id) }}"
                                        class="btn btn-info btn-sm">{{ __('main.view_details') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</x-layouts.frontend>
