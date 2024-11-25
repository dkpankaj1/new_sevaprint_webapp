<x-user-auth-layout>
    @section('title', __('pages.dashboard.title'))

    <div class="d-flex justify-content-between align-items-center py-4">
        <h2 class="mb-0">{{ __('pages.dashboard.welcome') }}, {{ auth()->user()->name }}!</h2>
        <button class="btn btn-primary">{{__('pages.dashboard.notification')}} <span class="badge bg-light text-dark">5</span></button>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ auth()->user()->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">

                    <div class="overflow-hidden ms-4">
                        <h4 class="m-0 text-dark fs-20">{{ auth()->user()->name }}</h4>
                        <p class="my-1 text-muted fs-16">{{ auth()->user()->email }}</p>
                        <span class="fs-15">
                            <i class="mdi mdi-wallet me-2 align-middle"></i>
                            {{ __('pages.dashboard.walletBalance') }}: <span class="badge bg-primary-subtle text-primary px-2 py-1 fs-13 fw-normal">{{ auth()->user()->wallet }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-user-auth-layout>
