<x-user-auth-layout>
    @section('title', __('NSDL | Transaction Status'))
    @section('page-title', 'NSDL | Transaction Status')
    @section('breadcrumb')
        {{ Breadcrumbs::render('nsdl.transaction-status') }}
    @endsection

    <!-- Start Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Transaction Status</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form action="{{ route('nsdl.transaction-status') }}" method="POST" class="mb-3">
                            @csrf
                            {{-- order id Input --}}
                            <div class="mb-3">
                                <label for="order_id" class="form-label">Order ID</label>
                                <input type="text" name="order_id" class="form-control" placeholder="Order ID"
                                    value="{{ old('order_id') }}">
                                @error('order_id')
                                    <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary">Check Status</button>

                        </form>

                        @if (!is_null($txnStatus))
                            <hr>
                            @if ($txnStatus['status'] === 'SUCCESS')
                                <div class="alert alert-success">
                                    {{ $txnStatus['message'] }}
                                </div>

                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('Transaction Status') }}</th>
                                            <td>{{ $txnStatus['data']['txn_status'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Acknowledgment Number') }}</th>
                                            <td>{{ $txnStatus['data']['ack_no'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Order ID') }}</th>
                                            <td>{{ $txnStatus['data']['order_id'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Parent Order ID') }}</th>
                                            <td>{{ $txnStatus['data']['p_order_id'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Transaction Amount') }}</th>
                                            <td>{{ $txnStatus['data']['txn_amount'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Opening Balance') }}</th>
                                            <td>{{ $txnStatus['data']['opening_bal'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Closing Balance') }}</th>
                                            <td>{{ $txnStatus['data']['closing_bal'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Transaction Description') }}</th>
                                            <td>{{ $txnStatus['data']['txn_description'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Timestamp') }}</th>
                                            <td>{{ $txnStatus['data']['timestamp'] ?? __('N/A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @elseif ($txnStatus['status'] === 'ERROR')
                                <div class="alert alert-danger">
                                    {{ $txnStatus['message'] }}
                                </div>

                                <table class="table table-bordered mt-4">
                                    <tbody>
                                        <tr>
                                            <th>{{ __('Transaction Status') }}</th>
                                            <td>{{ $txnStatus['data']['txn_status'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Acknowledgment Number') }}</th>
                                            <td>{{ $txnStatus['data']['ack_no'] ?? __('N/A') }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ __('Error Message') }}</th>
                                            <td>{{ $txnStatus['data']['err_msg'] ?? __('No additional information provided.') }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-warning">
                                    {{ __('Unknown transaction status.') }}
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                {{ __('No transaction details available.') }}
                            </div>
                        @endif

                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
</x-user-auth-layout>
