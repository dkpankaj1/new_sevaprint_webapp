<x-user-auth-layout>
    @section('title', __('pages.account.title'))
    @section('page-title', __('pages.account.title'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('account.profile.index') }}
    @endsection

    <div class="card">
        <div class="card-body">
            <div class="align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ $user->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">

                    <div class="overflow-hidden ms-4">
                        <h4 class="m-0 text-dark fs-20">{{ $user->name }}</h4>
                        <p class="my-1 text-muted fs-16">{{ $user->email }}</p>
                        <p class="text-secondary mt-1">
                            <small>{{ __('pages.account.profile.memberSince') }}
                                {{ $user->created_at->format('F Y') }}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">

            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th style="width:30%">{{ __('pages.account.email') }}:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.phone') }}:</th>
                        <td>{{ $user->phone ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.address') }}:</th>
                        <td>{{ $user->address ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.city') }}:</th>
                        <td>{{ $user->city ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.state') }}:</th>
                        <td>{{ $user->state ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.country') }}:</th>
                        <td>{{ $user->country ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.postalCode') }}:</th>
                        <td>{{ $user->postal_code ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.wallet') }}:</th>
                        <td>INR {{ number_format($user->wallet, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('pages.account.status') }}:</th>
                        <td>{{ $user->is_active ? 'Active' : 'Inactive' }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="mt-4">
                <a href="{{ route('account.profile.edit') }}"
                    class="btn btn-primary me-2">{{ __('pages.account.edit profile') }}</a>
                <a href="{{ route('account.password.change') }}"
                    class="btn btn-secondary">{{ __('pages.account.change password') }}</a>
            </div>
        </div>
    </div>

</x-user-auth-layout>
