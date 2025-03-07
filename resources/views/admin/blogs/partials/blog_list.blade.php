<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Title (EN)</th>
                <th>Category</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
                <tr>
                    <td>{{ $blog->title_en }}</td>
                    <td>{{ optional($blog->category)->name_en }}</td>
                    <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this blog?');">
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
                    <td colspan="4" class="text-center">No blogs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $blogs->links() }}
    </div>
</div>
