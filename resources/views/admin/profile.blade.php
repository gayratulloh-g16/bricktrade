<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>My Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">My Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Display Validation Errors -->
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
                            <h5 class="card-title">Update Your Profile</h5>
                            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control"
                                        value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control"
                                        value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" id="phone_number" name="phone_number" class="form-control"
                                        value="{{ old('phone_number', auth()->user()->phone_number) }}">
                                    @error('phone_number')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" id="address" name="address" class="form-control"
                                        value="{{ old('address', auth()->user()->address) }}">
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" id="city" name="city" class="form-control"
                                        value="{{ old('city', auth()->user()->city) }}">
                                    @error('city')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- New Password Fields -->
                                <div class="col-md-6">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                                </div>
                                <div class="col-md-6 position-relative">
                                    <label for="image" class="form-label">Profile Image</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    @if(auth()->user()->image)
                                        <div class="mt-2 image-container" style="position: relative; display: inline-block;">
                                            <img src="{{ asset('storage/' . auth()->user()->image) }}" alt="Profile Image" class="img-thumbnail" style="max-width: 150px;">
                                            <!-- Remove Button -->
                                            <button type="button" class="btn btn-danger btn-sm remove-image-btn" style="position: absolute; top: 0; right: 0;">&times;</button>
                                        </div>
                                        <!-- Hidden input to mark removal -->
                                        <input type="hidden" name="remove_image" id="remove_image" value="0">
                                    @else
                                        <img src="{{ asset('/admin/assets/img/profile-img.jpg') }}" alt="Default Profile" class="img-thumbnail" style="max-width: 150px;">
                                    @endif
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Profile</button>
                                    <a href="{{ route('admin.profile') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>

    <script>
        // When remove button is clicked, hide the image container and mark removal
        document.querySelectorAll('.remove-image-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const container = this.closest('.image-container');
                container.style.display = 'none';
                document.getElementById('remove_image').value = 1;
            });
        });
    </script>
</x-layouts.admin>
