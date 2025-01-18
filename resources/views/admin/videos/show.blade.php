<x-admin-auth-layout>
    @section('title', 'Video | Details')
    @section('page-title', 'Video | Details')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.website.videos.show', $video) }}
    @endsection
    @section('page-head')
        <meta http-equiv="Content-Security-Policy" content="frame-src https://www.youtube.com;">
    @endsection

    <!-- Start Content -->
    <div class="container-fluid">
        <div class="card">

            <!-- Card Header -->
            <div class="card-header">
                <h5 class="card-title mb-0">Video Details</h5>
            </div><!-- end card header -->

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">

                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <!-- Title -->
                        <div class="mb-3">
                            <h6 class="fw-bold">Title:</h6>
                            <p>{{ $video->title }}</p>
                        </div>

                        <!-- Sub Title -->
                        <div class="mb-3">
                            <h6 class="fw-bold">Sub Title:</h6>
                            <p>{{ $video->sub_title }}</p>
                        </div>

                        <!-- Video URL -->
                        <div class="mb-3 border-0">
                            <h6 class="fw-bold">Video:</h6>
                            @if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([\w-]{11})/', $video->url, $matches))
                                <div class="ratio ratio-16x9">
                                    <iframe src="https://www.youtube.com/embed/{{ $matches[1] }}"
                                        title="YouTube video player"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @else
                                <p><a href="{{ $video->url }}" target="_blank">{{ $video->url }}</a></p>
                            @endif
                        </div>

                        <!-- Active Status -->
                        <div class="mb-3">
                            <h6 class="fw-bold">Active Status:</h6>
                            <p>
                                @if ($video->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">In-Active</span>
                                @endif
                            </p>
                        </div>

                        <!-- Created At -->
                        <div class="mb-3">
                            <h6 class="fw-bold">Created At:</h6>
                            <p>{{ $video->created_at->format('F j, Y, g:i a') }}</p>
                        </div>

                        <!-- Updated At -->
                        <div class="mb-3">
                            <h6 class="fw-bold">Updated At:</h6>
                            <p>{{ $video->updated_at->format('F j, Y, g:i a') }}</p>
                        </div>

                    </div>
                    <div class="col-md-3"></div>

                </div>
            </div><!-- end card body -->

        </div><!-- end card -->
    </div><!-- end container -->
</x-admin-auth-layout>
