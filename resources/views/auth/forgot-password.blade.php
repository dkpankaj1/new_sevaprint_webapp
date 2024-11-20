<x-user-guest-layout>

    @section('title', 'Forget Password -')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="{{ route('home') }}" class="logo-dark">
                                <span><img src="{{ asset('assets/images/logo-dark.png') }}" alt=""
                                        height="22"></span>
                            </a>

                            <a href="{{ route('home') }}" class="logo-light">
                                <span><img src="{{ asset('assets/images/logo-light.png') }}" alt=""
                                        height="22"></span>
                            </a>
                        </div>

                        <form action="{{ route('password.email') }}" method="post">
                            @csrf

                            <div class="alert alert-info">Enter your email address, and we'll send you a password reset
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
                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Remembered your password?
                            <a href="{{ route('login') }}" class="text-white font-weight-medium ms-1">Login here</a>
                        </p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</x-user-guest-layout>
