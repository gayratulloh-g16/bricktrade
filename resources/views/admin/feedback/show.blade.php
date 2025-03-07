<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Feedback Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Feedback #{{ $feedback->id }}</h5>
                            <div class="mb-3">
                                <p><strong>User:</strong> {{ optional($feedback->user)->first_name }} {{ optional($feedback->user)->last_name }}</p>
                                <p><strong>Order ID:</strong> {{ $feedback->order_id }}</p>
                                <p><strong>Rating:</strong> {{ $feedback->rating }}</p>
                                <p><strong>Feedback:</strong></p>
                                <p>{{ $feedback->text }}</p>
                                <p><strong>Created At:</strong> {{ $feedback->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.feedback.edit', $feedback->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">
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
