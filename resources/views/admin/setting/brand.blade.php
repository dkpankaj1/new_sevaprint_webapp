<x-admin-auth-layout>
    @section('title', 'Settings | Brand')
    @section('page-title', 'Settings | Brand')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.settings.brand') }}
    @endsection

    <form action="{{ route('admin.settings.brand') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Brand Setting</h5>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $brandSetting->name) }}" placeholder="Enter brand name">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Brand Title</label>
                            <input type="text" class="form-control" name="title"
                                value="{{ old('title', $brandSetting->title) }}" placeholder="Enter brand title">
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="md-3">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ old('description', $brandSetting->description) }}"
                                placeholder="Enter description">

                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">Logo (Allowed:jpeg,png,jpg | 94*99)</label>
                                <div class="text-center py-1">
                                    <img src="{{ $brandSetting->logo }}" alt="logo" class="img-fluid"
                                        style="height: 130px">
                                </div>
                                <input type="file" class="form-control" name="logo">
                                @error('logo')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">Logo Light (Allowed:jpeg,png,jpg | 244x68)</label>
                                <div class="text-center py-1">
                                    <img src="{{ $brandSetting->logo_light }}" alt="logo_light" class="img-fluid"
                                        style="height: 130px">
                                </div>
                                <input type="file" class="form-control" name="logo_light">
                                @error('logo_light')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">Logo Dark (Allowed:jpeg,png,jpg | 244x68)</label>
                                <div class="text-center py-1">
                                    <img src="{{ $brandSetting->logo_dark }}" alt="logo_dark" class="img-fluid"
                                        style="height: 130px">
                                </div>
                                <input type="file" class="form-control" name="logo_dark">
                                @error('logo_dark')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">favicon (Allowed:jpeg,png,jpg | 32x32)</label>
                                <div class="text-center py-1">
                                    <img src="{{ $brandSetting->favicon }}" alt="favicon" class="img-fluid"
                                        style="height: 130px">
                                </div>
                                <input type="file" class="form-control" name="favicon">
                                @error('favicon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Email</label>
                            <input type="email" class="form-control" name="contact_email"
                                value="{{ old('contact_email', $brandSetting->contact_email) }}"
                                placeholder="Enter contact email">
                            @error('contact_email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Phone</label>
                            <input type="text" class="form-control" name="contact_phone"
                                value="{{ old('contact_phone', $brandSetting->contact_phone) }}"
                                placeholder="Enter contact phone">
                            @error('contact_phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <button class="btn btn-primary px-5">Update</button>

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

        </div>
    </form>

</x-admin-auth-layout>
