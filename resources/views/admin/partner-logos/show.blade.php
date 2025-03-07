<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Partner Logo Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.partner-logos.index') }}">Partner Logos</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $partnerLogo->name }}</h5>
                            @if ($partnerLogo->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $partnerLogo->image) }}"
                                        alt="{{ $partnerLogo->name }}" class="img-fluid rounded"
                                        style="max-width: 300px;">
                                </div>
                            @endif
                            <div class="mb-3">
                                <p><strong>Name:</strong> {{ $partnerLogo->name }}</p>
                                <p><strong>Created At:</strong> {{ $partnerLogo->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.partner-logos.edit', $partnerLogo->id) }}"
                                    class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.partner-logos.index') }}" class="btn btn-secondary">
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
