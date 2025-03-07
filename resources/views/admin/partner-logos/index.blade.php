<x-layouts.admin>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Partner Logos</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Partner Logos</li>
            <li class="breadcrumb-item active">List</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="card-title">Partner Logos Data</h5>
                  <a href="{{ route('admin.partner-logos.create') }}" class="btn btn-primary">Create New Partner Logo</a>
                </div>
                <div class="mb-3">
                  <input type="text" id="search-input" class="form-control" placeholder="Search partner logos...">
                </div>
                <div id="partner-logo-list-container">
                  @include('admin.partner-logos.partials.partner_logo_list', ['partnerLogos' => $partnerLogos])
                </div>
              </div><!-- End card-body -->
            </div><!-- End card -->
          </div>
        </div>
      </section>
    </main>
  
    <script>
      document.getElementById('search-input').addEventListener('keyup', function(){
        let query = this.value;
        fetch("{{ route('admin.partner-logos.filter') }}?search=" + encodeURIComponent(query))
          .then(response => response.text())
          .then(html => {
            document.getElementById('partner-logo-list-container').innerHTML = html;
          })
          .catch(error => console.error('Error fetching filtered partner logos:', error));
      });
    </script>
  </x-layouts.admin>
  