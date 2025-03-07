<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Brick</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bricks.index') }}">Bricks</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Brick</h5>
                            <form id="brick-form" action="{{ route('admin.bricks.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                                @csrf
                                <div class="col-md-4">
                                    <label for="name_uz" class="form-label">Name (UZ)</label>
                                    <input type="text" class="form-control" id="name_uz" name="name_uz" value="{{ old('name_uz') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="name_ru" class="form-label">Name (RU)</label>
                                    <input type="text" class="form-control" id="name_ru" name="name_ru" value="{{ old('name_ru') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="name_en" class="form-label">Name (EN)</label>
                                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="residual" class="form-label">Residual</label>
                                    <input type="number" class="form-control" id="residual" name="residual" value="{{ old('residual') }}" required>
                                </div>
                                <!-- Quill Editor for Description (UZ) -->
                                <div class="col-12">
                                    <label for="description_uz" class="form-label">Description (UZ)</label>
                                    <div id="editor_description_uz" style="height: 150px;">{!! old('description_uz') !!}</div>
                                    <input type="hidden" name="description_uz" id="description_uz">
                                </div>
                                <!-- Quill Editor for Description (RU) -->
                                <div class="col-12">
                                    <label for="description_ru" class="form-label">Description (RU)</label>
                                    <div id="editor_description_ru" style="height: 150px;">{!! old('description_ru') !!}</div>
                                    <input type="hidden" name="description_ru" id="description_ru">
                                </div>
                                <!-- Quill Editor for Description (EN) -->
                                <div class="col-12">
                                    <label for="description_en" class="form-label">Description (EN)</label>
                                    <div id="editor_description_en" style="height: 150px;">{!! old('description_en') !!}</div>
                                    <input type="hidden" name="description_en" id="description_en">
                                </div>
                                <div class="col-12">
                                    <label for="images" class="form-label">Brick Images</label>
                                    <input type="file" class="form-control" id="images" name="images[]" multiple required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Brick</button>
                                    <a href="{{ route('admin.bricks.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>

    <!-- Include Quill library from CDN if not already included -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
        // Initialize Quill editors for each description field
        var quillUz = new Quill('#editor_description_uz', {
            theme: 'snow'
        });
        var quillRu = new Quill('#editor_description_ru', {
            theme: 'snow'
        });
        var quillEn = new Quill('#editor_description_en', {
            theme: 'snow'
        });

        // On form submit, update the hidden inputs with the HTML content from Quill editors.
        document.getElementById('brick-form').addEventListener('submit', function(e) {
            document.getElementById('description_uz').value = quillUz.root.innerHTML;
            document.getElementById('description_ru').value = quillRu.root.innerHTML;
            document.getElementById('description_en').value = quillEn.root.innerHTML;
        });
    </script>
</x-layouts.admin>
