<x-layouts.admin>
    <main id="main" class="main">
    
      <div class="pagetitle">
        <h1>Create Category</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
    
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Create New Category</h5>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="row g-3">
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
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create Category</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
                  </div>
                </form>
              </div><!-- End Card Body -->
            </div><!-- End Card -->
          </div>
        </div>
      </section>
    
    </main>
  </x-layouts.admin>
  