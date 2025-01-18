<x-user-auth-layout>
    @section('title', __('NSDL | PanCard Applications'))
    @section('page-title', 'NSDL | PanCard Applications')
    @section('breadcrumb')
        {{ Breadcrumbs::render('nsdl.pan-card.index') }}
    @endsection

    <x-data-table>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">PanCard Applications</h5>
                    <a href="{{ route('nsdl.pan-card.create') }}" class="btn btn-primary">Apply new</a>
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
                        url: "{{ route('nsdl.pan-card.index') }}",
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
                        },
                        {
                            data: 'more',
                            name: 'more',
                            title: 'More',
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

</x-user-auth-layout>
