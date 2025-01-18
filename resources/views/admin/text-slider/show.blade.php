<x-admin-auth-layout>
    @section('title', 'Text Slider | Details')
    @section('page-title', 'Text Slider | Details')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.website.text-slider.show', $textSlider) }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">

            <!-- Card Header -->
            <div class="card-header">
                <h5 class="card-title mb-0"><strong>Slider Details</strong></h5>
            </div><!-- end card header -->

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label"><strong>Title:</strong> {{ $textSlider->title }}</label>
                        </div>

                        <!-- Sub Title -->
                        <div class="mb-3">
                            <label for="sub_title" class="form-label"><strong>Sub Title:</strong> {{ $textSlider->sub_title }}</label>
                        </div>

                        <!-- Active Status -->
                        <div class="mb-3">
                            <label for="is_active" class="form-label"><strong>Active Status:</strong> 
                                {{ $textSlider->is_active ? 'Yes' : 'No' }}
                            </label>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label"><strong>Description:</strong></label>
                            <p class="form-control-static">{!! $textSlider->description !!}</p>
                        </div>

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div><!-- end card body -->

        </div><!-- end card -->
    </div><!-- end container -->
</x-admin-auth-layout>
