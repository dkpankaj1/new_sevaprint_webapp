<x-admin-auth-layout>
    @section('title', $textSlider ? 'Text Slider | Edit' : 'Text Slider | Create')
    @section('page-title', $textSlider ? 'Text Slider | Edit' : 'Text Slider | Create')
    @section('breadcrumb')
        {{ $textSlider
            ? Breadcrumbs::render('admin.website.text-slider.edit', $textSlider)
            : Breadcrumbs::render('admin.website.text-slider.create') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form
            action="{{ $textSlider
                ? route('admin.website.text-slider.update', $textSlider)
                : route('admin.website.text-slider.store') }}"
            method="post">

            @csrf

            @if ($textSlider)
                @method('PUT')
            @endif

            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ $textSlider ? 'Edit Slider' : 'Create Slider' }}</h5>
                </div><!-- end card header -->

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <!-- textSlider Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $textSlider->title ?? '') }}" placeholder="Enter Title">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- textSlider Name Input -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Sub Title</label>
                                <input type="text" class="form-control" name="sub_title"
                                    value="{{ old('sub_title', $textSlider->sub_title ?? '') }}"
                                    placeholder="Enter Sub Title">
                                @error('sub_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- textSlider Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $textSlider->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- textSlider Enable (Yes/No) Dropdown -->
                            <div class="mb-3">
                                <label for="enable" class="form-label">Active</label>
                                <select name="is_active" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="1" @if (old('is_active', $textSlider->is_active ?? '') == 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if (old('is_active', $textSlider->is_active ?? '') == 0) selected @endif>No
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">{{ $textSlider ? 'Update' : 'Create' }}</button>

                        </div>
                        <div class="col-md-3"></div>

                    </div>
                </div><!-- end card body -->

            </div><!-- end card -->
        </form>
    </div><!-- end container -->

    @section('page-js')
    <script src="https://cdn.tiny.cloud/1/{{$generalSetting->editor_key}}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: 'textarea',
          plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
          toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
      </script>
    @endsection
</x-admin-auth-layout>
