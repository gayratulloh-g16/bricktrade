<x-layouts.driver>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Orders</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('driver.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Orders</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" id="updateLocationBtn" class="btn btn-info mb-3">Update My Location</button>
                    <div id="driverMap" style="width:100%; height:400px; border:1px solid #ccc; border-radius:8px; display:none;"></div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Orders Data</h5>
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Create New Order</a>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="search-input" class="form-control" placeholder="Search orders...">
                            </div>
                            <div id="order-list-container">
                                @include('driver.orders.partials.order_list', ['orders' => $orders])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=eacdc7c8-4574-4461-978a-965d956be0a5&lang=en_US"></script>

    <script>
        let myMap, driverPlacemark, updateInterval;
        
        ymaps.ready(initMap);
        
        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(position => {
                    setupYandexMap(position.coords.latitude, position.coords.longitude);
                }, () => console.warn('Could not get user location. Using fallback.'), {
                    enableHighAccuracy: true, maximumAge: 0, timeout: 5000
                });
            } else {
                console.warn('Geolocation not supported. Using fallback location.');
            }
        }
        
        function setupYandexMap(lat, lng) {
            myMap = new ymaps.Map('driverMap', { center: [lat, lng], zoom: 12 });
            driverPlacemark = new ymaps.Placemark([lat, lng], { hintContent: 'Driver Location' }, { preset: 'islands#blueCircleDotIcon' });
            myMap.geoObjects.add(driverPlacemark);
            startPollingLocation();
        }
        
        function startPollingLocation() {
            updateInterval = setInterval(() => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(position => {
                        updatePlacemark(position.coords.latitude, position.coords.longitude);
                        updateDriverLocation(position.coords.latitude, position.coords.longitude);
                    }, error => console.error('Error fetching location:', error.message), {
                        enableHighAccuracy: true, maximumAge: 0, timeout: 5000
                    });
                }
            }, 30000);
        }
        
        function updatePlacemark(lat, lng) {
            driverPlacemark.geometry.setCoordinates([lat, lng]);
        }
        
        function updateDriverLocation(lat, lng) {
            $.ajax({
                url: "{{ route('driver.orders.updateLocation') }}",
                method: "POST",
                data: { _token: "{{ csrf_token() }}", latitude: lat, longitude: lng },
                success: response => console.log("Location updated:", response.message),
                error: xhr => console.error("Error updating location:", xhr.responseJSON?.message || "Unknown error")
            });
        }
        
        $('#updateLocationBtn').on('click', function () {
            $('#driverMap').show();
            startPollingLocation();
        });

        $(window).on('beforeunload', function() {
            if (updateInterval) clearInterval(updateInterval);
        });

        $('#search-input').on('keyup', function() {
            fetch("{{ route('admin.orders.filter') }}?search=" + encodeURIComponent(this.value))
                .then(response => response.text())
                .then(html => $('#order-list-container').html(html))
                .catch(error => console.error('Error fetching filtered orders:', error));
        });
    </script>
</x-layouts.driver>