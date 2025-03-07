<x-layouts.frontend>
    <section class="page-title">
        <div class="content" style="background-image: url(/frontend/assets/images/background/15.jpg)">
            <div class="auto-container">
                <h1>{{__('main.update_profile')}}</h1>
            </div>
        </div>
        <ul class="page-breadcrumb">
            <li><a href="{{ route('home') }}">{{__('main.home')}}</a></li>
            <li>{{__('main.update_profile')}}</li>
        </ul>
    </section>
    <div class="auto-container my-5">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-white">
                <h3 style="color: white">{{__('main.update_my_profile')}}</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('frontend.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">{{__('main.first_name')}}</label>
                            <input type="text" id="first_name" name="first_name" class="form-control"
                                value="{{ old('first_name', Auth::user()->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">{{__('main.last_name')}}</label>
                            <input type="text" id="last_name" name="last_name" class="form-control"
                                value="{{ old('last_name', Auth::user()->last_name) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{__('main.email')}}</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="{{ old('email', Auth::user()->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">{{__('main.phone_placeholder')}}</label>
                            <input type="text" id="phone_number" name="phone_number" class="form-control"
                                value="{{ old('phone_number', Auth::user()->phone_number) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="address" class="form-label">{{__('main.address')}}</label>
                            <input type="text" id="address" name="address" class="form-control"
                                value="{{ old('address', Auth::user()->address) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">{{__('main.city')}}</label>
                            <input type="text" id="city" name="city" class="form-control"
                                value="{{ old('city', Auth::user()->city) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 position-relative">
                            <label for="image" class="form-label">{{__('main.profile_image')}}</label>
                            <input type="file" id="image" name="image" class="form-control">
                            @if (Auth::user()->image)
                                <div class="mt-2 position-relative" id="currentImageContainer">
                                    <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Profile Image"
                                        class="img-thumbnail" style="max-width: 150px;">
                                    <button type="button" id="removeImageBtn" class="btn btn-danger btn-sm"
                                        style="position: absolute; top: 5px; right: 5px;">&times;</button>
                                </div>
                            @else
                                <img src="/frontend/assets/images/default-profile.png" alt="Default Profile"
                                    class="img-thumbnail" style="max-width: 150px;">
                            @endif
                            <input type="hidden" name="remove_image" id="remove_image" value="0">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{__('main.update_profile')}}</button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">{{__('main.cancel')}}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // When the remove button is clicked, hide the image container and set remove_image to 1.
        document.getElementById('removeImageBtn')?.addEventListener('click', function() {
            const container = document.getElementById('currentImageContainer');
            container.style.display = 'none';
            document.getElementById('remove_image').value = 1;
        });
    </script>
</x-layouts.frontend>
