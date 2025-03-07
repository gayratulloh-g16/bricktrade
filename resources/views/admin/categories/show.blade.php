<x-layouts.admin>
    <main id="main" class="main">
    
      <div class="pagetitle">
        <h1>Category Details</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active">Show</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $category->name_en }}</h5>
                <div class="mb-3">
                  <p><strong>Name (UZ):</strong> {{ $category->name_uz }}</p>
                  <p><strong>Name (RU):</strong> {{ $category->name_ru }}</p>
                  <p><strong>Name (EN):</strong> {{ $category->name_en }}</p>
                  <p><strong>Created At:</strong> {{ $category->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="d-flex">
                  <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning me-2">Edit</a>
                  <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
              </div><!-- End Card Body -->
            </div><!-- End Card -->
          </div>
        </div>
      </section>
    
    </main>
  </x-layouts.admin>
  