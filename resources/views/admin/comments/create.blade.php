<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Comment</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Comment</h5>
                            <form action="{{ route('admin.comments.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="blog_id" class="form-label">Blog</label>
                                    <select name="blog_id" id="blog_id" class="form-select" required>
                                        <option value="">Select Blog</option>
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}"
                                                {{ old('blog_id') == $blog->id ? 'selected' : '' }}>
                                                {{ $blog->title_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Comment</button>
                                    <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
