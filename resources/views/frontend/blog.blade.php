<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.our_blog')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{ __('main.home')}}</a></li>
            <li>{{__('main.blog')}}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">

            <div class="row clearfix">
                @foreach ($blogs as $blog )
                <!-- News Block -->
                <div class="news-block-two col-lg-4 col-md-6 col-sm-12">
                    <div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="image">
                            <a href="{{ route('blog-detail', $blog->id)}}"><img src="{{ asset('/storage/'. $blog->image )}}" alt=""></a>
                            <div class="post-date">{{ $blog->created_at->format('d M Y')}}</div>
                        </div>
                        <div class="lower-content">
                            <ul class="post-meta">
                                <li><span class="icon fa fa-user"></span>{{ $blog->category['name_'. app()->getLocale() ]}}</li>
                                <li><span class="icon fa fa-comment"></span>{{ $blog->comments->count()}} {{__('main.comments')}}</li>
                            </ul>
                            <h4><a href="{{ route('blog-detail', $blog->id)}}">{{ $blog['title_'. app()->getLocale()]}}</a></h4>
                            <div class="text">
                                <!-- Limit words to 20 -->
                                {!! implode(' ', array_slice(explode(' ', strip_tags($blog['text_'. app()->getLocale()])), 0, 20)) !!}...
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Button Box -->
            <div class="button-box text-center">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
    <!-- End News Section -->
</x-layouts.frontend>
