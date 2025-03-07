<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Customers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Customers</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title">Customers Data</h5>
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Create New
                                    Customer</a>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="search-input" class="form-control"
                                    placeholder="Search customers...">
                            </div>
                            <div id="user-list-container">
                                @include('admin.users.partials.user_list', ['customers' => $customers])
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            let query = this.value;
            fetch("{{ route('admin.users.filter') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    document.getElementById('user-list-container').innerHTML = html;
                })
                .catch(error => console.error('Error fetching filtered customers:', error));
        });
    </script>
</x-layouts.admin>
