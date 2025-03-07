<x-layouts.admin>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Edit Partner Logo</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.partner-logos.index') }}">Partner Logos</a></li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Edit Partner Logo</h5>
                <form action="{{ route('admin.partner-logos.update', $partnerLogo->id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                  @csrf
                  @method('PUT')
                  <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $partnerLogo->name) }}" required>
                  </div>
                  <div class="col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if($partnerLogo->image)
                      <div class="mt-2">
                        <img src="{{ asset('storage/' . $partnerLogo->image) }}" alt="{{ $partnerLogo->name }}" class="img-thumbnail" style="max-width: 150px;">
                      </div>
                    @endif
                  </div>
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Update Partner Logo</button>
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
  