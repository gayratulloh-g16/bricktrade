<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Name (EN)</th>
                <th>Price</th>
                <th>Residual</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bricks as $brick)
                <tr>
                    <td>{{ $brick->name_en }}</td>
                    <td>{{ $brick->price }}</td>
                    <td>{{ $brick->residual }}</td>
                    <td>{{ $brick->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.bricks.show', $brick->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.bricks.edit', $brick->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.bricks.destroy', $brick->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this brick?');">
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
                    <td colspan="5" class="text-center">No bricks found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $bricks->links() }}
    </div>
</div>
