<x-admin-auth-layout>
    @section('title', $service ? 'Our Service | Edit' : 'Our Service | Create')
    @section('page-title', $service ? 'Our Service | Edit' : 'Our Service | Create')
    @section('breadcrumb')
        {{ $service
            ? Breadcrumbs::render('admin.website.our-services.edit', $service)
            : Breadcrumbs::render('admin.website.our-services.create') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form
            action="{{ $service ? route('admin.website.our-services.update', $service) : route('admin.website.our-services.store') }}"
            method="post" enctype="multipart/form-data">

            @csrf

            @if ($service)
                @method('PUT')
            @endif

            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Service</h5>
                </div><!-- end card header -->

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <!-- Service Thumbnail Section -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Icon (45px * 45px)</label>
                                <div class="p-1 border text-center">
                                    <img src={{ $service->icon ?? 'https://placehold.co/45' }}
                                        alt="{{ $service->title ?? '' }}" class="img-fluid" style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="icon">
                                @error('icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- service Title -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $service->title ?? '') }}" placeholder="Enter Title">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- service Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $service->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- textSlider Enable (Yes/No) Dropdown -->
                            <div class="mb-3">
                                <label for="enable" class="form-label">Active</label>
                                <select name="is_active" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="1" @if (old('is_active', $service->is_active ?? '') == 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if (old('is_active', $service->is_active ?? '') == 0) selected @endif>No
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">{{ $service ? 'Update' : 'Create' }}</button>

                        </div>

                        <div class="col-md-3"></div>

                    </div>
                </div><!-- end card body -->

            </div><!-- end card -->
        </form>
    </div><!-- end container -->
</x-admin-auth-layout>
