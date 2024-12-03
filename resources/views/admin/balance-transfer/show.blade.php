<x-admin-auth-layout>
    @section('title', 'Balance Transfer | Detail')
    @section('page-title', 'Balance Transfer | Detail')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.balance-transfer.show', $balanceTransfer) }}
    @endsection

    <div class="card">

        <div class="card-header d-flex justify-content-between">
            <h5 class="mb-0">Transaction ID: {{ $balanceTransfer->transaction->transaction_id }}</h5>
            <span>Date :{{ $balanceTransfer->transaction->created_at }}</span>
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>From account:</h5>
                    <p>{{ $balanceTransfer->admin->email }} | {{ $balanceTransfer->admin->name }}</p>
                </div>
                <div class="col-md-6">
                    <h5>To account:</h5>
                    <p>{{ $balanceTransfer->user->email }} | {{ $balanceTransfer->user->name }}</p>
                </div>
            </div>

            <!-- Transaction Info Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Transaction ID:</h5>
                    <p>{{ $balanceTransfer->transaction->transaction_id }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Status:</h5>
                    <p>{{ $balanceTransfer->transaction->status }}</p>
                </div>
            </div>

            <!-- Amount & Currency Section -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Amount:</h5>
                    <p>{{ number_format($balanceTransfer->transaction->amount, 2) }}
                        {{ $balanceTransfer->transaction->currency }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Net Amount:</h5>
                    <p>{{ number_format($balanceTransfer->transaction->net_amount, 2) }}</p>
                </div>
            </div>

            <!-- Balance Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Opening Balance:</h5>
                    <p>{{ number_format($balanceTransfer->transaction->opening_balance, 2) }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Closing Balance:</h5>
                    <p>{{ number_format($balanceTransfer->transaction->closing_balance, 2) }}</p>
                </div>
            </div>

            <!-- Payment & Type Info -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Payment Method:</h5>
                    <p>{{ ucfirst($balanceTransfer->transaction->payment_method) }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Transaction Type:</h5>
                    <p>{{ ucfirst($balanceTransfer->transaction->transaction_type) }}</p>
                </div>
            </div>

            <!-- Metadata & Reference -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Reference:</h5>
                    <p>{{ $balanceTransfer->transaction->reference }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Metadata:</h5>
                    <p>{{ $balanceTransfer->transaction->metadata }}</p>
                </div>
            </div>

            <!-- IP and User Agent -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>IP Address:</h5>
                    <p>{{ $balanceTransfer->transaction->ip_address }}</p>
                </div>
                <div class="col-md-6">
                    <h5>User Agent:</h5>
                    <p>{{ $balanceTransfer->transaction->user_agent }}</p>
                </div>
            </div>

            <!-- Notes Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5>Notes:</h5>
                    <p>{{ $balanceTransfer->transaction->notes }}</p>
                </div>
            </div>
        </div>
    </div>



</x-admin-auth-layout>
