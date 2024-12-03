<x-admin-auth-layout>
    @section('title', 'Users | List')
    @section('page-title', 'Users | List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.users.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <x-data-table>

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Users List</h5>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add</a>
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
                            data: 'wallet',
                            name: 'wallet',
                            title: 'Wallet'
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

                $(document).ready(function() {
                    let deleteUrl = '';

                    // Open delete confirmation modal
                    $(document).on('click', '.delete-btn', function() {
                        deleteUrl = $(this).data('url');
                        $('#deleteModal').modal('show');
                    });

                    // Confirm delete
                    $('#confirmDelete').on('click', function() {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                $('#deleteModal').modal('hide');
                                if (response.status === "success") {
                                    $('#datatable').DataTable().ajax.reload(null, false);
                                    toastr.success(response.message);
                                }
                                if (response.status === "error") {
                                    toastr.error(response.message);
                                }
                            },
                            error: function() {
                                alert(
                                    'An error occurred while trying to delete the classroom.'
                                );
                            }
                        });
                    });
                });
            });
        </script>
    @endsection

    <x-delete-confirm-model />

</x-admin-auth-layout>
