<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Name (EN)</th>
                <th>Name (RU)</th>
                <th>Name (UZ)</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->name_en }}</td>
                    <td>{{ $category->name_ru }}</td>
                    <td>{{ $category->name_uz }}</td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-info"
                            title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
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
                    <td colspan="3" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>
