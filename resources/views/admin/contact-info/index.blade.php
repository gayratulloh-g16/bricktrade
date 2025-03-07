<x-layouts.admin>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Contact Information</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Contact Information</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Manage Contact Information</h5>
                <form action="{{ route('admin.contact-info.update') }}" method="POST" class="row g-3">
                  @csrf
                  @method('PUT')
                  
                  <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" 
                           value="{{ old('address', optional($contactInfo)->address) }}" required>
                  </div>
                  
                  <div class="col-12">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" 
                           value="{{ old('phone_number', optional($contactInfo)->phone_number) }}" required>
                  </div>
                  
                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="{{ old('email', optional($contactInfo)->email) }}" required>
                  </div>
                  
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div><!-- End Card Body -->
            </div><!-- End Card -->
          </div>
        </div>
      </section>
    </main><!-- End #main -->
  </x-layouts.admin>
  