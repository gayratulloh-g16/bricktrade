<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.about') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{ __('main.about') }}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Experiance Section Two / Style Two -->
    <section class="experiance-section-two style-two">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <div class="title">South-central construction region since 2009</div>
                            <h2>Comfortable <span>joining</span> <br> in one open space.</h2>
                            <div class="text">USA Construction Company, Inc. was founded in 2003 and quickly
                                established a reputation for top quality work. Throughout our history, one philosophy
                                has remained Predominant, Total Quality Performance. Lorem ipsum dolor sit amet,
                                consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.</div>
                        </div>
                        <!-- Fact Counter / Style Three -->
                        <div class="fact-counter style-three">
                            <div class="row clearfix">

                                <!-- Column -->
                                <div class="column counter-column col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                                        <div class="content">
                                            <div class="icon flaticon-helmet"></div>
                                            <div class="count-outer count-box alternate">
                                                <span class="count-text" data-speed="5000" data-stop="2854">0</span>+
                                            </div>
                                            <h4 class="counter-title">Complete Project</h4>
                                        </div>
                                    </div>
                                </div>

                                <!-- Column -->
                                <div class="column counter-column col-lg-6 col-md-6 col-sm-12">
                                    <div class="inner wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
                                        <div class="content">
                                            <div class="icon flaticon-blueprint"></div>
                                            <div class="count-outer count-box">
                                                <span class="count-text" data-speed="3000" data-stop="3">0</span>M
                                            </div>
                                            <h4 class="counter-title">Company Followers</h4>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>

                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="year-box">
                            <div class="count-box">
                                0<span class="count-text" data-speed="5000" data-stop="8">0</span>
                            </div>
                            <span class="years">Years</span>
                        </div>
                        <div class="image">
                            <img src="/frontend/assets/images/resource/experiance.jpg" alt="">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Experiance Section Two -->
    <!-- Services Section Two -->
    <section class="services-section-two">
        <div class="auto-container">
            <!-- Sec Title -->
            <div class="sec-title centered">
                <span class="icon"><i class="fas fa-cubes"></i></span>
                <h2>{!! __('main.our_bricks_title') !!}</h2>
                <div class="text">{{ __('main.our_bricks_subtext') }}</div>
            </div>

            <div class="services-carousel owl-carousel owl-theme">

                <!-- Superior Quality -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-award"></i></span>
                        <h5>{{ __('main.service_superior_quality_title') }}</h5>
                        <div class="text">{{ __('main.service_superior_quality_text') }}</div>
                    </div>
                </div>

                <!-- Exceptional Durability -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-shield-alt"></i></span>
                        <h5>{{ __('main.service_exceptional_durability_title') }}</h5>
                        <div class="text">{{ __('main.service_exceptional_durability_text') }}</div>
                    </div>
                </div>

                <!-- Eco-Friendly Materials -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-leaf"></i></span>
                        <h5>{{ __('main.service_eco_friendly_title') }}</h5>
                        <div class="text">{{ __('main.service_eco_friendly_text') }}</div>
                    </div>
                </div>

                <!-- Design Flexibility -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-pencil-ruler"></i></span>
                        <h5>{{ __('main.service_design_flexibility_title') }}</h5>
                        <div class="text">{{ __('main.service_design_flexibility_text') }}</div>
                    </div>
                </div>

                <!-- Energy Efficiency -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-sun"></i></span>
                        <h5>{{ __('main.service_energy_efficiency_title') }}</h5>
                        <div class="text">{{ __('main.service_energy_efficiency_text') }}</div>
                    </div>
                </div>

                <!-- Innovative Solutions -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-lightbulb"></i></span>
                        <h5>{{ __('main.service_innovative_solutions_title') }}</h5>
                        <div class="text">{{ __('main.service_innovative_solutions_text') }}</div>
                    </div>
                </div>

                <!-- Custom Orders -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-edit"></i></span>
                        <h5>{{ __('main.service_custom_orders_title') }}</h5>
                        <div class="text">{{ __('main.service_custom_orders_text') }}</div>
                    </div>
                </div>

                <!-- Expert Guidance -->
                <div class="service-block-two">
                    <div class="inner-box">
                        <span class="icon"><i class="fas fa-headset"></i></span>
                        <h5>{{ __('main.service_expert_guidance_title') }}</h5>
                        <div class="text">{{ __('main.service_expert_guidance_text') }}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Services Section Two -->



    <!-- Video Section -->
    <section class="video-section" style="background-image:url(/frontend/assets/images/background/5.jpg)">
        <div class="auto-container">
            <div class="content">
                <h2>{!! __('main.video_section_title') !!}</h2>
                <div class="text">{{ __('main.video_section_text') }}</div>
                <a href="{{ __('main.video_section_video_url') }}" class="lightbox-image video-box">
                    <span class="flaticon-play-button"><i class="ripple"></i></span>
                </a>
            </div>
        </div>
    </section>
    <!-- End Video Section -->



    <!-- Clients Section Two -->
    <section class="clients-section-two style-two">
        <div class="auto-container">
            <!-- Title Box -->
            <div class="title-box">
                <div class="row clearfix">
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="icon flaticon-email"></div>
                        <h2>{!! __('main.clients_section_title') !!}</h2>
                    </div>
                    <!-- Column -->
                    <div class="column col-lg-6 col-md-12 col-sm-12">
                        <div class="text">{{ __('main.clients_section_text') }}</div>
                    </div>
                </div>
            </div>
            <div class="inner-container">
                <div class="sponsors-outer">
                    <!-- Sponsors Carousel -->
                    <ul class="sponsors-carousel owl-carousel owl-theme">
                        @foreach ($logos as $logo)
                            <li class="slide-item">
                                <figure class="image-box">
                                    <a href="#">
                                        <img src="{{ asset('/storage/' . $logo->image) }}" alt="">
                                    </a>
                                </figure>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- End Clients Section Two -->


    <!-- Solution Section -->
    <section class="solution-section" style="background-image:url(/frontend/assets/images/background/4.jpg)">
        <div class="side-image wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
            <img src="/frontend/assets/images/resource/solution.png" alt="">
        </div>
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Title Column -->
                <div class="title-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title">
                            <h2>{!! __('main.solution_title') !!}</h2>
                            <div class="text">{{ __('main.solution_subtitle') }}</div>
                        </div>
                        <!-- Button Box -->
                        <div class="button-box">
                            <a class="btn-style-two theme-btn" href="{{ route('about') }}">
                                <span class="txt">{{ __('main.solution_button_text') }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <!-- Feature Block: Strict Quality Control -->
                        <div class="feature-block">
                            <div class="inner-box">
                                <span class="icon"><i class="fas fa-award"></i></span>
                                <h4>{{ __('main.solution_feature_quality_title') }}</h4>
                                <div class="text">
                                    {{ __('main.solution_feature_quality_text') }}
                                </div>
                            </div>
                        </div>

                        <!-- Feature Block: Sustainable Production -->
                        <div class="feature-block">
                            <div class="inner-box">
                                <span class="icon"><i class="fas fa-leaf"></i></span>
                                <h4>{{ __('main.solution_feature_sustainable_title') }}</h4>
                                <div class="text">
                                    {{ __('main.solution_feature_sustainable_text') }}
                                </div>
                            </div>
                        </div>

                        <!-- Feature Block: Design Flexibility -->
                        <div class="feature-block">
                            <div class="inner-box">
                                <span class="icon"><i class="fas fa-pencil-ruler"></i></span>
                                <h4>{{ __('main.solution_feature_design_title') }}</h4>
                                <div class="text">
                                    {{ __('main.solution_feature_design_text') }}
                                </div>
                            </div>
                        </div>

                        <!-- Feature Block: On-Time Delivery -->
                        <div class="feature-block">
                            <div class="inner-box">
                                <span class="icon"><i class="fas fa-truck"></i></span>
                                <h4>{{ __('main.solution_feature_delivery_title') }}</h4>
                                <div class="text">
                                    {{ __('main.solution_feature_delivery_text') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- End Solution Section -->


    <!-- Team Section Two -->
    {{-- <section class="team-section-two style-two">
        <div class="auto-container">

            <!-- Sec Title -->
            <div class="sec-title centered">
                <span class="icon flaticon-telephone"></span>
                <h2>Our Company <span>Members</span></h2>
                <div class="text">South-central construction region since 2005</div>
            </div>

            <div class="row clearfix">

                <!-- Team Block -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="#"><img src="/frontend/assets/images/resource/team-6.jpg" alt=""></a>
                            <!-- Social Box -->
                            <ul class="social-box">
                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                <li><a href="https://youtube.com/" class="fa fa-youtube-play"></a></li>
                            </ul>
                        </div>
                        <div class="lower-content">
                            <h5><a href="#">Aaron Palmer</a></h5>
                            <div class="designation">Company Manager</div>
                        </div>
                    </div>
                </div>

                <!-- Team Block -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="#"><img src="/frontend/assets/images/resource/team-7.jpg" alt=""></a>
                            <!-- Social Box -->
                            <ul class="social-box">
                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                <li><a href="https://youtube.com/" class="fa fa-youtube-play"></a></li>
                            </ul>
                        </div>
                        <div class="lower-content">
                            <h5><a href="#">Virginia Dunn</a></h5>
                            <div class="designation">Cad Designer</div>
                        </div>
                    </div>
                </div>

                <!-- Team Block -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="#"><img src="/frontend/assets/images/resource/team-8.jpg" alt=""></a>
                            <!-- Social Box -->
                            <ul class="social-box">
                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                <li><a href="https://youtube.com/" class="fa fa-youtube-play"></a></li>
                            </ul>
                        </div>
                        <div class="lower-content">
                            <h5><a href="#">Carig McDonald</a></h5>
                            <div class="designation">Attorney</div>
                        </div>
                    </div>
                </div>

                <!-- Team Block -->
                <div class="team-block col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="#"><img src="/frontend/assets/images/resource/team-9.jpg" alt=""></a>
                            <!-- Social Box -->
                            <ul class="social-box">
                                <li><a href="https://www.facebook.com/" class="fa fa-facebook-f"></a></li>
                                <li><a href="https://www.twitter.com/" class="fa fa-twitter"></a></li>
                                <li><a href="https://www.linkedin.com/" class="fa fa-linkedin"></a></li>
                                <li><a href="https://youtube.com/" class="fa fa-youtube-play"></a></li>
                            </ul>
                        </div>
                        <div class="lower-content">
                            <h5><a href="#">Lesiy Coruug</a></h5>
                            <div class="designation">CEO &t Founder</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Button Box -->
            <div class="button-box text-center">
                <a class="btn-style-two theme-btn" href="projects.html"><span class="txt">More Products</span></a>
            </div>

        </div>
    </section> --}}
    <!-- End Team Section Two -->

</x-layouts.frontend>
