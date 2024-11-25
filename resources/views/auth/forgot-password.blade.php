<x-user-guest-layout>

    @section('title', 'Forget Password -')

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="mb-0 border-0">
                <div class="p-0">
                    <div class="text-center">
                        <div class="mb-4">
                            <a href="index.html" class="auth-logo">
                                <img src="{{asset('backend/images/logo-dark.png')}}" alt="logo-dark" class="mx-auto" height="28" />
                            </a>
                        </div>

                        <div class="auth-title-section mb-3">
                            <h3 class="text-dark fs-20 fw-medium mb-2">Reset Password</h3>
                            <p class="text-dark text-capitalize fs-14 mb-0">No worries, we'll send you reset instructions.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-0">

                    <form action="{{ route('password.email') }}" method="post">
                        @csrf

                        <div class="alert alert-info ">Enter your email address, and we'll send you a password reset
                            link.</div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="email_address">Email address</label>
                            <input class="form-control" name="email" type="email" value="{{ old('email') }}"
                                placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit"> Send Reset Link </button>
                        </div>

                    </form>


                    <div class="text-center text-muted mt-3">
                        <p class="mb-0">Remembered your password? <a class='text-primary ms-2 fw-medium'
                                href='{{ route('login') }}'>Login here ?</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-user-guest-layout>
