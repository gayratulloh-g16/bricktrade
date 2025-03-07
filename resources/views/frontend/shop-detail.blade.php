<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.shop_detail')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{__('main.shop_detail')}}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="shop-single">
                        <div class="product-details">

                            <!-- Basic Details -->
                            <div class="basic-details">
                                <div class="row clearfix">
                                    <!-- Image Column -->
                                    <div class="image-column col-lg-6 col-md-6 col-sm-12">
                                        @if ($brick->images->count() > 0)
                                            <div id="brickImagesCarousel" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($brick->images as $key => $image)
                                                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                                            <figure class="image-box">
                                                                <a href="{{ asset('/storage/' . $image->image) }}"
                                                                    class="lightbox-image" title="Image Caption Here">
                                                                    <img src="{{ asset('/storage/' . $image->image) }}"
                                                                        alt="Brick Image">
                                                                </a>
                                                            </figure>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!-- Carousel Controls -->
                                                <a class="carousel-control-prev" href="#brickImagesCarousel"
                                                    role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#brickImagesCarousel"
                                                    role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        @else
                                            <figure class="image-box">
                                                <a href="/frontend/assets/images/resource/products/10.jpg"
                                                    class="lightbox-image" title="Default Image">
                                                    <img src="/frontend/assets/images/resource/products/10.jpg"
                                                        alt="Default Brick Image">
                                                </a>
                                            </figure>
                                        @endif
                                    </div>

                                    <!-- Info Column -->
                                    <div class="info-column col-lg-6 col-md-6 col-sm-12">
                                        <div class="details-header">
                                            <h4>{{ $brick['name_' . app()->getLocale()] }}</h4>
                                            <div class="rating">
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star"></span>
                                                <span class="fa fa-star-half-empty"></span>
                                            </div>
                                            <div class="item-price">{{ $brick->price }} So'm</div>
                                        </div>


                                        <div class="expired">{{__('main.expected_delivery')}}</div>
                                        <div class="other-options clearfix">
                                            <div class="item-quantity">
                                                <!-- You may use a jQuery spinner plugin here if desired -->
                                                <input class="quantity-spinner" type="text" value="1" name="quantity" id="productQuantity">
                                            </div>
                                            <button type="button" class="theme-btn btn-style-three add-to-cart" data-product-id="{{ $brick->id }}">
                                                <span class="txt">{{__('main.add_to_cart')}}</span>
                                            </button>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic Details -->


                            <!--Product Info Tabs-->
                            <div class="product-info-tabs">
                                <!--Product Tabs-->
                                <div class="prod-tabs tabs-box">
                                    <!--Tab Btns-->
                                    <ul class="tab-btns tab-buttons clearfix">
                                        <li data-tab="#prod-details" class="tab-btn active-btn">{{__('main.description')}}</li>
                                        <li data-tab="#prod-reviews" class="tab-btn">{{ __('main.reviews') }} ({{ $brick->reviews->count() }})</li>
                                    </ul>

                                    <!--Tabs Container-->
                                    <div class="tabs-content">
                                        <!--Tab / Active Tab-->
                                        <div class="tab active-tab" id="prod-details">
                                            <div class="content">
                                                <p>{!! $brick['description_' . app()->getLocale()] !!}</p>
                                            </div>
                                        </div>

                                        <!--Tab-->
                                        <!-- Review Tab -->
                                        <div class="tab" id="prod-reviews">
                                            <h2 class="title">{{ __('main.reviews') }} ({{ $brick->reviews->count() }})
                                            </h2>

                                            <!-- Reviews Container -->
                                            <div class="comments-area">
                                                @foreach ($brick->reviews as $review)
                                                    @include('partials.review', ['review' => $review])
                                                @endforeach
                                            </div>

                                            <!-- Review Form -->
                                            @if (auth()->check())
                                                @php
                                                    $hasPurchased = \App\Models\OrderItem::where('brick_id', $brick->id)
                                                        ->whereHas('order', function ($q) {
                                                            $q->where('user_id', auth()->id());
                                                        })
                                                        ->exists();
                                                    $hasReviewed = $brick
                                                        ->reviews()
                                                        ->where('user_id', auth()->id())
                                                        ->exists();
                                                @endphp

                                                @if ($hasPurchased)
                                                    <div class="shop-comment-form">
                                                        <h4>{{ __('main.add_your_review') }}</h4>
                                                        <div class="rating-box">
                                                            <div class="text">{{ __('main.your_rating') }}</div>
                                                            <!-- Dynamic Star Rating -->
                                                            <div class="rating">
                                                                <a href="#" data-rating="1"><span
                                                                        class="fa fa-star"></span></a>
                                                                <a href="#" data-rating="2"><span
                                                                        class="fa fa-star"></span></a>
                                                                <a href="#" data-rating="3"><span
                                                                        class="fa fa-star"></span></a>
                                                                <a href="#" data-rating="4"><span
                                                                        class="fa fa-star"></span></a>
                                                                <a href="#" data-rating="5"><span
                                                                        class="fa fa-star"></span></a>
                                                            </div>
                                                        </div>
                                                        <form id="reviewForm" method="post"
                                                            action="{{ route('review.store', $brick->id) }}">
                                                            @csrf
                                                            <!-- Hidden input to capture rating value -->
                                                            <input type="hidden" id="ratingInput" name="rating"
                                                                value="0">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                                    <label>{{ __('main.your_review') }}*</label>
                                                                    <textarea name="text" placeholder="{{ __('main.review_placeholder') }}" required></textarea>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                                                    <button class="theme-btn btn-style-three"
                                                                        type="submit" name="submit-form">
                                                                        <span
                                                                            class="txt">{{ __('main.submit_review') }}</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                @else
                                                    <p>{{ __('main.purchase_required_review') }}</p>
                                                @endif
                                            @else
                                                <p>{{ __('main.login_required_review') }} <a
                                                        href="{{ route('frontend.login') }}">{{ __('main.login') }}</a>
                                                </p>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--End Product Info Tabs-->

                        </div>
                    </div>
                </div>
                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <!-- Categories Widget -->
                        <div class="sidebar-widget categories-widget">
                            <div class="widget-content">
                                <!-- Sidebar Title -->
                                <div class="title-box">
                                    <h4>{{ __('main.categories') }}</h4>
                                </div>
                                <ul class="blog-cat-two">
                                    @foreach ($categories as $category)
                                        <li class="active"><a
                                                href="{{ route('blog') }}">{{ $category['name_' . app()->getLocale()] }}<span>{{ $category->blogs->count() }}</span></a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Categories Widget -->
                        <div class="sidebar-widget categories-widget">
                            <div class="widget-content">
                                <!-- Sidebar Title -->
                                <div class="title-box">
                                    <h4>{{__('main.useful_links')}}</h4>
                                </div>
                                <ul class="blog-cat-two">
                                    <li class="active"><a href="{{ route('home')}}">{{__('main.home')}}</a></li>
                                    <li><a href="{{ route('about')}}">{{__('main.about')}}</a></li>
                                    <li><a href="{{ route('shop')}}">{{__('main.shop')}}</a></li>
                                    <li><a href="{{ route('blog')}}">{{__('main.blog')}}</a></li>
                                    <li><a href="{{ route('contact')}}">{{__('main.contact')}}</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Subscribe Widget -->
                        <div class="sidebar-widget subscribe-widget">
                            <h5>{{ __('main.contact_sidebar_heading') }}</h5>
                            <!-- Email Form (or simply a button linking to the contact page) -->
                            <div class="email-form">
                                <form method="post" action="{{ route('contact') }}">
                                    <div class="form-group">
                                        <a href="{{ route('contact') }}" class="theme-btn btn-style-one col-md-12">
                                            <span class="txt">{{ __('main.contact_us') }}</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>

            </div>
        </div>
    </div>
    <!-- End Sidebar Page Container -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // When any tab button is clicked
            $('.tab-btn').on('click', function() {
                // Get the target tab selector from the data-tab attribute
                var targetTab = $(this).data('tab');

                // Remove active class from all tab buttons and tabs
                $('.tab-btn').removeClass('active-btn');
                $('.tab').removeClass('active-tab');

                // Add active class to the clicked tab button and the corresponding tab content
                $(this).addClass('active-btn');
                $(targetTab).addClass('active-tab');
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Optionally include Toastify for notifications -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Optionally include Toastify for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        // Reusable function to initialize dynamic star rating behavior
        function setupRating(ratingSelector, hiddenInputSelector) {
            $(ratingSelector).on('click', function(e) {
                e.preventDefault();
                var rating = $(this).data('rating');
                $(hiddenInputSelector).val(rating);
                // Remove highlight from all stars
                $(ratingSelector + ' span.fa').removeClass('text-warning');
                // Highlight stars up to the selected rating
                $(ratingSelector).each(function() {
                    if ($(this).data('rating') <= rating) {
                        $(this).find('span.fa').addClass('text-warning');
                    }
                });
            });
        }

        $(document).ready(function() {
            // Initialize dynamic star rating for review form
            setupRating('.rating a', '#ratingInput');

            // AJAX submission for review form
            $('#reviewForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        // Append the new review HTML to the reviews container
                        $('.comments-area').append(response.review_html);
                        Toastify({
                            text: response.message,
                            duration: 3000,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#28a745",
                        }).showToast();
                        // Reset the review form and star rating
                        $('#reviewForm')[0].reset();
                        $('#ratingInput').val(0);
                        $('.rating a span.fa').removeClass('text-warning');
                    },
                    error: function(xhr) {
                        Toastify({
                            text: xhr.responseJSON.message ||
                                "Error submitting review.",
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
