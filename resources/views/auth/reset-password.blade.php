<x-user-guest-layout>

    @section('title', 'Reset Password ')

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="mb-0 border-0">
                <div class="p-0">
                    <div class="text-center">
                        <div class="mb-4">
                            <a href="index.html" class="auth-logo">
                                <img src="{{asset('dashboard/images/logo-dark.png')}}" alt="logo-dark" class="mx-auto" height="28" />
                            </a>
                        </div>

                        <div class="auth-title-section mb-3">
                            <h3 class="text-dark fs-20 fw-medium mb-2">Welcome back</h3>
                            <p class="text-dark text-capitalize fs-14 mb-0">Please enter your details.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-0">

                    <form method="post" action="{{ route('password.store') }}">
                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">



                        <div class="form-group mb-3">
                            <label class="form-label" for="email_address">Email address</label>
                            <input class="form-control" name="email" type="email"
                                value="{{ old('email', $request->email) }}" placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input class="form-control" name="password" type="password"
                                placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <input class="form-control" name="password_confirmation" type="password"
                                placeholder="Confirm password">
                            @error('password_confirmation')
                                <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit">Reset Password</button>
                        </div>

                    </form>


                    <div class="text-center text-muted mt-3">
                        <p class="mb-0">Go back to the login page.?
                            <a href="{{ route('login') }}" class="text-primary ms-2 fw-medium">Login</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-user-guest-layout>
