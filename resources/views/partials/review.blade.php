<div class="comment-box">
    <div class="comment">
        <div class="author-thumb">
            <img src="{{ $review->user->image ? asset('/storage/' . $review->user->image) : '/frontend/assets/images/resource/author-default.jpg' }}" alt="">
        </div>
        <div class="comment-inner">
            <div class="comment-info clearfix">
                {{ $review->user->first_name }} {{ $review->user->last_name }} – {{ $review->created_at->format('M d, Y') }}:
            </div>
            <div class="rating">
                @for($i = 0; $i < $review->rating; $i++)
                    <span class="fa fa-star" style="color: yellow;"></span>
                @endfor
                @for($i = $review->rating; $i < 5; $i++)
                    <span class="fa fa-star" style="color: grey;"></span>
                @endfor
            </div>
            <div class="text">
                {{ $review->text }}
            </div>
        </div>
    </div>
</div>
