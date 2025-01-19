<x-user-auth-layout>
    @section('title', __('Wallet'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('wallet.show',$transaction) }}
    @endsection

    <!-- Wallet Overview -->
    <div class="card border-secondary">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Transaction ID:</strong> {{ $transaction->transaction_id }}
                </div>
                <div class="col-md-6 text-end">
                    <strong>Date:</strong> {{ $transaction->created_at }}
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-secondary">Account</h5>
                    <p>
                        <strong>Email:</strong> {{ $transaction->user->email }}<br>
                        <strong>Name:</strong> {{ $transaction->user->name }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-secondary">Transaction Info</h5>
                    <p>
                        <strong>Direction:</strong> {{ ucfirst($transaction->transaction_direction) }}<br>
                        <strong>Status:</strong> {{ $transaction->status }}<br>
                        <strong>Payment Method:</strong> {{ ucfirst($transaction->payment_method) }}<br>
                        <strong>Transaction Type:</strong> {{ ucfirst($transaction->transaction_type) }}
                    </p>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="text-secondary">Amount Details</h5>
                    <p>
                        <strong>Amount:</strong> {{ number_format($transaction->amount, 2) }} {{ $transaction->currency->code }}<br>
                        <strong>Net Amount:</strong> {{ number_format($transaction->amount, 2) }} {{ $transaction->currency->code }}<br>
                        <strong>Opening Balance:</strong> {{ number_format($transaction->opening_balance, 2) }} {{ $transaction->currency->code }}<br>
                        <strong>Closing Balance:</strong> {{ number_format($transaction->closing_balance, 2) }} {{ $transaction->currency->code }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5 class="text-secondary">Technical Details</h5>
                    <p>
                        <strong>Transaction Vendor:</strong> {{ ucfirst($transaction->vendor) }}<br>
                        <strong>IP Address:</strong> {{ $transaction->ip_address }}<br>
                        <strong>User Agent:</strong> {{ $transaction->user_agent }}
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h5 class="text-secondary">Notes</h5>
                    <ul>
                        <ul>
                            @foreach ($transaction->metadata ?? [] as $key => $value)                               
                                <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</x-user-auth-layout>
