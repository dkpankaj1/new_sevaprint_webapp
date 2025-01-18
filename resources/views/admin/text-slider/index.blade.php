<x-admin-auth-layout>
    @section('title', 'Text Slider | List')
    @section('page-title', 'Text Slider | List')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.website.text-slider.index') }}
    @endsection
    <!-- Start Content-->
    <div class="container-fluid">

        <x-data-table>

            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Text Slider List</h5>
                        <a href="{{route('admin.website.text-slider.create')}}" class="btn btn-primary">Add New</a>
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
                        url: "{{ route('admin.website.text-slider.index') }}",
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
                            data: 'title',
                            name: 'title',
                            title: 'Title'
                        },
                        {
                            data: 'is_active',
                            name: 'is_active',
                            title: 'Status',
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            title: 'Create At',
                            searchable: false
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at',
                            title: 'Update At',
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
        </script>
    @endsection

    <x-delete-confirm-model />

</x-admin-auth-layout>
