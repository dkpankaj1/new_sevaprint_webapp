div<x-admin-auth-layout>
    @section('title', 'Website Settings')
    @section('page-title', 'Website Settings')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.website.index') }}
    @endsection

    @section('page-head')
        <style>
            .settings-grid {
                padding: 30px;
            }

            .settings-tile {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 8px;
                background-color: #f8f9fa;
                transition: transform 0.2s, background-color 0.3s;
            }

            .settings-tile:hover {
                background-color: #e9ecef;
                transform: translateY(-5px);
            }

            .settings-icon {
                font-size: 40px;
                margin-bottom: 15px;
                color: #333;
            }

            .settings-label {
                font-weight: bold;
                color: #333;
            }
        </style>
    @endsection

    <div class="container-xxl mt-5">
        <div class="container settings-grid">
            <div class="card my-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form action="{{ route('admin.website.index') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="text-center p-1">
                                        <img src="{{ $homepage->image }}" alt="" class="img-fluid"
                                            style="height: 133px">
                                    </div>
                                    <label for="">HomePage Image (819px*674px)</label>
                                    <input type="file" class="form-control" name="image">
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <hr>
                                <button class="btn btn-primary">Update</button>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.website.text-slider.index') }}">
                        <div class="settings-tile text-center">
                            <i data-feather="check-square" class="settings-icon"></i>
                            <div class="settings-label">Slider</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.website.about-us.edit') }}">
                        <div class="settings-tile text-center">
                            <i data-feather="check-square" class="settings-icon"></i>
                            <div class="settings-label">About US</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.website.our-services.index') }}">
                        <div class="settings-tile text-center">
                            <i data-feather="check-square" class="settings-icon"></i>
                            <div class="settings-label">Our Service</div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6">
                    <a href="{{ route('admin.website.videos.index') }}">
                        <div class="settings-tile text-center">
                            <i data-feather="check-square" class="settings-icon"></i>
                            <div class="settings-label">Videos</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>


</x-admin-auth-layout>
