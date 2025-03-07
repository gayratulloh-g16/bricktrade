<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Blogs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Blogs</li>
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
                                <h5 class="card-title">Blogs Data</h5>
                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">Create New Blog</a>
                            </div>

                            <div class="mb-3">
                                <input type="text" id="search-input" class="form-control"
                                    placeholder="Search blogs...">
                            </div>

                            <div id="blog-list-container">
                                @include('admin.blogs.partials.blog_list', ['blogs' => $blogs])
                            </div>
                        </div><!-- End card-body -->
                    </div><!-- End card -->

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            let query = this.value;
            fetch("{{ route('admin.blogs.filter') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    document.getElementById('blog-list-container').innerHTML = html;
                })
                .catch(error => console.error('Error fetching filtered blogs:', error));
        });
    </script>
</x-layouts.admin>
