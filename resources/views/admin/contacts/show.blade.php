<x-layouts.admin>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Contact Details</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.contacts.index') }}">Contacts</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $contact->name }}</h5>
                            <div class="mb-3">
                                <p><strong>Phone Number:</strong> {{ $contact->phone_number }}</p>
                                <p><strong>Message:</strong></p>
                                <p>{{ $contact->text }}</p>
                                <p><strong>Created At:</strong> {{ $contact->created_at->format('Y-m-d') }}</p>
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('admin.contacts.edit', $contact->id) }}"
                                    class="btn btn-warning me-2">Edit</a>
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>

    </main>
</x-layouts.admin>
