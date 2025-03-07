<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Feedback</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Feedback</li>
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
                                <h5 class="card-title">Feedback Data</h5>
                                <a href="{{ route('admin.feedback.create') }}" class="btn btn-primary">Create New Feedback</a>
                            </div>
                            <div class="mb-3">
                                <input type="text" id="search-input" class="form-control" placeholder="Search feedback...">
                            </div>
                            <div id="feedback-list-container">
                                @include('admin.feedback.partials.feedback_list', ['feedbacks' => $feedbacks])
                            </div>
                        </div><!-- End card-body -->
                    </div><!-- End card -->
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            let query = this.value;
            fetch("{{ route('admin.feedback.filter') }}?search=" + encodeURIComponent(query))
                .then(response => response.text())
                .then(html => {
                    document.getElementById('feedback-list-container').innerHTML = html;
                })
                .catch(error => console.error('Error fetching filtered feedback:', error));
        });
    </script>
</x-layouts.admin>
