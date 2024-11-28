<x-admin-auth-layout>
    @section('title', 'Users Detail')
    @section('page-title', 'Users Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.users.show', $user) }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ $user->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">
                                <div class="overflow-hidden ms-4">
                                    <h4 class="m-0 text-dark fs-20">{{ $user->name }}</h4>
                                    <p class="my-1 text-muted fs-16">{{ $user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body pt-1">
                        <ul class="nav nav-underline border-bottom" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-2 active" id="profile_about_tab" data-bs-toggle="tab"
                                    href="#profile_about" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-information"></i></span>
                                    <span class="d-none d-sm-block">About</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-2" id="profile_experience_tab" data-bs-toggle="tab"
                                    href="#profile_experience" role="tab" aria-selected="true">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-sitemap-outline"></i></span>
                                    <span class="d-none d-sm-block">Transaction</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-2" id="portfolio_education_tab" data-bs-toggle="tab"
                                    href="#profile_education" role="tab" aria-selected="false" tabindex="-1">
                                    <span class="d-block d-sm-none"><i class="mdi mdi-school"></i></span>
                                    <span class="d-none d-sm-block">Services</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content text-muted bg-white">
                            <div class="tab-pane pt-4 show" id="profile_about" role="tabpanel"
                                aria-labelledby="profile_about_tab">
                                <div class="row">

                                    <div class="col-md-6 col-sm-6 col-md-6 mb-4">
                                        <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Contact Details
                                        </h5>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                <div class="profile-email">
                                                    <h6 class="text-uppercase fs-13">Email Addess</h6>
                                                    <a href="#"
                                                        class="text-primary fs-14 text-decoration-underline">zoyothemes.com</a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                <div class="profile-email">
                                                    <h6 class="text-uppercase fs-13">Social Media</h6>
                                                    <ul class="social-list list-inline mt-0 mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="javascript: void(0);"
                                                                class="social-item border-primary text-primary justify-content-center align-content-center"><i
                                                                    class="mdi mdi-facebook fs-14"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript: void(0);"
                                                                class="social-item border-danger text-danger justify-content-center align-content-center"><i
                                                                    class="mdi mdi-google fs-14"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript: void(0);"
                                                                class="social-item border-info text-info justify-content-center align-content-center"><i
                                                                    class="mdi mdi-twitter fs-14"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="javascript: void(0);"
                                                                class="social-item border-secondary text-secondary justify-content-center align-content-center"><i
                                                                    class="mdi mdi-github fs-14"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-lg-4">
                                                <div class="profile-email">
                                                    <h6 class="text-uppercase fs-13">Location</h6>
                                                    <a href="#" class="fs-14">Melbourne, Australia</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="skills-details mt-3">
                                            <h6 class="text-uppercase fs-13">Skills</h6>

                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">User
                                                    Interface</span>
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">User
                                                    Experience</span>
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">Interaction
                                                    Design </span>
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">3D
                                                    Design</span>
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">Information
                                                    Architecture</span>
                                                <span class="badge bg-dark-subtle px-3 py-2 fw-semibold">User
                                                    Research</span>
                                                <span
                                                    class="badge bg-dark-subtle px-3 py-2 fw-semibold">Wireframing</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div><!-- end Experience -->

                            <div class="tab-pane pt-4 active " id="profile_experience" role="tabpanel"
                                aria-labelledby="profile_experience_tab">
                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-lg-6">
                                        <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">All Transaction
                                        </h5>
                                    </div>



                                </div>
                            </div> <!-- end Experience -->

                            <div class="tab-pane pt-4" id="profile_education" role="tabpanel"
                                aria-labelledby="portfolio_education_tab">
                                <div class="row">

                                    <div class="col-md-12 col-sm-12 col-lg-6">
                                        <h5 class="fs-16 text-dark fw-semibold mb-3 text-capitalize">Active Services
                                        </h5>
                                    </div>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card border mb-0">
                                                <div class="card-body">
                                                    <h4 class="mb-2 fs-18 fw-semibold text-dark">MSC (IT) - 2020</h4>
                                                    <div class="mt-0 align-items-center">
                                                        <h5 class="fs-16 mt-1">The University of Melbourne</h5>
                                                        <p class="mb-1 text-muted">Science</p>
                                                        <p class="mb-0 text-muted">Regular</p>
                                                    </div>
                                                </div><!--end card-body-->
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="card border mb-0">
                                                <div class="card-body">
                                                    <h4 class="mb-2 fs-18 fw-semibold text-dark">Bachelor Of Science -
                                                        2018</h4>
                                                    <div class="mt-0 align-items-center">
                                                        <h5 class="fs-16 mt-1">Monash University Clayton Campus</h5>
                                                        <p class="mb-1 text-muted">Science</p>
                                                        <p class="mb-0 text-muted">Regular</p>
                                                    </div>
                                                </div><!--end card-body-->
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="card border mb-0">
                                                <div class="card-body">
                                                    <h4 class="mb-2 fs-18 fw-semibold text-dark">Basic School - 2015
                                                    </h4>
                                                    <div class="mt-0 align-items-center">
                                                        <h5 class="fs-16 mt-1">Ascham School</h5>
                                                        <p class="mb-1 text-muted">School</p>
                                                        <p class="mb-0 text-muted">Regular</p>
                                                    </div>
                                                </div><!--end card-body-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end education -->
                        </div> <!-- Tab panes -->
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container -->


</x-admin-auth-layout>
