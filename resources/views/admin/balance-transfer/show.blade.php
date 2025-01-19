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
                    <h6 class="text-primary">From Account</h6>
                    <p class="mb-0"><strong>Email:</strong> {{ $balanceTransfer->admin->email }}</p>
                    <p><strong>Name:</strong> {{ $balanceTransfer->admin->name }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">To Account</h6>
                    <p class="mb-0"><strong>Email:</strong> {{ $balanceTransfer->user->email }}</p>
                    <p><strong>Name:</strong> {{ $balanceTransfer->user->name }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-primary">Transaction Details</h6>
                    <p><strong>Transaction ID:</strong> {{ $balanceTransfer->transaction->transaction_id }}</p>
                    <p><strong>Status:</strong> <span class="badge bg-success">{{ ucfirst($balanceTransfer->transaction->status) }}</span></p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">Amount Details</h6>
                    <p><strong>Amount:</strong> {{ number_format($balanceTransfer->transaction->amount, 2) }} {{ $balanceTransfer->transaction->currency->code }}</p>
                    <p><strong>Net Amount:</strong> {{ number_format($balanceTransfer->transaction->net_amount, 2) }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-primary">Balance Information</h6>
                    <p><strong>Opening Balance:</strong> {{ number_format($balanceTransfer->transaction->opening_balance, 2) }}</p>
                    <p><strong>Closing Balance:</strong> {{ number_format($balanceTransfer->transaction->closing_balance, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">Payment Information</h6>
                    <p><strong>Payment Method:</strong> {{ ucfirst($balanceTransfer->transaction->payment_method) }}</p>
                    <p><strong>Transaction Type:</strong> {{ ucfirst($balanceTransfer->transaction->transaction_type) }}</p>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h6 class="text-primary">Technical Details</h6>
                    <p><strong>IP Address:</strong> {{ $balanceTransfer->transaction->ip_address }}</p>
                    <p><strong>User Agent:</strong> {{ $balanceTransfer->transaction->user_agent }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="text-primary">Notes</h6>
                    <p>{{ $balanceTransfer->notes }}</p>
                </div>
            </div>
        </div>
    </div>
</x-admin-auth-layout>
