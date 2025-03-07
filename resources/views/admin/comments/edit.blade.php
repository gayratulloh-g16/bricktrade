<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Comment</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.comments.index') }}">Comments</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Comment</h5>
                            <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST"
                                class="row g-3">
                                @csrf
                                @method('PUT')
                                <div class="col-md-6">
                                    <label for="blog_id" class="form-label">Blog</label>
                                    <select name="blog_id" id="blog_id" class="form-select" required>
                                        <option value="">Select Blog</option>
                                        @foreach ($blogs as $blog)
                                            <option value="{{ $blog->id }}"
                                                {{ old('blog_id', $comment->blog_id) == $blog->id ? 'selected' : '' }}>
                                                {{ $blog->title_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ old('first_name', $comment->first_name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ old('last_name', $comment->last_name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $comment->email) }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="comment" class="form-label">Comment</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ old('comment', $comment->comment) }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Comment</button>
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
