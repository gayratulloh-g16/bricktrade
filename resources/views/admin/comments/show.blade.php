<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Comment Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comment->first_name }} {{ $comment->last_name }}</h5>
                            <div class="mb-3">
                                <p><strong>Blog:</strong> {{ optional($comment->blog)->title_en }}</p>
                                <p><strong>Email:</strong> {{ $comment->email }}</p>
                                <p><strong>Comment:</strong></p>
                                <p>{{ $comment->comment }}</p>
                                <p><strong>Created At:</strong> {{ $comment->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
