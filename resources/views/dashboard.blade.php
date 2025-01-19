<x-user-auth-layout>
    @section('title', __('pages.dashboard.title'))

    <div class="d-flex justify-content-between align-items-center py-4">
        <h2 class="mb-0">{{ __('pages.dashboard.welcome') }}, {{ auth()->user()->name }}!</h2>
        <a class="btn btn-primary" href="{{ route('wallet.index') }}">
            {{ __('pages.dashboard.my_wallet') }}
            <span class="badge bg-light text-dark">{{ $generalSetting->currency->symbol }} {{ auth()->user()->wallet }}
            </span>
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center my-1">
                    <img src="{{ auth()->user()->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">

                    <div class="overflow-hidden ms-4">
                        <h4 class="m-0 text-dark fs-20">{{ auth()->user()->name }}</h4>
                        <p class="my-1 text-muted fs-16">{{ auth()->user()->email }}</p>
                        <span class="fs-15">
                            <i class="mdi mdi-wallet me-2 align-middle"></i>
                            {{ __('pages.dashboard.walletBalance') }}: <span
                                class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">{{ $generalSetting->currency->symbol }}
                                {{ auth()->user()->wallet }}</span>
                        </span>
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center justify-content-start justify-content-md-end  my-1">
                    <a class="btn btn-primary me-2" href="{{route('wallet.recharge')}}">
                        <i data-feather="plus-circle"></i> Add Balance
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="row gap-2">

        @featureMobileRechargeEnabled
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <img src="{{App\Features\MobileRechargeFeature::getFeatureIcon()}}" style="max-width: 100px; height: auto;" alt="">
                    <h5 class="mt-3">Recharge</h5>

                    <a href="{{ route('mobile-recharge.create', ['type' => 'mobile']) }}" class="btn btn-primary">Mobile</a>
                    <a href="{{ route('mobile-recharge.create', ['type' => 'dth']) }}" class="btn btn-primary">DTH</a>
                </div>
            </div>
        </div>
        @endfeatureMobileRechargeEnabled

        @nsdlPanFeatureEnabled

        <div class="col-6 col-md-4 col-lg-3">
            <div class="card text-center border-0 shadow-sm h-100">
                <div class="card-body">
                    <img src="{{App\Features\NsdlPanFeature::getFeatureIcon()}}" style="max-width: 100px; height: auto;" alt="">
                    <h5 class="mt-3">NSDL PAN</h5>

                    <a href="{{ route('nsdl.pan-card.create') }}" class="btn btn-primary">Apply New</a>
                </div>
            </div>
        </div>
    @endnsdlPanFeatureEnabled



    </div>



</x-user-auth-layout>