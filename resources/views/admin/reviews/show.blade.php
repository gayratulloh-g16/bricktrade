<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Review Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Review #{{ $review->id }}</h5>
                            <div class="mb-3">
                                <p><strong>User:</strong> {{ optional($review->user)->first_name }} {{ optional($review->user)->last_name }}</p>
                                <p><strong>Brick:</strong> {{ optional($review->brick)->name_en }}</p>
                                <p><strong>Rating:</strong> {{ $review->rating }}</p>
                                <p><strong>Review Text:</strong></p>
                                <p>{{ $review->text }}</p>
                                <p><strong>Created At:</strong> {{ $review->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Back to List
                                </a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
