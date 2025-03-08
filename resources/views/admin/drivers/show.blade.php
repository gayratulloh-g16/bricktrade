<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Driver Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">Drivers</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $driver->user->first_name }} {{ $driver->user->last_name }}
                            </h5>
                            <div class="mb-3">
                                <p><strong>Email:</strong> {{$driver->user->email}}</p>
                                <p><strong>Phone Number:</strong> {{ $driver->user->phone_number }}</p>
                                <p><strong>Vehicle Number:</strong> {{ $driver->vehicle_number }}</p>
                                <p>
                                    <strong>Location:</strong>
                                    @if($driver->latitude && $driver->longitude)
                                        ({{ $driver->latitude }}, {{ $driver->longitude }})
                                    @else
                                        Not provided
                                    @endif
                                </p>
                                <p><strong>Created At:</strong> {{ $driver->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-warning me-2">Edit</a>
                                <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
