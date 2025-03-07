<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{ __('main.shop') }}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home') }}</a></li>
            <li>{{ __('main.shop') }}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Shop Section -->
    <section class="shop-section">
        <div class="auto-container">
            <div class="row clearfix">
                <!-- Shop Block -->
                @foreach ($bricks as $brick)
                    <div class="shop-block col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <a href="{{ route('shop-detail', $brick->id) }}"><img
                                        src="{{ asset('/storage/' . $brick->images->first()->image) }}"
                                        alt=""></a>
                            </div>
                            <div class="lower-content">
                                <div class="price">{{ $brick->price }} So'm</div>
                                <h5><a
                                        href="{{ route('shop-detail', $brick->id) }}">{{ $brick['name_' . app()->getLocale()] }}</a>
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Shop Section -->
</x-layouts.frontend>
