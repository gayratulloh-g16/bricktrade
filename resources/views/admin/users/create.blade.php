<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Customer</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Customers</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Global Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Customer</h5>
                            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data"
                                class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"
                                        value="{{ old('first_name') }}" required>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"
                                        value="{{ old('last_name') }}" required>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        value="{{ old('city') }}">
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <img src="{{ asset('/admin/assets/img/profile-img.jpg') }}" alt="Default Profile"
                                        class="img-thumbnail mt-2" style="max-width: 150px;">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Optionally add password fields -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Customer</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
