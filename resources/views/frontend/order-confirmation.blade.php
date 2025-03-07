<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.contact') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{ __('main.contact') }}</li>
        </ul>
    </section>
    <!-- End Page Title -->
    <section class="order-confirmation py-5">
        <div class="auto-container">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-warning text-white">
                    <h2>{{__('main.thank_you')}}</h2>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p class="lead">{{ __('main.order_success_message') }}</p>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>{{__('main.order_details')}}</h5>
                            <ul class="list-unstyled">
                                <li><strong>{{__('main.order_number')}}:</strong> {{ $order->id }}</li>
                                <li>
                                    <strong>{{__('main.order_date')}}:</strong>
                                    {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}
                                </li>
                                <li>
                                    <strong>{{ __('main.status') }}:</strong>
                                    <td>{{ __("main." . $order->order_status) }}</td>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>{{ __('main.payment_summary')}}</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>{{__('main.total_amount')}}:</strong>
                                    {{ number_format($order->total_amount, 2) }} So'm
                                </li>
                            </ul>
                        </div>
                    </div>
                    @if ($order->order_notes)
                        <div class="mt-4">
                            <h5>Additional Information</h5>
                            <p>{{ $order->order_notes }}</p>
                        </div>
                    @endif
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('home') }}" class="btn btn-warning">
                        {{ __('main.return_to_home') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
