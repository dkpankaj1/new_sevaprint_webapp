<x-user-auth-layout>
    @section('title', __('pages.account.edit profile'))
    @section('page-title', __('pages.account.edit profile'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('account.profile.edit') }}
    @endsection

    @section('page-head')
        <style>
            .image-upload-container {
                position: relative;
                width: 150px;
                height: 150px;
                border: 2px dashed #ddd;
                border-radius: 8px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
            }

            .image-upload-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .image-upload-container .delete-icon {
                position: absolute;
                top: 5px;
                left: 5px;
                background-color: rgba(255, 0, 0, 0.7);
                border-radius: 50%;
                padding: 5px;
                cursor: pointer;
            }

            .image-upload-container input[type="file"] {
                display: none;
            }
        </style>
    @endsection

    <form action="{{ route('account.profile.edit') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card" style="font-weight:bold">
           
            <div class="card-body">
                <div class="d-flex align-items-center p-3 mb-4 bg-light rounded shadow-sm">
                    <div class="image-upload-container" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="avatar" id="imageInput" accept="image/*" onchange="previewImage(event)">
                        <span class="delete-icon text-light d-none" onclick="removeImage(event)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </span>
                        <img id="imagePreview" src="{{ $user->avatar }}" alt="Image Preview">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.name')}}</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                placeholder="Enter name" class="form-control">
                            @error('name')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.email')}}</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                placeholder="Enter email" class="form-control">
                            @error('email')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.phone')}}</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                placeholder="Enter phone number" class="form-control">
                            @error('phone')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.address')}}</label>
                            <input type="text" name="address" value="{{ old('address', $user->address) }}"
                                placeholder="Enter address" class="form-control">
                            @error('address')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.city')}}</label>
                            <input type="text" name="city" value="{{ old('city', $user->city) }}"
                                placeholder="Enter city name" class="form-control">
                            @error('city')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.state')}}</label>
                            <input type="text" name="state" value="{{ old('state', $user->state) }}"
                                placeholder="Enter state name" class="form-control">
                            @error('state')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.country')}}</label>
                            <input type="text" name="country" value="{{ old('country', $user->country) }}"
                                placeholder="Enter country" class="form-control">
                            @error('country')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{__('pages.account.postalCode')}}</label>
                            <input type="text" name="postal_code"
                                value="{{ old('postal_code', $user->postal_code) }}" placeholder="Enter postal code"
                                class="form-control">
                            @error('postal_code')
                                <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary px-5">{{__('common.button.update')}}</button>
            </div>
        </div>
    </form>

    @section('page-js')
        <script>
            function previewImage(event) {
                const imageInput = event.target;
                const imagePreview = document.getElementById('imagePreview');
                const deleteIcon = document.querySelector('.delete-icon');

                if (imageInput.files && imageInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        deleteIcon.classList.remove('d-none');
                    };
                    reader.readAsDataURL(imageInput.files[0]);
                }
            }

            function removeImage(event) {
                event.stopPropagation(); // Prevent triggering the file input
                const imageInput = document.getElementById('imageInput');
                const imagePreview = document.getElementById('imagePreview');
                const deleteIcon = document.querySelector('.delete-icon');

                imageInput.value = ""; // Clear the file input
                imagePreview.src = "https://via.placeholder.com/150"; // Reset to placeholder
                deleteIcon.classList.add('d-none'); // Hide the delete icon
            }
        </script>
    @endsection

</x-user-auth-layout>
