<x-admin-auth-layout>
    @section('title', 'My Account')
    @section('page-title', 'My Account')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.account.profile.index') }}
    @endsection

    <div class="card">
        <div class="card-body">
            <div class="align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ $admin->avatar }}" class="rounded-2 avatar-xxl" alt="image profile">

                    <div class="overflow-hidden ms-4">
                        <h4 class="m-0 text-dark fs-20">{{ $admin->name }}</h4>
                        <p class="my-1 text-muted fs-16">{{ $admin->email }}</p>
                        <p class="text-secondary mt-1">
                            <small>{{ __('pages.account.profile.memberSince') }}
                                {{ $admin->created_at->format('F Y') }}</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="mt-4">
                <a href="{{ route('admin.account.profile.edit') }}" class="btn btn-primary me-2">Update Profile</a>
                <a href="{{ route('admin.account.password.change') }}" class="btn btn-secondary">Change Password</a>
            </div>
        </div>
    </div>

</x-admin-auth-layout>
