<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.contact') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{ __('main.contact') }}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Contact Page Section -->
    <section class="contact-page-section style-two">
        <div class="image-layer" style="background-image: url(/frontend/assets/images/background/4.jpg)"></div>
        <div class="auto-container">
            <!-- Title Box -->
            <div class="title-box">
                <h2>{{ __('main.have_some_questions') }}</h2>
                <div class="text">
                    {{ __('main.contact_form_description') }}
                </div>
            </div>
            <div class="row clearfix">
                <!-- Info Columns ... (address, email, phone) -->
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <span class="icon flaticon-maps-and-flags"></span>
                        <div class="text">
                            {{ $contact->address }}
                        </div>
                    </div>
                </div>
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <span class="icon flaticon-email-3"></span>
                        <div class="text">
                            {{ $contact->email }}
                        </div>
                    </div>
                </div>
                <div class="info-column col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <span class="icon flaticon-telephone"></span>
                        <div class="text">
                            {{ $contact->phone_number }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lower Section -->
            <div class="lower-section">
                <div class="row clearfix">
                    <!-- Title Column -->
                    <div class="title-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <h2>
                                {{ __('main.multi_engineering_solutions') }}
                            </h2>
                            <div class="text">
                                {{ __('main.construction_since') }}
                            </div>
                            <!-- Button Box -->
                            <div class="button-box">
                                <a class="btn-style-two theme-btn" href="{{ route('about') }}">
                                    <span class="txt">{{ __('main.more_about_us') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>                    

                    <!-- Form Column -->
                    <div class="form-column col-lg-6 col-md-12 col-sm-12">
                        <div class="inner-column">
                            <div class="title-box">
                                <h3>{{ __('main.request_for_quote') }}</h3>
                                <div class="text">{{ __('main.quote_description') }}</div>
                            </div>
                            <!-- Default Form -->
                            <div class="default-form contact-form">
                                <form method="post" action="{{ route('contact.store') }}" id="contact-form">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" value="" placeholder="{{ __('main.name_placeholder') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone_number" value="" placeholder="{{ __('main.phone_placeholder') }}" required />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="text" value="" placeholder="{{ __('main.subject_placeholder') }}" required />
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="theme-btn btn-style-four">
                                            <span class="txt">{{ __('main.contact_us_now') }}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--End Default Form-->
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- Map Boxed -->
            <div class="map-boxed">
                <div class="map-outer">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d805184.6331292129!2d144.49266890254142!3d-37.97123689954809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad646b5d2ba4df7%3A0x4045675218ccd90!2sMelbourne%20VIC%2C%20Australia!5e0!3m2!1sen!2s!4v1574408946759!5m2!1sen!2s" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- End Contact Page Section -->

    <!-- Include Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Toastify JS -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <script>
        $(document).ready(function(){
            $('#contact-form').on('submit', function(e){
                e.preventDefault();  // Prevent form from reloading the page

                var formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right", 
                            backgroundColor: "#28a745",
                        }).showToast();
                        $('#contact-form')[0].reset();
                    },
                    error: function(xhr) {
                        Toastify({
                            text: "There was an error sending your request.",
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#dc3545",
                        }).showToast();
                    }
                });
            });
        });
    </script>
</x-layouts.frontend>
