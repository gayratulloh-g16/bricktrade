<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blog Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title_en }}</h5>
                            @if ($blog->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title_en }}"
                                        class="img-fluid rounded">
                                </div>
                            @endif
                            <div class="mb-3">
                                <p><strong>Category:</strong> {{ optional($blog->category)->name_en }}</p>
                                <p><strong>Title (UZ):</strong> {{ $blog->title_uz }}</p>
                                <p><strong>Title (RU):</strong> {{ $blog->title_ru }}</p>
                                <p><strong>Title (EN):</strong> {{ $blog->title_en }}</p>
                                <p><strong>Content (EN):</strong></p>
                                <div>{!! $blog->text_en !!}</div>
                                <p><strong>Content (RU):</strong></p>
                                <div>{!! $blog->text_ru !!}</div>
                                <p><strong>Content (UZ):</strong></p>
                                <div>{!! $blog->text_uz !!}</div>
                                <p><strong>Created At:</strong> {{ $blog->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                    class="btn btn-warning me-2">Edit</a>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
