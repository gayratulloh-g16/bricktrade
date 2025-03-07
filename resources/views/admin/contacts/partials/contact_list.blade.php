<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone Number</th>
                <th>Message</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone_number }}</td>
                    <td>{{ $contact->text }}</td>
                    <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-info" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.contacts.edit', $contact->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this contact?');">
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
                    <td colspan="5" class="text-center">No contacts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $contacts->links() }}
    </div>
</div>
