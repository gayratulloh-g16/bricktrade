<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Company</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.companies.index') }}">Companies</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Company</h5>
                            <form action="{{ route('admin.companies.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}" step="0.01" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Company</button>
                                    <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
