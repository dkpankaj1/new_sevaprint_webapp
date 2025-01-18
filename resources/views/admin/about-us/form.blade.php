<x-admin-auth-layout>
    @section('title', 'About US | Edit')
    @section('page-title', 'About US | Edit')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.website.about-us.edit') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">

        <form action="{{ route('admin.website.about-us.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">

                <!-- Card Header -->
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit</h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title"
                                    value="{{ old('title', $aboutUs->title ?? '') }}" placeholder="Enter Title">
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Image (656px * 545px)</label>
                                <div class="p-1 border text-center">
                                    <img src={{ $aboutUs->image }} alt="image" class="img-fluid"
                                        style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="image">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>


                            <hr>
                            <!-- achievements_one_title -->
                            <div class="mb-3 mt-4">
                                <label for="name" class="form-label">Achievements One Title</label>
                                <input type="text" class="form-control" name="achievements_one_title"
                                    value="{{ old('achievements_one_title', $aboutUs->achievements_one_title) }}" placeholder="Enter Title">
                                @error('achievements_one_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_one_description -->
                            <div class="mb-3">
                                <label for="achievements_one_description" class="form-label">Achievements One Description</label>
                                <input type="text" class="form-control" name="achievements_one_description"
                                    value="{{ old('achievements_one_description', $aboutUs->achievements_one_description) }}" placeholder="Enter Title">
                                    
                                @error('achievements_one_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_one_icon -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements One Icon (45px * 45px)</label>
                                <div class="p-1 border text-center">
                                    <img src={{ $aboutUs->achievements_one_icon }}
                                        alt="achievements_one_icon" class="img-fluid" style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="achievements_one_icon">
                                @error('achievements_one_icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- achievements_one_count -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements One Count</label>
                                <input type="text" class="form-control" name="achievements_one_count"
                                    value="{{ old('achievements_one_count', $aboutUs->achievements_one_count ?? '') }}" placeholder="Enter Title">
                                @error('achievements_one_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <!-- achievements_two_title -->
                            <div class="mb-3  mt-4">
                                <label for="name" class="form-label">Achievements Two Title</label>
                                <input type="text" class="form-control" name="achievements_two_title"
                                    value="{{ old('achievements_two_title', $aboutUs->achievements_two_title) }}" placeholder="Enter Title">
                                @error('achievements_two_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_two_description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Achievements Two Description</label>

                                <input type="text" class="form-control" name="achievements_two_description"
                                    value="{{ old('achievements_two_description', $aboutUs->achievements_two_description) }}" placeholder="Enter Title">

                                @error('achievements_two_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_two_icon -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements Two Icon (45px * 45px)</label>
                                <div class="p-1 border text-center">
                                    <img src={{ $aboutUs->achievements_two_icon }}
                                        alt="achievements_two_icon" class="img-fluid" style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="achievements_two_icon">
                                @error('achievements_two_icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_two_count -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements Two Count</label>
                                <input type="text" class="form-control" name="achievements_two_count"
                                    value="{{ old('achievements_two_count', $aboutUs->achievements_two_count) }}" placeholder="Enter Title">
                                @error('achievements_two_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <!-- achievements_three_title -->
                            <div class="mb-3  mt-4">
                                <label for="name" class="form-label">Achievements Three Title</label>
                                <input type="text" class="form-control" name="achievements_three_title"
                                    value="{{ old('achievements_three_title', $aboutUs->achievements_three_title ) }}" placeholder="Enter Title">
                                @error('achievements_three_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- achievements_three_description -->
                            <div class="mb-3">
                                <label for="achievements_three_description" class="form-label">Achievements Three Description</label>

                                <input type="text" class="form-control" name="achievements_three_description"
                                    value="{{ old('achievements_three_description', $aboutUs->achievements_three_description) }}" placeholder="Enter Title">

                                @error('achievements_three_description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_three_icon -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements Three Icon (45px * 45px)</label>
                                <div class="p-1 border text-center">
                                    <img src={{ $aboutUs->achievements_three_icon }}
                                        alt="achievements_three_icon" class="img-fluid" style="height: 113px">
                                </div>
                                <input type="file" class="form-control mt-1" name="achievements_three_icon">
                                @error('achievements_three_icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- achievements_three_count -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Achievements Three Count</label>
                                <input type="text" class="form-control" name="achievements_three_count"
                                    value="{{ old('achievements_three_count', $aboutUs->achievements_three_count) }}" placeholder="Enter Title">
                                @error('achievements_three_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- service Description Input -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ old('description', $aboutUs->description ?? '') }}</textarea>
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
