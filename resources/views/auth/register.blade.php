<x-user-guest-layout>

    @section('title', 'Register -')

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

                        <form action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control" name="name" type="text" value="{{ old('name') }}"
                                    placeholder="Enter your name">
                                @error('name')
                                    <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                                @enderror
                            </div>

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

                            <div class="form-group mb-3">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control" name="password_confirmation" type="password"
                                    placeholder="Confirm password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback text-danger d-block py-1">* {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Register </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have an account?
                            <a href="{{ route('login') }}" class="text-white font-weight-medium ms-1">Login</a>
                        </p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</x-user-guest-layout>
