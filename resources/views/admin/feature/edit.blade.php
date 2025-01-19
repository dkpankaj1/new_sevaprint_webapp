<x-admin-auth-layout>
    @section('title', 'Feature | Edit')
    @section('page-title', 'Feature | Edit')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.feature.edit', $feature) }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('admin.feature.update', $feature) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Feature</h5>
                </div><!-- end card header -->

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <!-- Service Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $feature->name) }}" placeholder="Enter Name">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Fee Input -->
                            <div class="mb-3">
                                <label for="fee" class="form-label">Fee
                                    ({{ $generalSetting->currency->symbol }})</label>
                                <input type="number" class="form-control" name="fee"
                                    value="{{ old('fee', $feature->fee) }}" placeholder="Enter Fee">
                                @error('fee')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service commission Input -->
                            <div class="mb-3">
                                <label for="commission" class="form-label">Commission
                                    ({{ $generalSetting->currency->symbol }})</label>
                                <input type="number" class="form-control" name="commission"
                                    value="{{ old('fee', $feature->commission) }}" placeholder="Enter Commission">
                                @error('commission')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service commission type Input -->
                            <div class="mb-3">
                                <label for="commission_type" class="form-label">Commission Type</label>
                                <select name="commission_type" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="0" @if (old('commission_type', $feature->commission_type) === 0) selected @endif>Fixed</option>
                                    <option value="1" @if (old('commission_type', $feature->commission_type) === 1) selected @endif>Percent(%)</option>
                                </select>
                                @error('commission_type')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Enable (Yes/No) Dropdown -->
                            <div class="mb-3">
                                <label for="enable" class="form-label">Enable</label>
                                <select name="enable" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="1" @if (old('enable', $feature->enable) === 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if (old('enable', $feature->enable) === 0) selected @endif>No
                                    </option>
                                </select>
                                @error('enable')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Thumbnail Section -->
                            <div class="mb-3 text-center">
                                <div class="border text-center">
                                    <img src="{{ $feature->icon }}"
                                        alt="{{ $feature->name }}" class="img-fluid p-1 " style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="thumbnail">
                                @error('thumbnail')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Service Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $feature->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Update</button>
                        </div>
                        <div class="col-md-3"></div>


                    </div>
                </div><!-- end card body -->

            </div><!-- end card -->
        </form>
    </div><!-- end container -->
</x-admin-auth-layout>
