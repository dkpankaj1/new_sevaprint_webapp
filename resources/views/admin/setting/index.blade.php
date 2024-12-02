<x-admin-auth-layout>
    @section('title', 'Settings')
    @section('page-title', 'Settings')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.settings.index') }}
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
            <div class="row g-4">
                <div class="col-md-4 col-sm-6">
                    <a href="{{route('admin.settings.general')}}">
                        <div class="settings-tile text-center">
                            <i data-feather="settings" class="settings-icon"></i>
                            <div class="settings-label">General</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{route('admin.settings.brand')}}">
                        <div class="settings-tile text-center">
                            <i data-feather="shield" class="settings-icon"></i>
                            <div class="settings-label">Brand Setting</div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{route('admin.settings.email')}}">
                        <div class="settings-tile text-center">
                            <i data-feather="mail" class="settings-icon"></i>
                            <div class="settings-label">Email Configuration</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>


</x-admin-auth-layout>
