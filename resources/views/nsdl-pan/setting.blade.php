<x-user-auth-layout>
    @section('title', 'NSDL | Setting')
    @section('page-title', 'NSDL | Setting' )
    @section('breadcrumb')
        {{Breadcrumbs::render('nsdl.setting.edit') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('nsdl.setting.update') }}"
            method="post">
            @csrf

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">
                        Nsdl Setting
                    </h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-2"></div>

                        <div class="col-md-8">

                            <div class="row">

                                <div class="mb-3">
                                    <label for="agent_id" class="form-label">Agent ID</label>
                                    <input type="text" name="agent_id" class="form-control" 
                                    value="{{old('agent_id',$userSetting?$userSetting->agent_id:"")}}"
                                    placeholder="Enter Your Agent ID"
                                    >
                                </div>
                                
                                <p>Don't Have Agent ID? <a href="https://assisted-service.egov-nsdl.com/SpringBootFormHandling/newPanReq">Click Here</a> </p>

                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Update</button>

                        </div>

                        <div class="col-md-2"></div>

                    </div>
                </div>
            </div>
        </form>
    </div> <!-- container -->




</x-user-auth-layout>
