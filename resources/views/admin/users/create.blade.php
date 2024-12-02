<x-admin-auth-layout>
    @section('title', 'Users | Register')
    @section('page-title', 'Users | Register')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.users.create') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Create Users</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">

                        <div class="my-2 w-100">
                            <h5>Personal Information</h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                placeholder="Enter Name">
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                placeholder="examole@email.com">
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" value="{{ old('password') }}"
                                placeholder="Enter Password">
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-2 w-100">
                            <h5>Contact Information</h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="phone" class="form-control" name="phone" value="{{ old('phone') }}"
                                placeholder="Enter Mobile number">
                            @error('phone')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address') }}"
                                placeholder="Enter address">
                            @error('address')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" name="city" value="{{ old('city') }}"
                                placeholder="Enter city">
                            @error('city')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select name="state" class="form-control">
                                <option value="">---select---</option>                                
                                @foreach ($country->states as $state)
                                    <option value="{{ $state->name }}" @if ($state->name === old('state')) selected @endif>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="country" class="form-label">Country</label>
                            <select name="country" class="form-control">
                                <option value="">---select---</option>
                                <option value="{{ $country->name }}" @if ($country->name === old('country')) selected @endif>
                                    {{ $country->name }}</option>
                            </select>
                            @error('country')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" name="postal_code"
                                value="{{ old('postal_code') }}" placeholder="Enter postal code">
                            @error('postal_code')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="my-2 w-100">
                            <h5>Additional Information</h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label">Wallet</label>
                            <input type="number" class="form-control" name="wallet" value="{{ old('wallet') }}"
                                placeholder="Enter amount">
                            @error('wallet')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="is_active" class="form-label">Active</label>
                            <select name="is_active" class="form-control">
                                <option value="">---select---</option>
                                <option value="1" @if(old('is_active') == "1") selected @endif>active</option>
                                <option value="0" @if(old('is_active') == "0") selected @endif>in-active</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <hr>
                    <button class="btn btn-primary px-5">Create</button>
                </div>

            </div>
        </form>
    </div> <!-- container -->


</x-admin-auth-layout>
