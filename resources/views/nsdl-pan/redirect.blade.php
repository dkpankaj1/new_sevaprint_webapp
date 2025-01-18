<x-user-auth-layout>
    @section('title', __('NSDL | Redirect'))
    @section('page-title', __('NSDL | Redirect'))

    <!-- Start Content -->
    <div class="card text-center shadow-lg">
        <div class="card-body">
            <h5 class="card-title mb-4">{{ __('NSDL Redirect') }}</h5>
            <p class="card-text mb-4">{{ __('You will be redirected to NSDL. If the redirection does not happen automatically, click the button below.') }}</p>
            <a href="{{ $url }}" class="btn btn-success btn-lg" target="_blank">{{ __('Go to NSDL') }}</a>
        </div>
    </div>
    <!-- End Content -->
</x-user-auth-layout>
