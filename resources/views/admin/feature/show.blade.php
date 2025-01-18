<x-admin-auth-layout>
    @section('title', 'Feature | Detail')
    @section('page-title', 'Feature | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.feature.show', $feature) }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Feature Details</h5>
            </div>
            <div class="card-body">
                <!-- Thumbnail -->
                <div class="text-center mb-4">
                    <img src="{{ $feature->getFirstMediaUrl('feature', 'thumbnail') ?: asset('assets/images/service.png') }}"
                        alt="Service Thumbnail" class="img-thumbnail" style="max-width: 150px; height: auto;">
                </div>

                <!-- Name -->
                <h4 class="text-center mb-3">{{ $feature->name }} | {{ $feature->code }}</h4>

                <!-- Description -->
                <p class="text-muted text-center">{{ $feature->description ?? 'No description available' }}
                </p>

                <!-- Status -->
                <div class="text-center mb-3">
                    @if ($feature->enable)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </div>


                <!-- Fee -->
                <div class="text-center">
                    <h5 class="text-primary">Fee: {{ $generalSetting->currency->symbol }}
                        {{ number_format($feature->fee, 2) }}</h5>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.feature.edit', $feature->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.feature.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

    </div> <!-- container -->


</x-admin-auth-layout>
