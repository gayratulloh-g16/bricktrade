<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>Login</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">home</a></li>
            <li>Account</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Login Section -->
    <section class="register-section">
        <div class="auto-container">
            <div class="row justify-content-center">
                <!-- Form Column -->
                <div class="form-column col-lg-8 col-md-10 col-sm-12">
                    <div class="form-title text-center">
                        <h4>Login</h4>
                    </div>

                    <!-- Login Form -->
                    <div class="styled-form login-form">
                        <form method="POST" action="{{ route('frontend.login.submit') }}">
                            @csrf

                            <!-- Email -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope"></span></span>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address *" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-lock"></span></span>
                                <input type="password" name="password" placeholder="Enter Password *" required>
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="clearfix">
                                <div class="pull-left">
                                    <input type="checkbox" id="remember-me"><label class="remember-me" for="remember-me">&nbsp; Remember Me</label>
                                </div>
                                <div class="pull-right">
                                    <p>Do not have an account? <a href="{{ route('frontend.register') }}">Register</a></p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-center">
                                <button type="submit" class="theme-btn btn-style-three"><span class="txt">Login</span></button>
                            </div>

                            <!-- Social Media Login -->
                            <div class="form-group social-links-two text-center">
                                Or login with
                                <a href="#" class="img-circle google-plus">
                                    <span class="fab fa-google fa-lg"></span>  <!-- Adjusted to include fa-2x for icon size -->
                                </a>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Login Section -->
</x-layouts.frontend>
