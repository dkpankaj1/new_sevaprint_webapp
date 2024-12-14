<x-admin-auth-layout>
    @section('title', 'Balance Transfer | Detail')
    @section('page-title', 'Balance Transfer | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.balance-transfer.show', $balanceTransfer) }}
    @endsection

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Transaction ID: {{ $balanceTransfer->transaction->transaction_id }}</h5>
                <span class="text-muted">Date: {{ $balanceTransfer->transaction->created_at }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">From Account:</h6>
                    <p class="mb-0">{{ $balanceTransfer->admin->email }}</p>
                    <p>{{ $balanceTransfer->admin->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">To Account:</h6>
                    <p class="mb-0">{{ $balanceTransfer->user->email }}</p>
                    <p>{{ $balanceTransfer->user->name }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Transaction ID:</h6>
                    <p>{{ $balanceTransfer->transaction->transaction_id }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Status:</h6>
                    <p>{{ $balanceTransfer->transaction->status }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Amount:</h6>
                    <p>{{ number_format($balanceTransfer->transaction->amount, 2) }} {{ $balanceTransfer->transaction->currency->code }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Net Amount:</h6>
                    <p>{{ number_format($balanceTransfer->transaction->net_amount, 2) }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Opening Balance:</h6>
                    <p>{{ number_format($balanceTransfer->transaction->opening_balance, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Closing Balance:</h6>
                    <p>{{ number_format($balanceTransfer->transaction->closing_balance, 2) }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">Payment Method:</h6>
                    <p>{{ ucfirst($balanceTransfer->transaction->payment_method) }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">Transaction Type:</h6>
                    <p>{{ ucfirst($balanceTransfer->transaction->transaction_type) }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-muted">IP Address:</h6>
                    <p>{{ $balanceTransfer->transaction->ip_address }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-muted">User Agent:</h6>
                    <p>{{ $balanceTransfer->transaction->user_agent }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <h6 class="text-muted">Notes:</h6>
                    <p>{{ $balanceTransfer->transaction->notes }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-auth-layout>
