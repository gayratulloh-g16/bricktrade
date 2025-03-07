<x-layouts.admin>
    <main id="main" class="main">
      <div class="pagetitle">
        <h1>Comments</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Comments</li>
            <li class="breadcrumb-item active">List</li>
          </ol>
        </nav>
      </div>
  
      <section class="section">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5 class="card-title">Comments Data</h5>
                  <a href="{{ route('admin.comments.create') }}" class="btn btn-primary">Create New Comment</a>
                </div>
                <div class="mb-3">
                  <input type="text" id="search-input" class="form-control" placeholder="Search comments...">
                </div>
                <div id="comment-list-container">
                  @include('admin.comments.partials.comment_list', ['comments' => $comments])
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  
    <script>
      document.getElementById('search-input').addEventListener('keyup', function() {
        let query = this.value;
        fetch("{{ route('admin.comments.filter') }}?search=" + encodeURIComponent(query))
          .then(response => response.text())
          .then(html => {
            document.getElementById('comment-list-container').innerHTML = html;
          })
          .catch(error => console.error('Error fetching filtered comments:', error));
      });
    </script>
  </x-layouts.admin>
  