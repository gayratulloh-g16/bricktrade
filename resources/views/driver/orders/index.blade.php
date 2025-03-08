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
                    <!-- Button to start polling location -->
                    <button type="button" id="updateLocationBtn" class="btn btn-info mb-3">
                        Update My Location
                    </button>

                    <!-- Map Container (hidden at first) -->
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
                        </div><!-- End card-body -->
                    </div><!-- End card -->
                </div>
            </div>
        </section>
    </main>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Yandex Maps JS API -->
    <!-- Replace YOUR_API_KEY with your actual Yandex Maps JavaScript API key -->
    <script src="https://api-maps.yandex.ru/2.1/?apikey=eacdc7c8-4574-4461-978a-965d956be0a5&lang=en_US"></script>

    <script>
        let myMap;            // Yandex Map instance
        let driverPlacemark;  // The placemark (marker) for the driver
        let updateInterval;   // Interval ID for polling location
    
        // 1) Wait until Yandex Maps API is ready
        ymaps.ready(initMap);
    
        function initMap() {
            // Attempt to get the user’s current geolocation right away.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        // Use the geolocated coords as initial center
                        const initialLat = position.coords.latitude;
                        const initialLng = position.coords.longitude;
                        setupYandexMap(initialLat, initialLng);
                    },
                    function (error) {
                        console.warn('Could not get user location. Using fallback.');
                        // If error, fallback to some default location (e.g., Tashkent)
                    },
                    {
                        enableHighAccuracy: true,
                        maximumAge: 0,
                        timeout: 5000
                    }
                );
            } else {
                console.warn('Geolocation not supported. Using fallback location.');
            }
        }
    
        // 2) Create the Yandex Map & Placemark at the specified coords
        function setupYandexMap(lat, lng) {
            const coords = [lat, lng];
    
            // Create the map
            myMap = new ymaps.Map('driverMap', {
                center: coords,
                zoom: 12
            });
    
            // Create a placemark at that position
            driverPlacemark = new ymaps.Placemark(coords, {
                hintContent: 'Driver Location'
            }, {
                preset: 'islands#blueCircleDotIcon'
            });
    
            // Add placemark to the map
            myMap.geoObjects.add(driverPlacemark);
        }
    
        // 3) Start polling location every 30 seconds
        function startPollingLocation() {
            updateInterval = setInterval(function () {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        function (position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            console.log('Polled location:', lat, lng);
    
                            updatePlacemark(lat, lng);
                            updateDriverLocation(lat, lng);
                        },
                        function (error) {
                            console.error('Error fetching location:', error.message);
                        },
                        {
                            enableHighAccuracy: true,
                            maximumAge: 0,
                            timeout: 5000
                        }
                    );
                }
            }, 30000); // every 30 seconds
        }
    
        // 4) Update the map placemark on the Yandex map
        function updatePlacemark(latitude, longitude) {
            const newCoords = [latitude, longitude];
            driverPlacemark.geometry.setCoordinates(newCoords);
            // Optionally recenter the map each time
            // myMap.setCenter(newCoords, 12);
        }
    
        // 5) Send the driver’s location to your server
        function updateDriverLocation(latitude, longitude) {
            $.ajax({
                url: "{{ route('driver.orders.updateLocation') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    latitude: latitude,
                    longitude: longitude,
                },
                success: function (response) {
                    console.log("Location updated:", response.message);
                },
                error: function (xhr) {
                    console.error("Error updating location:", xhr.responseJSON?.message || "Unknown error");
                }
            });
        }
    
        // 6) Show the map & start polling when the button is clicked
        $('#updateLocationBtn').on('click', function () {
            // Reveal the map if hidden
            $('#driverMap').show();
            startPollingLocation();
        });
    
        // Stop polling on page unload (optional)
        $(window).on('beforeunload', function() {
            if (updateInterval) {
                clearInterval(updateInterval);
            }
        });
    
        // 7) Searching orders (unrelated to Yandex Maps)
        $('#search-input').on('keyup', function() {
            let query = this.value;
            fetch("{{ route('admin.orders.filter') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    $('#order-list-container').html(html);
                })
                .catch(error => console.error('Error fetching filtered orders:', error));
        });
    </script>
    
</x-layouts.driver>
