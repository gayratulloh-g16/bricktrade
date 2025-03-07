<div class="table-responsive">
    <table class="table table-striped datatable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Image</th>
          <th>Created At</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($partnerLogos as $logo)
          <tr>
            <td>{{ $logo->name }}</td>
            <td>
              @if($logo->image)
                <img src="{{ asset('storage/' . $logo->image) }}" alt="{{ $logo->name }}" class="img-thumbnail" style="max-width: 100px;">
              @endif
            </td>
            <td>{{ $logo->created_at->format('Y-m-d') }}</td>
            <td class="text-end">
              <a href="{{ route('admin.partner-logos.show', $logo->id) }}" class="btn btn-sm btn-info" title="View">
                <i class="bi bi-eye"></i>
              </a>
              <a href="{{ route('admin.partner-logos.edit', $logo->id) }}" class="btn btn-sm btn-warning" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.partner-logos.destroy', $logo->id) }}" method="POST" class="d-inline-block"
                    onsubmit="return confirm('Are you sure you want to delete this partner logo?');">
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
            <td colspan="4" class="text-center">No partner logos found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{ $partnerLogos->links() }}
    </div>
  </div>
  