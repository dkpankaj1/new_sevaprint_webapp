<x-user-auth-layout>
    @section('title', __('Wallet'))
    @section('breadcrumb')
        {{ Breadcrumbs::render('wallet.index') }}
    @endsection

    <!-- Wallet Overview -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="card-title">
                        My Wallet
                    </h3>
                    <div class="my-4">
                        <h6 class="mb-0">Wallet Balance</h6>
                        <h2 class="text-success">{{ $generalSetting->currency->symbol }} {{ auth()->user()->wallet }}
                        </h2>
                    </div>
                </div>
                <div>
                    <a class="btn btn-primary me-2" href="{{route('wallet.recharge')}}">
                        <i data-feather="plus-circle"></i> Add Balance
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction History in a Card -->
    <x-data-table>

        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Transaction List</h5>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <table id="datatable" class="table table-striped dt-responsive nowrap w-100">
                </table>
            </div>

        </div>

    </x-data-table>

    @section('page-js')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('wallet.index') }}",
                        type: "GET",
                        dataType: "json"
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            title: '#',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'transaction_id',
                            name: 'transaction_id',
                            title: 'Transaction ID'
                        },
                        {
                            data: 'transaction_type',
                            name: 'transaction_type',
                            title: 'Type'
                        },
                        {
                            data: 'transaction_direction',
                            name: 'transaction_direction',
                            title: 'Direction'
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            title: 'Amount'
                        },

                        {
                            data: 'fee',
                            name: 'fee',
                            title: 'Fee'
                        },

                        {
                            data: 'tax',
                            name: 'tax',
                            title: 'Tax'
                        },
                        {
                            data: 'opening_balance',
                            name: 'opening_balance',
                            title: 'Opening Balance'
                        },
                        {
                            data: 'closing_balance',
                            name: 'closing_balance',
                            title: 'Closing Balance'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            title: 'Status'
                        }
                    ]
                });


            });
        </script>
    @endsection



</x-user-auth-layout>
