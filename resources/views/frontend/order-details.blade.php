<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.order_details') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li><a href="{{ route('orders') }}">{{ __('main.my_orders') }}</a></li>
            <li>{{ __('main.order_number') }}{{ $order->id }}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <div class="auto-container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white text-center">
                <h2>{{ __('main.order_number') }}{{ $order->id }}</h2>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <!-- Order Information Column -->
                    <div class="col-md-6">
                        <h5>{{ __('main.order_information') }}</h5>
                        <ul class="list-unstyled">
                            <li>
                                <strong>{{ __('main.order_date') }}:</strong>
                                {{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}
                            </li>
                            <li>
                                <strong>{{ __('main.total_amount') }}:</strong>
                                {{ number_format($order->total_amount, 2) }} So'm
                            </li>
                            @php
                                $status = $order->order_status;
                                $colors = [
                                    'new'        => '#007bff',  // blue
                                    'processing' => '#fd7e14',  // orange
                                    'completed'  => '#28a745',  // green
                                    'cancelled'  => '#dc3545',  // red
                                ];
                                $color = $colors[$status] ?? '#6c757d'; // default grey
                            @endphp
                            <li>
                                <strong>{{ __('main.status') }}:</strong>
                                <span style="background-color: {{ $color }}; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 0.9rem;">
                                    {{ __('main.' . $status) }}
                                </span>
                            </li>
                        </ul>
                    </div>
                    <!-- Shipping Address Column -->
                    <div class="col-md-6">
                        <h5>{{ __('main.shipping_address') }}</h5>
                        <p>{{ $order->shipping_address }}</p>
                        @if ($order->order_notes)
                            <h5>{{ __('main.order_notes') }}</h5>
                            <p>{{ $order->order_notes }}</p>
                        @endif
                    </div>
                </div>

                <!-- Driver Information -->
                @if ($order->driver)
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>{{ __('main.driver_information') }}</h5>
                            <ul class="list-unstyled">
                                <li>
                                    <strong>{{ __('main.driver_name') }}:</strong>
                                    {{ $order->driver->user->first_name }} {{ $order->driver->user->last_name }}
                                </li>
                                <li>
                                    <strong>{{ __('main.phone_number') }}:</strong>
                                    {{ $order->driver->user->phone_number }}
                                </li>
                                <li>
                                    <strong>{{ __('main.vehicle_number') }}:</strong>
                                    {{ $order->driver->vehicle_number }}
                                </li>
                            </ul>
                        </div>
                    </div>

                    
                @endif

                <h5>{{ __('main.order_items') }}</h5>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>{{ __('main.product') }}</th>
                                <th>{{ __('main.quantity') }}</th>
                                <th>{{ __('main.unit_price') }}</th>
                                <th>{{ __('main.subtotal') }}</th>
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

                <!-- Feedback Section (if order is completed) -->
                @if ($order->order_status === 'completed')
                    @if ($order->feedback)
                        <div class="feedback-display mt-4 p-3" style="border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
                            <h5 style="margin-bottom: 10px;">{{ __('main.your_review') }}</h5>
                            <div class="star-rating-display mb-2" style="font-size: 1.5rem;">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $order->feedback->rating)
                                        <i class="fa-solid fa-star" style="color: #f7c600;"></i>
                                    @else
                                        <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                    @endif
                                @endfor
                            </div>
                            <p>{{ $order->feedback->text }}</p>
                        </div>
                    @else
                        <div class="feedback-section mt-4" style="border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; padding: 20px;">
                            <h5>{{ __('main.add_your_review') }}</h5>
                            <form action="{{ route('feedback.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <div class="rating-form mb-3">
                                    <p>{{ __('main.your_rating') }}</p>
                                    <div class="star-rating" style="direction: rtl; font-size: 1.5rem; display: inline-flex;">
                                        <input type="radio" id="star5" name="rating" value="5" required style="display: none;">
                                        <label for="star5" title="5 stars" style="cursor: pointer;">
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        </label>

                                        <input type="radio" id="star4" name="rating" value="4" style="display: none;">
                                        <label for="star4" title="4 stars" style="cursor: pointer;">
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        </label>

                                        <input type="radio" id="star3" name="rating" value="3" style="display: none;">
                                        <label for="star3" title="3 stars" style="cursor: pointer;">
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        </label>

                                        <input type="radio" id="star2" name="rating" value="2" style="display: none;">
                                        <label for="star2" title="2 stars" style="cursor: pointer;">
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        </label>

                                        <input type="radio" id="star1" name="rating" value="1" style="display: none;">
                                        <label for="star1" title="1 star" style="cursor: pointer;">
                                            <i class="fa-solid fa-star" style="color: #ccc;"></i>
                                        </label>
                                    </div>
                                </div>

                                <style>
                                    .star-rating label {
                                        transition: color 0.2s;
                                    }
                                    .star-rating input:checked ~ label,
                                    .star-rating label:hover,
                                    .star-rating label:hover ~ label {
                                        color: #f7c600 !important;
                                    }
                                </style>

                                <div class="mb-3">
                                    <label for="text" class="form-label">{{ __('main.your_review') }}</label>
                                    <textarea name="text" id="text" rows="4" class="form-control"
                                              placeholder="{{ __('main.review_placeholder') }}" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">{{ __('main.submit_review') }}</button>
                            </form>
                        </div>
                    @endif
                @endif

                <div class="text-end mt-3">
                    <a href="{{ route('orders') }}" class="btn btn-secondary">{{ __('main.back_to_orders') }}</a>
                </div>
            </div>
        </div>
    </div>

    @if($order->driver && $order->driver->latitude && $order->driver->longitude)
    <!-- Include Yandex Maps API -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=eacdc7c8-4574-4461-978a-965d956be0a5&lang=en_US"></script>
    <script>
        let driverMap;
        let driverPlacemark;
        
        ymaps.ready(initDriverMap);

        function initDriverMap() {
            var lat = parseFloat("{{ $order->driver->latitude }}");
            var lng = parseFloat("{{ $order->driver->longitude }}");
            var driverCoords = [lat, lng];
            
            driverMap = new ymaps.Map("driverMap", {
                center: driverCoords,
                zoom: 14
            });
            
            driverPlacemark = new ymaps.Placemark(driverCoords, {
                hintContent: "Driver Location",
                balloonContent: "Driver's Current Position"
            }, {
                preset: "islands#blueCircleDotIcon"
            });
            
            driverMap.geoObjects.add(driverPlacemark);
            startUpdatingDriverLocation();
        }
        
        function startUpdatingDriverLocation() {
            setInterval(() => {
                fetch("{{ route('driver.location', ['driver_id' => $order->driver->id]) }}")
                    .then(response => response.json())
                    .then(data => {
                        if (data.latitude && data.longitude) {
                            let newCoords = [parseFloat(data.latitude), parseFloat(data.longitude)];
                            driverPlacemark.geometry.setCoordinates(newCoords);
                            driverMap.setCenter(newCoords, 14);
                        }
                    })
                    .catch(error => console.error("Error fetching driver location:", error));
            }, 10000); // Update every 10 seconds
        }
    </script>
    <!-- Map Container -->
    <div class="auto-container my-5">
        <h5>Driver Live Location</h5>
        <div id="driverMap" style="width: 100%; height: 300px; border: 1px solid #ddd; border-radius: 8px;"></div>
    </div>
@endif


</x-layouts.frontend>
