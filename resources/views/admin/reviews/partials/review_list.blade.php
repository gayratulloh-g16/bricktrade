<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Brick</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ optional($review->user)->first_name }} {{ optional($review->user)->last_name }}</td>
                    <td>{{ optional($review->brick)->name_en }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ Str::limit($review->text, 50) }}</td>
                    <td>{{ $review->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.reviews.edit', $review->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this review?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No reviews found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $reviews->links() }}
    </div>
</div>
