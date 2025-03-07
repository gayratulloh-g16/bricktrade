<x-layouts.admin>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Feedback</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.feedback.index') }}">Feedback</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                            <h5 class="card-title">Edit Feedback</h5>
                            <form action="{{ route('admin.feedback.update', $feedback->id) }}" method="POST" class="row g-3">
                                @csrf
                                @method('PUT')
                                <div class="col-md-4">
                                    <label for="user_id" class="form-label">User</label>
                                    <select name="user_id" id="user_id" class="form-select" required>
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id', $feedback->user_id) == $user->id ? 'selected' : '' }}>
                                                {{ $user->first_name }} {{ $user->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="order_id" class="form-label">Order</label>
                                    <select name="order_id" id="order_id" class="form-select" required>
                                        <option value="">Select Order</option>
                                        @foreach($orders as $order)
                                            <option value="{{ $order->id }}" {{ old('order_id', $feedback->order_id) == $order->id ? 'selected' : '' }}>
                                                Order #{{ $order->id }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('order_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" step="0.1" name="rating" id="rating" class="form-control" value="{{ old('rating', $feedback->rating) }}" required>
                                    @error('rating')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="text" class="form-label">Feedback Text</label>
                                    <textarea name="text" id="text" rows="4" class="form-control" required>{{ old('text', $feedback->text) }}</textarea>
                                    @error('text')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Feedback</button>
                                    <a href="{{ route('admin.feedback.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div><!-- End Card Body -->
                    </div><!-- End Card -->
                </div>
            </div>
        </section>
    </main>
</x-layouts.admin>
