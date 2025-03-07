<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Order</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->id }}</td>
                    <td>{{ optional($feedback->user)->first_name }} {{ optional($feedback->user)->last_name }}</td>
                    <td>{{ optional($feedback->order)->id }}</td>
                    <td>{{ $feedback->rating }}</td>
                    <td>{{ Str::limit($feedback->text, 50) }}</td>
                    <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.feedback.show', $feedback->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.feedback.edit', $feedback->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.feedback.destroy', $feedback->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
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
                    <td colspan="7" class="text-center">No feedback found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $feedbacks->links() }}
    </div>
</div>
