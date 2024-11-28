<x-admin-auth-layout>
    @section('title', 'Server Manager')
    @section('page-title', 'Server Manager')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.server.index') }}
    @endsection

    <div class="container-xxl mt-5">

        <div class="row">
            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted mb-3 fw-semibold">Uptime</p>
                                <h4 class="m-0 mb-3 fs-18" id="uptime">Loading...</h4>
                            </div>
                        </div>
                    </div> <!-- end cardbody -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted mb-3 fw-semibold">CPU Usage</p>
                                <h4 class="m-0 mb-3 fs-18" id="cpu-usage">Loading...</h4>
                            </div>

                        </div>
                    </div> <!-- end cardbody -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted mb-3 fw-semibold">Memory Usage</p>
                                <h4 class="m-0 mb-3 fs-18" id="memory-usage">Loading...</h4>
                            </div>
                        </div>
                    </div> <!-- end cardbody -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted mb-3 fw-semibold">Disk Usage</p>
                                <h4 class="m-0 mb-3 fs-18" id="disk-usage">Loading...</h4>
                            </div>
                        </div>
                    </div> <!-- end cardbody -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            <div class="col-md-6 col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted mb-3 fw-semibold">Network Statistics</p>
                                <h4 class="m-0 mb-3 fs-18" id="network-stats">Loading...</h4>
                            </div>
                        </div>
                    </div> <!-- end cardbody -->
                </div> <!-- end card -->
            </div>
        </div>

        <div class="row g-4">
            <!-- Clear Cache Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="card-body text-center">
                        <h5 class="card-title">Clear Cache</h5>
                        <p class="card-text">Clear all application cache to refresh system performance.</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('admin.server.clear-cache') }}" method="POST">
                            @csrf
                            <button type="submit" id="clear-cache-btn" class="btn btn-danger">Clear Cache</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Storage Link Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="card-body text-center">
                        <h5 class="card-title">Create Storage Link</h5>
                        <p class="card-text">Link the storage directory to public for file access.</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('admin.server.storage-link') }}" method="POST">
                            @csrf
                            <button type="submit" id="storage-link-btn" class="btn btn-warning">Create Storage
                                Link</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Optimize Application Card -->
            <div class="col-md-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="card-body text-center">
                        <h5 class="card-title">Optimize Application</h5>
                        <p class="card-text">Optimize application performance by caching routes and configs.</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('admin.server.optimize') }}" method="POST">
                            @csrf
                            <button type="submit" id="optimize-btn" class="btn btn-success">Optimize</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="card-body text-center">
                        <h5 class="card-title">Migrate Fresh</h5>
                        <p class="card-text">Reset the database by dropping all tables and running migrations.</p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('admin.server.migrate-fresh') }}" method="POST">
                            @csrf
                            <button type="submit" id="optimize-btn" class="btn btn-danger">Migrate Fresh</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="card-body text-center">
                        <h5 class="card-title">Update Project</h5>
                        <p class="card-text">Pull the latest changes from the GitHub repository and update the project.
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ route('admin.server.update') }}" method="POST">
                            @csrf
                            <button type="submit" id="update-btn" class="btn btn-warning">Update Project</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>

    @section('page-js')
        <script>
            function fetchServerMetrics() {
                fetch('{{ route('admin.server.index') }}', {
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('uptime').innerText = data.uptime ?? 'N/A';
                        document.getElementById('cpu-usage').innerText = `CPU: ${data.cpu_usage['1_min']}%`;
                        document.getElementById('memory-usage').innerText =
                            `Used: ${(data.memory_usage.used / 1024 / 1024).toFixed(2)} MB`;
                        document.getElementById('disk-usage').innerText =
                            `Used: ${(data.disk_usage.used / 1024 / 1024 / 1024).toFixed(2)} GB`;
                        document.getElementById('network-stats').innerText =
                            `Packets: ${data.network['Packets Received']} | Output: ${data.network['Output Requests']}`;
                    })
                    .catch(error => console.error('Error fetching metrics:', error));
            }

            // Fetch data every 10 seconds
            document.addEventListener('DOMContentLoaded', function() {
                fetchServerMetrics();
                setInterval(fetchServerMetrics, 10000);
            });
        </script>
    @endsection


</x-admin-auth-layout>
