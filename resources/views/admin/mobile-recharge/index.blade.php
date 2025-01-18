<x-admin-auth-layout>
    @section('title', __('Recharge | History'))
    @section('page-title', 'Recharge | History')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.mobile-recharge.index') }}
    @endsection

    <x-data-table>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Mobile Recharge</h5>
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
                        url: "{{ route('admin.mobile-recharge.index') }}",
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
                            data: 'uniqid',
                            name: 'uniqid',
                            title: "Unique ID"
                        },
                        {
                            data: 'mobile_number',
                            name: 'mobile_number',
                            title: "mobile Number"
                        },
                        {
                            data: 'amount',
                            name: 'amount',
                            title: "Amount"
                        },
                        {
                            data: 'operator',
                            name: "operator",
                            title: 'Operator'
                        },
                        {
                            data: 'type',
                            name: "type",
                            title: 'Type'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            title: "Status"
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
