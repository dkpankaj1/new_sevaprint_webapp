<x-user-auth-layout>
    @section('title', 'Account | My Charges')
    @section('page-title', 'Account | My Charges')
    @section('breadcrumb')
        {{ Breadcrumbs::render('account.profile.index') }}
    @endsection

    <div class="row justify-content-center my-3">
        @foreach ($charges as $charge)
            <div class="pricing-box col-xl-4 col-md-6">
                <div class="card card-h-full shadow-sm rounded-3">
                    <div class="d-flex flex-column inner-box card-body p-4">
                        
                        <div class="plan-header flex-shrink-0">
                            <h5 class="plan-title">{{ $charge['service_name'] }}</h5>
                            <p class="plan-subtitle">{{ $charge['service_description'] }}</p>
                        </div>

                        <div class="flex-shrink-0 pb-4 mb-1">
                            <h2 class="month mb-0">
                                <sup class="fw-semibold"><small>{{ $generalSetting->currency->symbol }}</small></sup>
                                <span class="fw-semibold fs-28">{{$charge['charge']}}</span>/
                            </h2>
                        </div>

                    </div>
                </div> <!-- end Pricing_card -->
            </div> <!-- end col -->
        @endforeach
    </div>

</x-user-auth-layout>
