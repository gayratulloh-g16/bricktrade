<x-layouts.frontend>
    <!-- Page Title -->
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.blog_detail')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home')}}">{{ __('main.home')}}</a></li>
            <li>{{__('main.blog_detail')}}</li>
        </ul>
    </section>
    <!-- End Page Title -->

    <!-- Sidebar Page Container -->
    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row clearfix">

                <!-- Content Side -->
                <div class="content-side col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-detail">
                        <div class="inner-box">
                            
                            <div class="image" >
                                <img  src="{{ asset('/storage/'. $blog->image ) }}" alt="">
                            </div>
                            <div class="lower-content">
                                <h4>{{ $blog['title_'.app()->getLocale() ]}}</h4>
                                <ul class="post-meta">
                                    <li><span class="icon fa fa-user"></span>{{ $blog->category['name_'.app()->getLocale()]}}</li>
                                    <li><span class="icon fa fa-comment"></span>{{ $blog->comments->count() }} Comments</li>
                                </ul>
                                <p>{!! $blog['text_'.app()->getLocale() ]!!}</p>
                            </div>
                        </div>
                        <div class="comments-area">
                            <div class="group-title">
                                <h5>{{__('main.read_comments')}}</h5>
                            </div>
                            <!-- Existing comments will be here -->
                            @foreach($blog->comments as $comment)
                                <div class="comment-box">
                                    <div class="comment">
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix">
                                                {{ $comment->first_name }} {{ $comment->last_name }} – {{ $comment->created_at->format('M d, Y') }}:
                                            </div>
                                            <div class="text">
                                                {{ $comment->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>

                    <!-- Comment Form -->
                    <div class="comment-form">
                        <div class="group-title">
                            <h5>{{__('main.add_your_comments')}}</h5>
                            <div class="separator"></div>
                        </div>
                        
                        <form id="commentForm" method="post" action="{{ route('blog.comment.store') }}">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>{{__('main.first_name')}}*</label>
                                    <input type="text" name="first_name" placeholder="" required>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                    <label>{{__('main.last_name')}}*</label>
                                    <input type="text" name="last_name" placeholder="" required>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label>{{__('main.email')}}*</label>
                                    <input type="email" name="email" placeholder="" required>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <label>{{__('main.your_comments')}}*</label>
                                    <textarea name="comment" placeholder="" required></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                    <button class="theme-btn btn-style-three" type="submit" name="submit-form">
                                        <span class="txt">{{__('main.post_comment')}}</span>
                                    </button>
                                </div>
                                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            </div>
                        </form>
                    </div>
                    
                </div>

                <!-- Sidebar Side -->
                <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
                    <aside class="sidebar">
                        <!-- Post Widget -->
                        <div class="sidebar-widget post-widget">
                            <!-- Sidebar Title -->
                            <div class="title-box">
                                <h4>{{__('main.recent_posts')}}</h4>
                            </div>
                            <div class="widget-content">
                                @foreach ($blogs as $blog)  
                                <div class="post">
                                    <div class="thumb"><a href="{{ route('blog-detail', $blog->id )}}"><img
                                                src="{{ asset('/storage/'.$blog->image )}}"
                                                alt=""></a>
                                    </div>
                                    <h6><a href="{{ route('blog-detail', $blog->id )}}">{{ $blog['title_'. app()->getLocale()]}}</a></h6>
                                    <div class="post-date">{{ $blog->created_at->format('d M Y')}}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar-widget categories-widget">
                            <div class="widget-content">
                                <!-- Sidebar Title -->
                                <div class="title-box">
                                    <h4>{{__('main.categories')}}</h4>
                                </div>
                                <ul class="blog-cat-two">
                                    @foreach ($categories as $category)
                                    <li class="active"><a href="{{ route('blog-detail', $blog->id) }}">{{ $category['name_'.app()->getLocale()]}}<span>{{ $category->blogs->count() }}</span></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Categories Widget -->
                        {{-- <div class="sidebar-widget categories-widget">
                            <div class="widget-content">
                                <!-- Sidebar Title -->
                                <div class="title-box">
                                    <h4>useful links</h4>
                                </div>
                                <ul class="blog-cat-two">
                                    <li class="active"><a href="accurate-measurements.html">Our
                                            Founder<span>12</span></a></li>
                                    <li><a href="waste-removal.html">Construction<span>15</span></a></li>
                                    <li><a href="warranty-service.html">Entrepreneurship<span>05</span></a></li>
                                    <li><a href="project-planning.html">FAQ’s<span>34</span></a></li>
                                    <li><a href="constant-maintenance.html">Design &
                                            /frontend/Assets<span>11</span></a></li>
                                </ul>
                            </div>
                        </div> --}}

                        <!-- Company Widget -->
                        {{-- <div class="sidebar-widget company-widget">
                            <!-- Sidebar Title -->
                            <div class="title-box">
                                <h4>Company Projects</h4>
                            </div>
                            <div class="widget-content">

                                <!-- Project Widget -->
                                <div class="project-widget">
                                    <div class="inner-box">
                                        <div class="image">
                                            <img src="/frontend/assets/images/gallery/35.jpg" alt="">
                                            <div class="overlay-box">
                                                <div class="content">
                                                    <h5><a href="#">LifeChurch Phase 2A, Gymnatorium</a></h5>
                                                    <div class="role">Our Role: <span>Design-Build</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Project Widget -->
                                <div class="project-widget">
                                    <div class="inner-box">
                                        <div class="image">
                                            <img src="/frontend/assets/images/gallery/36.jpg" alt="">
                                            <div class="overlay-box">
                                                <div class="content">
                                                    <h5><a href="#">Dassault Falcon Storage Training Addition</a>
                                                    </h5>
                                                    <div class="role">Our Role: <span>Design-Build</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> --}}


                        <!-- Subscribe Widget -->
                        {{-- <div class="sidebar-widget subscribe-widget">
                            <h5>Subscribe Now to Get <br> Daily Updates.</h5>
                            <!-- Email Form -->
                            <div class="email-form">
                                <form method="post" action="contact.html">
                                    <div class="form-group">
                                        <input type="email" name="email" value=""
                                            placeholder="Enter Your Email Address" required="">
                                        <button type="submit" class="theme-btn btn-style-one"><span
                                                class="txt">Subscribe Now</span></button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                    </aside>
                </div>

            </div>
        </div>
    </div>
    <!-- End Sidebar Page Container -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function(){
        $('#commentForm').on('submit', function(e){
            e.preventDefault(); 
            var formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    $('.comments-area').append(response.comment_html);
                    $('#commentForm')[0].reset();
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
    </script>

</x-layouts.frontend>
