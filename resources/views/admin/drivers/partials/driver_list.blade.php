<div class="table-responsive">
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Vehicle Number</th>
                <th>Created At</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($drivers as $driver)
                <tr>
                    <td>{{ $driver->user->first_name }}</td>
                    <td>{{ $driver->user->last_name }}</td>
                    <td>{{ $driver->user->phone_number }}</td>
                    <td>{{ $driver->vehicle_number }}</td>
                    <td>{{ $driver->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.drivers.show', $driver->id) }}" class="btn btn-sm btn-info"
                            title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning"
                            title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST"
                            class="d-inline-block"
                            onsubmit="return confirm('Are you sure you want to delete this driver?');">
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
                    <td colspan="6" class="text-center">No drivers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $drivers->links() }}
    </div>
</div>
