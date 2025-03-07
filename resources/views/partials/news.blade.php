@forelse($blogs as $blog)
    <div class="post-item clearfix">
        <img src="{{ $blog->image ? asset('/storage/' . $blog->image) : '/frontend/assets/images/default-news.jpg' }}" alt="">
        <h4>
            <a href="#" class="text-primary">
                {{ $blog->title_en }}
            </a>
        </h4>
        <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->text_en), 100) }}</p>
    </div>
@empty
    <p>No news available.</p>
@endforelse
