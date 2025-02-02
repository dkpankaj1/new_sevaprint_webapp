<x-admin-auth-layout>
    @section('title', 'Dashboard ')

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center py-4">
            <h2 class="mb-0">Welcome, {{ auth()->guard('admin')->user()->name }}!</h2>
            <button class="btn btn-primary">Notifications <span class="badge bg-light text-dark">100</span></button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="{{ auth()->guard('admin')->user()->avatar }}" class="rounded-2 avatar-xxl"
                            alt="image profile">

                        <div class="overflow-hidden ms-4">
                            <h4 class="m-0 text-dark fs-20">{{ auth()->guard('admin')->user()->name }}</h4>
                            <p class="my-1 text-muted fs-16">{{ auth()->guard('admin')->user()->email }}</p>
                            <p class="text-secondary mt-1">
                                <small>{{ __('pages.account.profile.memberSince') }}
                                    {{ auth()->guard('admin')->user()->created_at->format('F Y') }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-end">Daily</span>
                            <h5 class="card-title mb-0">Cost per Unit</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{$generalSetting->currency->symbol}} 17.21
                                </h2>
                            </div>
                            <div class="col-4 text-end">
                                <span class="text-muted">12.5% <i class="mdi mdi-arrow-up text-success"></i></span>
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-end">Per Week</span>
                            <h5 class="card-title mb-0">Market Revenue</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{$generalSetting->currency->symbol}} 1875.54
                                </h2>
                            </div>
                            <div class="col-4 text-end">
                                <span class="text-muted">18.71% <i class="mdi mdi-arrow-down text-danger"></i></span>
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-end">Per Month</span>
                            <h5 class="card-title mb-0">Expenses</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    {{$generalSetting->currency->symbol}} 784.62
                                </h2>
                            </div>
                            <div class="col-4 text-end">
                                <span class="text-muted">57% <i class="mdi mdi-arrow-up text-success"></i></span>
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 57%;">
                            </div>
                        </div>
                    </div>
                    <!--end card body-->
                </div>
                <!--end card-->
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span class="badge badge-soft-primary float-end">All Time</span>
                            <h5 class="card-title mb-0">Daily Visits</h5>
                        </div>
                        <div class="row d-flex align-items-center mb-4">
                            <div class="col-8">
                                <h2 class="d-flex align-items-center mb-0">
                                    1,15,187
                                </h2>
                            </div>
                            <div class="col-4 text-end">
                                <span class="text-muted">17.8% <i class="mdi mdi-arrow-down text-danger"></i></span>
                            </div>
                        </div>

                        <div class="progress shadow-sm" style="height: 5px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 57%;"></div>
                        </div>
                    </div>
                    <!--end card body-->
                </div><!-- end card-->
            </div> <!-- end col-->
        </div> --}}
        <!-- end row-->

        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Transaction Chart</h5>
                    </div>

                    <div class="card-body">
                        <div id="basic_line_chart" class="apex-charts"></div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->

    @section('page-js')
    <!-- Apexcharts JS -->
    <script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options = {
                series: [
                    { name: "Debit", data: @json($debit) },
                    { name: "Credit", data: @json($credit) },
                ],
                chart: {
                    height: 380,
                    type: "line",
                    zoom: { enabled: false },
                    toolbar: { show: false },
                },
                markers: { size: 4 },
                dataLabels: { enabled: false },
                stroke: { curve: "straight" },
                colors: ["#4af55b","#4a98f5"],
                title: {
                    text: "Transaction",
                    align: "left",
                    style: { fontWeight: 600 },
                },
                grid: { row: { colors: ["#f3f3f3", "transparent"], opacity: 0.5 } },
                xaxis: {
                    categories: @json($dates),
                },
                responsive: [
                    {
                        breakpoint: 600,
                        options: {
                            chart: { toolbar: { show: false } },
                            legend: { show: false },
                        },
                    },
                ],
            };

            var chart = new ApexCharts(
                document.querySelector("#basic_line_chart"),
                options
            );

            chart.render();
        });
    </script>

    @endsection

</x-admin-auth-layout>