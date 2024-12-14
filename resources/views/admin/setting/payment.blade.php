<x-admin-auth-layout>
    @section('title', 'Settings | Payment Getaway')
    @section('page-title', 'Settings | Payment Getaway')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.settings.payment-getaway') }}
    @endsection

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">PhonePe Configuration</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.payment-getaway') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="getaway" value="phonepe">
                <div class="row">

                    <div class="col-md-8">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="phonepe-name" class="form-label">Name</label>
                                <input type="text" id="phonepe-name" name="phonepe_name" value="{{ $phonePe->name }}"
                                    class="form-control" placeholder="Enter gateway name" disabled>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phonepe-merchant-id" class="form-label">Merchant ID</label>
                                <input type="text" id="phonepe-merchant-id" name="phonepe_merchant_id"
                                    value="{{ old('phonepe_merchant_id', $phonePe->merchant_id) }}"
                                    class="form-control @error('phonepe_merchant_id') is-invalid @enderror"
                                    placeholder="Enter merchant ID" required>
                                @error('phonepe_merchant_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phonepe-salt-key" class="form-label">Salt Key</label>
                                <input type="text" id="phonepe-salt-key" name="phonepe_salt_key"
                                    value="{{ old('phonepe_salt_key', $phonePe->salt_key) }}"
                                    class="form-control @error('phonepe_salt_key') is-invalid @enderror"
                                    placeholder="Enter salt key" required>
                                @error('phonepe_salt_key')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phonepe-salt-index" class="form-label">Salt Index</label>
                                <input type="number" id="phonepe-salt-index" name="phonepe_salt_index"
                                    value="{{ old('phonepe_salt_index', $phonePe->salt_index) }}"
                                    class="form-control @error('phonepe_salt_index') is-invalid @enderror"
                                    placeholder="Enter salt index" required>
                                @error('phonepe_salt_index')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phonepe-description" class="form-label">Description</label>
                                <input type="text" id="phonepe-description" name="phonepe_description"
                                    value="{{ old('phonepe_description', $phonePe->description) }}"
                                    class="form-control @error('phonepe_description') is-invalid @enderror"
                                    placeholder="Enter description" />
                                @error('phonepe_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="phonepe-enable" class="form-label">Enable</label>
                                <select id="phonepe-enable" name="phonepe_enable"
                                    class="form-select @error('phonepe_enable') is-invalid @enderror" required>
                                    <option value="">---select---</option>
                                    <option value="1" @if ($phonePe->enable === 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if ($phonePe->enable === 0) selected @endif>No</option>
                                </select>
                                @error('phonepe_enable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-image-upload id="phonepe-logo" name="phonepe_logo" :previewUrl="old('phonepe_logo', $phonePe->logo ?? '')" />
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <button class="btn btn-primary px-5 mt-3" type="submit">Update</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">RazorPay Configuration</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.payment-getaway') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="getaway" value="razorpey">
                <div class="row">

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="razorpay-name" class="form-label">Name</label>
                                <input type="text" id="razorpay-name" name="razorpay_name" value="{{ $razorPe->name }}"
                                    class="form-control" placeholder="Enter gateway name" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="razorpay-api-key" class="form-label">API Key</label>
                                <input type="text" id="razorpay-api-key" name="razorpay_api_key"
                                    value="{{ old('razorpay_api_key', $razorPe->api_key) }}"
                                    class="form-control @error('razorpay_api_key') is-invalid @enderror"
                                    placeholder="Enter API key" required>
                                @error('razorpay_api_key')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="razorpay-api-secret" class="form-label">API Secret</label>
                                <input type="text" id="razorpay-api-secret" name="razorpay_api_secret"
                                    value="{{ old('razorpay_api_secret', $razorPe->api_secret) }}"
                                    class="form-control @error('razorpay_api_secret') is-invalid @enderror"
                                    placeholder="Enter API secret" required>
                                @error('razorpay_api_secret')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="razorpay-webhook-secret" class="form-label">Webhook Secret</label>
                                <input type="text" id="razorpay-webhook-secret" name="razorpay_webhook_secret"
                                    value="{{ old('razorpay_webhook_secret', $razorPe->webhook_secret) }}"
                                    class="form-control @error('razorpay_webhook_secret') is-invalid @enderror"
                                    placeholder="Enter webhook secret" required>
                                @error('razorpay_webhook_secret')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="razorpay-description" class="form-label">Description</label>
                                <input type="text" id="razorpey-description" name="razorpay_description"
                                    value="{{ old('razorpay_description', $razorPe->description) }}"
                                    class="form-control @error('razorpay_description') is-invalid @enderror"
                                    placeholder="Enter description" />
                                @error('razorpay_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="razorpay-enable" class="form-label">Enable</label>
                                <select id="razorpay-enable" name="razorpay_enable"
                                    class="form-select @error('razorpay_enable') is-invalid @enderror" required>
                                    <option value="">---select---</option>
                                    <option value="1" @if ($razorPe->enable === 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if ($razorPe->enable === 0) selected @endif>No
                                    </option>
                                </select>
                                @error('razorpay_enable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <x-image-upload id="razorpay-logo" name="razorpay_logo" :previewUrl="old('razorpay_logo', $razorPe->logo ?? '')" />
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <button class="btn btn-primary px-5 mt-3" type="submit">Update</button>
            </form>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">NicePe Configuration</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.payment-getaway') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="getaway" value="nicepe">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nicepe-name" class="form-label">Name</label>
                                <input type="text" id="nicepe-name" name="nicepe_name" value="{{ $nicePe->name }}"
                                    class="form-control" placeholder="Enter gateway name" disabled>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nicepe-nicepe_upi_id" class="form-label">UPI ID</label>
                                <input type="text" id="nicepe-nicepe_upi_id" name="nicepe_upi_id"
                                    value="{{ old('nicepe_upi_id', $nicePe->upi_id) }}"
                                    class="form-control @error('nicepe_upi_id') is-invalid @enderror"
                                    placeholder="Enter UPI ID" required>
                                @error('nicepe_upi_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nicepe-token" class="form-label">Token</label>
                                <input type="text" id="nicepe-token" name="nicepe_token"
                                    value="{{ old('nicepe_token', $nicePe->token) }}"
                                    class="form-control @error('nicepe_token') is-invalid @enderror"
                                    placeholder="Enter Token" required>
                                @error('nicepe_token')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nicepe-secret-key" class="form-label">Secret Key</label>
                                <input type="text" id="nicepe-secret-key" name="nicepe_secret_key"
                                    value="{{ old('nicepe_secret_key', $nicePe->secret_key) }}"
                                    class="form-control @error('nicepe_secret_key') is-invalid @enderror"
                                    placeholder="Enter merchant ID" required>
                                @error('nicepe_secret_key')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nicepe-description" class="form-label">Description</label>
                                <input type="text" id="nicepe-api-key" name="nicepe_description"
                                    value="{{ old('nicepe_description', $nicePe->description) }}"
                                    class="form-control @error('nicepe_description') is-invalid @enderror"
                                    placeholder="Enter API key" required>
                                @error('nicepe_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nicepe-enable" class="form-label">Enable</label>
                                <select id="nicepe-enable" name="nicepe_enable"
                                    class="form-select @error('nicepe_enable') is-invalid @enderror" required>
                                    <option value="">---select---</option>
                                    <option value="1" @if ($nicePe->enable === 1) selected @endif>Yes
                                    </option>
                                    <option value="0" @if ($nicePe->enable === 0) selected @endif>No
                                    </option>
                                </select>
                                @error('nicepe_enable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <x-image-upload id="nicepe-logo" name="nicepe_logo" :previewUrl="old('nicepe_logo', $nicePe->logo ?? '')" />
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button class="btn btn-primary px-5 mt-3" type="submit">Update</button>
            </form>
        </div>
    </div>


</x-admin-auth-layout>
