<x-layouts.admin>
    <main id="main" class="main">
  
      <div class="pagetitle">
        <h1>Categories</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Categories</li>
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
                  <h5 class="card-title">Blog Categories</h5>
                  <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Create New Category</a>
                </div>
  
                <div class="mb-3">
                  <input type="text" id="search-input" class="form-control" placeholder="Search categories...">
                </div>
  
                <div id="category-list-container">
                  @include('admin.categories.partials.category_list', ['categories' => $categories])
                </div>
              </div><!-- End card-body -->
            </div><!-- End card -->
  
          </div>
        </div>
      </section>
  
    </main><!-- End #main -->
  
    <script>
      document.getElementById('search-input').addEventListener('keyup', function(){
        let query = this.value;
        fetch("{{ route('admin.categories.filter') }}?search=" + encodeURIComponent(query))
          .then(response => response.text())
          .then(html => {
            document.getElementById('category-list-container').innerHTML = html;
          })
          .catch(error => console.error('Error fetching filtered categories:', error));
      });
    </script>
  </x-layouts.admin>
  