<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Create Contact</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Contact</h5>
                            <form action="{{ route('admin.contacts.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-4">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="text" class="form-label">Message</label>
                                    <textarea class="form-control" id="text" name="text" rows="4" required>{{ old('text') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Contact</button>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
