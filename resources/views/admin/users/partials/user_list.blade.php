<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>City</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->city }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.users.show', $customer->id) }}" class="btn btn-sm btn-info"
                            title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.users.edit', $customer->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.users.destroy', $customer->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
                    <td colspan="7" class="text-center">No customers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $customers->links() }}
    </div>
</div>
