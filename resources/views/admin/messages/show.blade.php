<x-admin-auth-layout>
    @section('title', 'Messages | Detail')
    @section('page-title', 'Messages | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.messages.show', $messages) }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <div class="card">

            <!-- Card Header -->
            <div class="card-header">
                <h5 class="card-title mb-0"><strong>Messages Details</strong></h5>
            </div><!-- end card header -->

            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <p class="form-control-static">{{ $messages->name }}</p>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <p class="form-control-static">{{ $messages->email }}</p>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label"><strong>Phone:</strong></label>
                            <p class="form-control-static">{{ $messages->phone }}</p>
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label"><strong>Message:</strong></label>
                            <p class="form-control-static">{{ $messages->message }}</p>
                        </div>

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div><!-- end card body -->

        </div><!-- end card -->
    </div><!-- end container -->
</x-admin-auth-layout>
