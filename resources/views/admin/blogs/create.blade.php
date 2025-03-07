<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Blog</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blogs</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Global Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Blog</h5>
                            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data"
                                class="row g-3" id="blog-form">
                                @csrf
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="title_en" class="form-label">Title (EN)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en"
                                        value="{{ old('title_en') }}" required>
                                    @error('title_en')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="title_ru" class="form-label">Title (RU)</label>
                                    <input type="text" class="form-control" id="title_ru" name="title_ru"
                                        value="{{ old('title_ru') }}" required>
                                    @error('title_ru')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="title_uz" class="form-label">Title (UZ)</label>
                                    <input type="text" class="form-control" id="title_uz" name="title_uz"
                                        value="{{ old('title_uz') }}" required>
                                    @error('title_uz')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Quill Editor for Content (EN) -->
                                <div class="col-12">
                                    <label for="editor_text_en" class="form-label">Content (EN)</label>
                                    <div id="editor_text_en" style="height: 200px;">{!! old('text_en') !!}</div>
                                    <input type="hidden" name="text_en" id="text_en">
                                    @error('text_en')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Quill Editor for Content (RU) -->
                                <div class="col-12">
                                    <label for="editor_text_ru" class="form-label">Content (RU)</label>
                                    <div id="editor_text_ru" style="height: 200px;">{!! old('text_ru') !!}</div>
                                    <input type="hidden" name="text_ru" id="text_ru">
                                    @error('text_ru')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <!-- Quill Editor for Content (UZ) -->
                                <div class="col-12">
                                    <label for="editor_text_uz" class="form-label">Content (UZ)</label>
                                    <div id="editor_text_uz" style="height: 200px;">{!! old('text_uz') !!}</div>
                                    <input type="hidden" name="text_uz" id="text_uz">
                                    @error('text_uz')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Blog</button>
                                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>

    <!-- Include Quill CSS and JS (if not already in your layout) -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Initialize Quill editors for each content field
        var quillEn = new Quill('#editor_text_en', {
            theme: 'snow'
        });
        var quillRu = new Quill('#editor_text_ru', {
            theme: 'snow'
        });
        var quillUz = new Quill('#editor_text_uz', {
            theme: 'snow'
        });

        // When the form is submitted, copy each editor's HTML content to its hidden input
        document.getElementById('blog-form').addEventListener('submit', function() {
            document.getElementById('text_en').value = quillEn.root.innerHTML;
            document.getElementById('text_ru').value = quillRu.root.innerHTML;
            document.getElementById('text_uz').value = quillUz.root.innerHTML;
        });
    </script>
</x-layouts.admin>
