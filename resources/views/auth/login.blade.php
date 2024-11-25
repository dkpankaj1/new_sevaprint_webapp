<x-user-guest-layout>

    @section('title', 'Login')

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

                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label" for="email_address">Email address</label>
                            <input class="form-control" name="email" type="email" value="{{ old('email') }}"
                                placeholder="Enter your email">
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

                        <div class="form-group d-flex mb-3">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class='text-muted fs-14' href='{{ route('password.request') }}'>Forgot
                                    password?</a>
                            </div>
                        </div>

                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary w-100" type="submit"> Log In </button>
                        </div>

                    </form>


                    <div class="text-center text-muted mt-3">
                        <p class="mb-0">Don't have an account ?<a class='text-primary ms-2 fw-medium'
                                href='{{ route('register') }}'>Sign Up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-guest-layout>
