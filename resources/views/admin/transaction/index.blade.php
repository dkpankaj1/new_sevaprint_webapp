<x-admin-auth-layout>
    @section('title', 'Transaction | List')
    @section('page-title', 'Transaction | List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.transaction.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

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

    </div> <!-- container -->

    @section('page-js')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('admin.transaction.index') }}",
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
                            data: 'user',
                            name: 'user',
                            title: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            title: 'Email'
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
                            data: 'net_amount',
                            name: 'net_amount',
                            title: 'Amount'
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
                        },
                        {
                            data: 'action',
                            name: 'action',
                            title: 'Action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });


            });
        </script>
    @endsection

</x-admin-auth-layout>
