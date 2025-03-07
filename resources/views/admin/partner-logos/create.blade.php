<x-layouts.admin>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Create Partner Logo</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.partner-logos.index') }}">Partner Logos</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Create New Partner Logo</h5>
                <form action="{{ route('admin.partner-logos.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                  @csrf
                  <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                  </div>
                  <div class="col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Create Partner Logo</button>
                    <a href="{{ route('admin.partner-logos.index') }}" class="btn btn-secondary">Cancel</a>
                  </div>
                </form>
              </div><!-- End Card Body -->
            </div><!-- End Card -->
          </div>
        </div>
      </section>
    </main>
  </x-layouts.admin>
  