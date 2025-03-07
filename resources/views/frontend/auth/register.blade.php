<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>Register</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">home</a></li>
            <li>Account</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Register Section -->
    <section class="register-section">
        <div class="auto-container">
            <div class="row justify-content-center">
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-10 col-sm-12">
                    <div class="form-title text-center">
                        <h4>Register</h4>
                    </div>

                    <!-- Register Form -->
                    <div class="styled-form register-form">
                        <form method="POST" action="{{ route('frontend.register.submit') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- First Name -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name *" required>
                                @error('first_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name *" required>
                                @error('last_name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope"></span></span>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-phone"></span></span>
                                <input type="text" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone Number">
                                @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Address -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-map-marker"></span></span>
                                <input type="text" name="address" value="{{ old('address') }}" placeholder="Address">
                                @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- City -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-city"></span></span>
                                <input type="text" name="city" value="{{ old('city') }}" placeholder="City">
                                @error('city') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-lock"></span></span>
                                <input type="password" name="password" placeholder="Enter Password *" required>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-lock"></span></span>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password *" required>
                            </div>

                            <!-- Profile Image Upload -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-image"></span></span>
                                <input type="file" name="image" accept="image/*">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="theme-btn btn-style-three"><span class="txt">Register</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register Section -->
</x-layouts.frontend>
