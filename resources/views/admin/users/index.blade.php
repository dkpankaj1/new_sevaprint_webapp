<x-admin-auth-layout>
    @section('title', 'Users List')
    @section('page-title', 'Users List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.users.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <x-data-table>

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Users List</h5>
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
                        url: "{{ route('admin.users.index') }}",
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
                            data: 'avatar',
                            name: 'avatar',
                            title: 'Img'
                        },
                        {
                            data: 'name',
                            name: 'name',
                            title: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'email',
                            title: 'Email',
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            title: 'Phone'
                        },
                        {
                            data: 'city',
                            name: 'city',
                            title: 'City'
                        },
                        {
                            data: 'state',
                            name: 'state',
                            title: 'State'
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
