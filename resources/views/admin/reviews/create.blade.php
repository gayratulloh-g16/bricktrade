<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Review</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.reviews.index') }}">Reviews</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Global Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create New Review</h5>
                            <form action="{{ route('admin.reviews.store') }}" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-4">
                                    <label for="user_id" class="form-label">User</label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="brick_id" class="form-label">Brick</label>
                                    <select name="brick_id" id="brick_id" class="form-select" required>
                                        <option value="">Select Brick</option>
                                        @foreach($bricks as $brick)
                                            <option value="{{ $brick->id }}" {{ old('brick_id') == $brick->id ? 'selected' : '' }}>
                                                {{ $brick->name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brick_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" step="0.1" name="rating" id="rating" class="form-control" value="{{ old('rating') }}" required>
                                    @error('rating')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="text" class="form-label">Review Text</label>
                                    <textarea name="text" id="text" rows="4" class="form-control" required>{{ old('text') }}</textarea>
                                    @error('text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Create Review</button>
                                    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
