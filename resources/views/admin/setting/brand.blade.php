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

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', $brandSetting->name) }}" placeholder="Enter brand name">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Brand Title</label>
                        <input type="text" class="form-control" name="title"
                            value="{{ old('title', $brandSetting->title) }}" placeholder="Enter brand title">
                        @error('title')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" class="form-control" name="description"
                            value="{{ old('description', $brandSetting->description) }}"
                            placeholder="Enter description">

                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Logo <span class="text-danger"><small>(Allowed:jpeg,png,jpg | 94*99)</small></span></label>
                        <x-image-upload id="brandLogo" name="logo" :previewUrl="old('logo', $brandSetting->logo ?? '')" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Main Logo <span class="text-danger"><small>(Allowed:jpeg,png,jpg | 244*68)</small></span></label>
                        <x-image-upload id="brandMainLogo" name="logo_main" :previewUrl="old('logo_main', $brandSetting->logo_main ?? '')" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Favicon <span class="text-danger"><small>(Allowed:png | 64*64)</small></span></label>
                        <x-image-upload id="favicon" name="favicon" :previewUrl="old('favicon', $brandSetting->favicon ?? '')" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" class="form-control" name="contact_email"
                            value="{{ old('contact_email', $brandSetting->contact_email) }}"
                            placeholder="Enter contact email">
                        @error('contact_email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" class="form-control" name="contact_phone"
                            value="{{ old('contact_phone', $brandSetting->contact_phone) }}"
                            placeholder="Enter contact phone">
                        @error('contact_phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>


            <div class="card-footer">
                <button class="btn btn-primary px-5">Update</button>
            </div>

        </div>
    </form>

</x-admin-auth-layout>
