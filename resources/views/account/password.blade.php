<x-user-auth-layout>
    @section('title', __('pages.account.change password'))
    @section('page-title', __('pages.account.change password'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('account.password.change') }}
    @endsection

    <form action="{{ route('account.password.change') }}" method="post">
        @csrf
        @method('put')
        <div class="card" style="font-weight:bold">
            <div class="card-header bg-transparent border-bottom">
                {{ __('') }}
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('pages.account.currentPassword') }}</label>
                            <input type="password" name="current_password" placeholder="Current Password"
                                class="form-control">
                            @error('current_password')
                                <div class="invalid-feedback d-block text-danger py-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('pages.account.newPassword') }}</label>
                            <input type="password" name="password" placeholder="New Password" class="form-control">
                            @error('password')
                                <div class="invalid-feedback d-block text-danger py-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('pages.account.confirmPassword') }}</label>
                            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                                class="form-control">
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block text-danger py-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary px-5">{{ __('common.button.update') }}</button>
            </div>
        </div>
    </form>


</x-user-auth-layout>
