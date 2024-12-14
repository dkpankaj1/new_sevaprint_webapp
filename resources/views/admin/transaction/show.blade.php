<x-admin-auth-layout>
    @section('title', 'Transaction | Detail')
    @section('page-title', 'Transaction | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction.show', $transaction) }}
    @endsection

    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Transaction ID: {{ $transaction->transaction_id }}</h5>
            <span>Date :{{ $transaction->created_at }}</span>
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Account:</h6>
                    <p class="mb-0">{{ $transaction->user->email }}</p>
                    <p>{{ $transaction->user->name }}</p>
                </div>
            </div>

            <!-- Transaction Info Section -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5>Transaction ID:</h5>
                    <p>{{ $transaction->transaction_id }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Transaction Direction:</h5>
                    <p>{{ ucfirst($transaction->transaction_direction) }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Status:</h5>
                    <p>{{ $transaction->status }}</p>
                </div>
            </div>

            <!-- Amount & Currency Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Amount:</h5>
                    <p>{{ number_format($transaction->amount, 2) }}
                        {{ $transaction->currency->code }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Net Amount:</h5>
                    <p>{{ number_format($transaction->amount, 2) }} {{ $transaction->currency->code }}</p>
                </div>
            </div>

            <!-- Balance Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Opening Balance:</h5>
                    <p>{{ number_format($transaction->opening_balance, 2) }}
                        {{ $transaction->currency->code }}
                    </p>
                </div>
                <div class="col-md-6">
                    <h5>Closing Balance:</h5>
                    <p>{{ number_format($transaction->closing_balance, 2) }}
                        {{ $transaction->currency->code }}
                    </p>
                </div>
            </div>

            <!-- Payment & Type Info -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <h5>Payment Method:</h5>
                    <p>{{ ucfirst($transaction->payment_method) }}</p>
                </div>
                <div class="col-md-4">
                    <h5>Transaction Type:</h5>
                    <p>{{ ucfirst($transaction->transaction_type) }}</p>
                </div>

                <div class="col-md-4">
                    <h5>Transaction Vendor:</h5>
                    <p>{{ ucfirst($transaction->vendor) }}</p>
                </div>
            </div>

            <!-- IP and User Agent -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>IP Address:</h5>
                    <p>{{ $transaction->ip_address }}</p>
                </div>
                <div class="col-md-6">
                    <h5>User Agent:</h5>
                    <p>{{ $transaction->user_agent }}</p>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5>Notes:</h5>
                    <ul>
                        @foreach ($transaction->metadata ?? [] as $key => $value)
                            <li><b>{{ $key }}</b> : {{ $value }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>



</x-admin-auth-layout>
