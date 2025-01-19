<x-admin-auth-layout>
    @section('title', 'PanCard | List')
    @section('page-title', 'PanCard | List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.pan-card.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <x-data-table>

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">PAN Application</h5>
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
                        url: "{{ route('admin.pan-card.index') }}",
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
                            data: 'unique_id',
                            name: 'unique_id',
                            title: "Unique ID"
                        },
                        {
                            data: 'name',
                            name: 'name',
                            title: "Name"
                        },
                        {
                            data: 'email',
                            name: 'email',
                            title: "Email"
                        },
                        {
                            data: 'mobile',
                            name: 'mobile',
                            title: "mobile"
                        },
                        {
                            data: 'acknowledgement_no',
                            name: 'acknowledgement_no',
                            title: 'Acknowledgement No',
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
