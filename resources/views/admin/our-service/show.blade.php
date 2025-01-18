<x-admin-auth-layout>
    @section('title', 'Service | Detail')
    @section('page-title', 'Service | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.service.show', $service) }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Service Details</h5>
            </div>
            <div class="card-body">
                <!-- Thumbnail -->
                <div class="text-center mb-4">
                    <img src="{{ $service->getFirstMediaUrl('service') ?? asset('assets/images/service.png') }}"
                        alt="Service Thumbnail" class="img-thumbnail" style="max-width: 150px; height: auto;">
                </div>

                <!-- Name -->
                <h4 class="text-center mb-3">{{ $service->name }} | {{$service->code}}</h4>

                <!-- Description -->
                <p class="text-muted text-center">{{ $service->description ?? 'No description available' }}
                </p>

                <!-- Status -->
                <div class="text-center mb-3">
                    @if ($service->enable)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </div>
                

                <!-- Fee -->
                <div class="text-center">
                    <h5 class="text-primary">Fee: {{$generalSetting->currency->symbol}} {{ number_format($service->fee, 2) }}</h5>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.service.edit', $service->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route('admin.service.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

    </div> <!-- container -->


</x-admin-auth-layout>
