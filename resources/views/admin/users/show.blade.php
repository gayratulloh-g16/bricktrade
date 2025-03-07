<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Customer Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Customers</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Customer #{{ $user->id }}</h5>
                            <div class="mb-3">
                                <p><strong>First Name:</strong> {{ $user->first_name }}</p>
                                <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
                                <p><strong>Email:</strong> {{ $user->email }}</p>
                                <p><strong>Phone Number:</strong> {{ $user->phone_number }}</p>
                                <p><strong>Address:</strong> {{ $user->address }}</p>
                                <p><strong>City:</strong> {{ $user->city }}</p>
                                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                                <div>
                                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('/admin/assets/img/profile-img.jpg') }}"
                                        alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                                </div>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
