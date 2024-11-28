<x-admin-auth-layout>
    @section('title', 'Edit users detail')
    @section('page-title', 'Edit users detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.users.edit',$user) }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

            <form action="{{ route('admin.users.update',$user) }}" method="post">
                @csrf
                @method('put')
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit users</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">

                            <div class="my-2 w-100">
                                <h5>Personal Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}"
                                    placeholder="Enter Name">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email',$user->email) }}"
                                    placeholder="examole@email.com">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="my-2 w-100">
                                <h5>Contact Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" class="form-control" name="phone" value="{{ old('phone',$user->phone) }}"
                                    placeholder="Enter Mobile number">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address',$user->address) }}"
                                    placeholder="Enter address">
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" name="city" value="{{ old('city',$user->city) }}"
                                    placeholder="Enter city">
                                @error('city')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" name="state" value="{{ old('state',$user->state) }}"
                                    placeholder="Enter state">
                                @error('state')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control" name="country" value="{{ old('country',$user->country) }}"
                                    placeholder="Enter country">
                                @error('country')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" name="postal_code"
                                    value="{{ old('postal_code',$user->postal_code) }}" placeholder="Enter postal code">
                                @error('postal_code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="my-2 w-100">
                                <h5>Additional Information</h5>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="is_active" class="form-label">Active</label>
                                <select name="is_active" class="form-control">
                                    <option value="">---select---</option>
                                    <option value="1" @if($user->is_active === 1) selected @endif>active</option>
                                    <option value="0" @if($user->is_active === 0) selected @endif>in-active</option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <hr>
                        <button class="btn btn-primary px-5">Update</button>
                    </div>

                </div>
            </form>

    </div> <!-- container -->


</x-admin-auth-layout>
