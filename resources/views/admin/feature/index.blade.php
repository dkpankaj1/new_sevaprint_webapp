<x-admin-auth-layout>
    @section('title', 'Feature | List')
    @section('page-title', 'Feature | List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.feature.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <x-data-table>

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Feature List</h5>
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
                        url: "{{ route('admin.feature.index') }}",
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
                            data: 'thumbnail',
                            name: 'thumbnail',
                            title: "Img"
                        },
                        {
                            data: 'code',
                            name: 'code',
                            title: 'Code'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            title: 'Name'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            title: 'Status',
                        },

                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            title: 'Last Update',
                            searchable: false
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

    <x-delete-confirm-model />

</x-admin-auth-layout>
