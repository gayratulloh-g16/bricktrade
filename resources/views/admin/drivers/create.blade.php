<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Driver</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.drivers.index') }}">Drivers</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Driver</h5>
                            <form action="{{ route('admin.drivers.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="vehicle_number" class="form-label">Vehicle Number</label>
                                    <input type="text" class="form-control" id="vehicle_number" name="vehicle_number"
                                        value="{{ old('vehicle_number') }}" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Driver</button>
                                    <a href="{{ route('admin.drivers.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
