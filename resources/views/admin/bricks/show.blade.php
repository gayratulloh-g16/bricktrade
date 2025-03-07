<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Brick Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bricks.index') }}">Bricks</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Brick Details</h5>
                            
                            <div class="mb-3">
                                <p><strong>Name (UZ):</strong> {{ $brick->name_uz }}</p>
                                <p><strong>Name (RU):</strong> {{ $brick->name_ru }}</p>
                                <p><strong>Name (EN):</strong> {{ $brick->name_en }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <p><strong>Price:</strong> {{ $brick->price }}</p>
                                <p><strong>Residual:</strong> {{ $brick->residual }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Description (UZ):</h6>
                                <div>{!! $brick->description_uz !!}</div>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Description (RU):</h6>
                                <div>{!! $brick->description_ru !!}</div>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Description (EN):</h6>
                                <div>{!! $brick->description_en !!}</div>
                            </div>
                            
                            <div class="mb-3">
                                <p><strong>Created At:</strong> {{ $brick->created_at->format('Y-m-d') }}</p>
                            </div>
                            
                            <div class="mb-3">
                                <h6>Images:</h6>
                                <div class="row">
                                    @foreach ($brick->images as $image)
                                        <div class="col-md-3 mb-2">
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $brick->name_en }}" class="img-thumbnail">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="d-flex">
                                <a href="{{ route('admin.bricks.edit', $brick->id) }}" class="btn btn-warning me-2">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="{{ route('admin.bricks.index') }}" class="btn btn-secondary">
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
