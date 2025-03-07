<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Blog</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($comments as $comment)
                <tr>
                    <td>{{ optional($comment->blog)->title_en }}</td>
                    <td>{{ $comment->first_name }}</td>
                    <td>{{ $comment->last_name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ Str::limit($comment->comment, 50) }}</td>
                    <td>{{ $comment->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-sm btn-info"
                            title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this comment?');">
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
                    <td colspan="7" class="text-center">No comments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
</div>
