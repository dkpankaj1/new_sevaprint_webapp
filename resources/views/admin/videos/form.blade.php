<x-admin-auth-layout>
    @section('title', $video ? 'Video| Edit' : 'Video | Create')
    @section('page-title', $video ? 'Video | Edit' : 'Video | Create')
    @section('breadcrumb')
        {{ $video
            ? Breadcrumbs::render('admin.website.videos.edit', $video)
            : Breadcrumbs::render('admin.website.videos.create') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form
            action="{{ $video
                ? route('admin.website.videos.update', $video)
                : route('admin.website.videos.store') }}"
            method="post">

            @csrf

            @if ($video)
                @method('PUT')
            @endif

            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $video ? 'Edit Video' : 'Create Video' }}</h5>
                </div><!-- end card header -->

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <!-- video Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $video->title ?? '') }}" placeholder="Enter Title">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- video Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title"
                                    value="{{ old('sub_title', $video->sub_title ?? '') }}"
                                    placeholder="Enter Sub Title">
                                @error('sub_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                             <!-- video url Input -->
                             <div class="mb-3">
                                <label for="name" class="form-label">Video URL</label>
                                <input type="text" class="form-control" name="url"
                                    value="{{ old('url', $video->url ?? '') }}"
                                    placeholder="Enter Video URL">
                                @error('url')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- video Enable (Yes/No) Dropdown -->
                            <div class="mb-3">
                                <label for="enable" class="form-label">Active</label>
                                <select name="is_active" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="1" @if (old('is_active', $video->is_active ?? '') == 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if (old('is_active', $video->is_active ?? '') == 0) selected @endif>No
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">{{ $video ? 'Update' : 'Create' }}</button>

                        </div>
                        <div class="col-md-3"></div>

                    </div>
                </div><!-- end card body -->

            </div><!-- end card -->
        </form>
    </div><!-- end container -->

</x-admin-auth-layout>
