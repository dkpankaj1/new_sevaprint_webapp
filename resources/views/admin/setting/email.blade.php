<x-admin-auth-layout>
    @section('title', 'Settings | Email')
    @section('page-title', 'Settings | Email')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.settings.email') }}
    @endsection

    <form action="{{ route('admin.settings.email') }}" method="POST">
        @csrf
        
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Email Configuration</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Enable Email</label>
                        <select class="form-control" name="email_enable">
                            <option value="1"
                                {{ old('email_enable', $emailConfigurationSetting->email_enable) == 1 ? 'selected' : '' }}>
                                Yes</option>
                            <option value="0"
                                {{ old('email_enable', $emailConfigurationSetting->email_enable) == 0 ? 'selected' : '' }}>
                                No</option>
                        </select>
                        @error('email_enable')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Host</label>
                        <input type="text" class="form-control" name="smtp_host"
                            value="{{ old('smtp_host', $emailConfigurationSetting->smtp_host) }}"
                            placeholder="Enter SMTP host">
                        @error('smtp_host')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Port</label>
                        <input type="number" class="form-control" name="smtp_port"
                            value="{{ old('smtp_port', $emailConfigurationSetting->smtp_port) }}"
                            placeholder="Enter SMTP port">
                        @error('smtp_port')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Username</label>
                        <input type="text" class="form-control" name="smtp_username"
                            value="{{ old('smtp_username', $emailConfigurationSetting->smtp_username) }}"
                            placeholder="Enter SMTP username">
                        @error('smtp_username')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Password</label>
                        <input type="password" class="form-control" name="smtp_password"
                            value="{{ old('smtp_password', $emailConfigurationSetting->smtp_password) }}"
                            placeholder="Enter SMTP password">
                        @error('smtp_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">SMTP Encryption</label>
                        <select class="form-control" name="smtp_encryption">
                            <option value=""
                                {{ old('smtp_encryption', $emailConfigurationSetting->smtp_encryption) == '' ? 'selected' : '' }}>
                                None</option>
                            <option value="tls"
                                {{ old('smtp_encryption', $emailConfigurationSetting->smtp_encryption) == 'tls' ? 'selected' : '' }}>
                                TLS</option>
                            <option value="ssl"
                                {{ old('smtp_encryption', $emailConfigurationSetting->smtp_encryption) == 'ssl' ? 'selected' : '' }}>
                                SSL</option>
                        </select>
                        @error('smtp_encryption')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">From Address</label>
                        <input type="email" class="form-control" name="from_address"
                            value="{{ old('from_address', $emailConfigurationSetting->from_address) }}"
                            placeholder="Enter from address">
                        @error('from_address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">From Name</label>
                        <input type="text" class="form-control" name="from_name"
                            value="{{ old('from_name', $emailConfigurationSetting->from_name) }}"
                            placeholder="Enter from name">
                        @error('from_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Reply-To Address</label>
                        <input type="email" class="form-control" name="reply_to_address"
                            value="{{ old('reply_to_address', $emailConfigurationSetting->reply_to_address) }}"
                            placeholder="Enter reply-to address">
                        @error('reply_to_address')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Reply-To Name</label>
                        <input type="text" class="form-control" name="reply_to_name"
                            value="{{ old('reply_to_name', $emailConfigurationSetting->reply_to_name) }}"
                            placeholder="Enter reply-to name">
                        @error('reply_to_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary px-5">Update</button>
            </div>
        </div>

    </form>

</x-admin-auth-layout>
