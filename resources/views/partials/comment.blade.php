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
