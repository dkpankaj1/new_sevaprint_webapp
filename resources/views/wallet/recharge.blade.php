<x-user-auth-layout>
    @section('title', __('Wallet - Recharge'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('wallet.recharge') }}
    @endsection

    <form action="{{ route('wallet.recharge') }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Wallet Recharge </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <select name="amount" class="form-control">
                                <option value="">--select amount---</option>
                                <option value="1" @if (old('amount') === '1') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 1</option>
                                <option value="100" @if (old('amount') === '100') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 100</option>
                                <option value="500" @if (old('amount') === '500') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 500</option>
                                <option value="1000" @if (old('amount') === '1000') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 1000</option>
                                <option value="1500" @if (old('amount') === '1500') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 1500</option>
                                <option value="2000" @if (old('amount') === '2000') selected @endif>
                                    {{ $generalSetting->currency->symbol }} 2000</option>
                            </select>
                            @error('amount')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle table-nowrap mb-0">
                                    <tbody>
                                        @foreach ([$phonePePG, $razorPeyPG, $nicePePG] as $gateway)
                                            @if ($gateway->enable)
                                                <tr>
                                                    <td class="d-flex align-items-center">
                                                        <div
                                                            class="avatar-md me-3 align-items-center justify-content-center d-flex">
                                                            <img src="{{ $gateway->logo }}"
                                                                class="img-fluid rounded-circle" alt="team image">
                                                        </div>
                                                        <div>
                                                            <h5 class="fs-14 my-1">{{ $gateway->name }}</h5>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="vendor" value="{{ $gateway->name }}">
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @error('vendor')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <hr>
                            <button class="btn btn-success px-4">Pay Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>





</x-user-auth-layout>
