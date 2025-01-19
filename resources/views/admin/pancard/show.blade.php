<x-admin-auth-layout>
    @section('title', 'PanCard | Detail')
    @section('page-title', 'PanCard | Detail')
    @section('breadcrumb')
    {{ Breadcrumbs::render('admin.pan-card.show', $panCard) }}
    @endsection


    <!-- Start Content -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">PanCard Application Details</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Apply By</strong></td>
                            <td><span id="apply_by">{{ $panCard->user->email }} | {{ $panCard->user->name }} </span></td>
                        </tr>
                        <tr>
                            <td><strong>Unique ID:</strong></td>
                            <td><span id="uniq_id">{{ $panCard->unique_id }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Application Mode:</strong></td>
                            <td><span id="application_mode">{{ $panCard->application_mode }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Application Type:</strong></td>
                            <td><span id="application_type">{{ $panCard->application_type }}</span></td>
                        </tr>

                        <tr>
                            <td><strong>Acknowledgement Number:</strong></td>
                            <td><span
                                    id="order_id">{{ $panCard->acknowledgement_no ? $panCard->acknowledgement_no : "null" }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Category:</strong></td>
                            <td><span id="category">{{ $panCard->category }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Branch Code:</strong></td>
                            <td><span id="branch_code">{{ $panCard->branch_code }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Name:</strong></td>
                            <td><span id="name">{{ $panCard->name }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Gender:</strong></td>
                            <td><span id="gender">{{ $panCard->gender }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Mobile:</strong></td>
                            <td><span id="mobile">{{ $panCard->mobile }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Email:</strong></td>
                            <td><span id="email">{{ $panCard->email }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>PAN Type:</strong></td>
                            <td><span id="pan_type">{{ $panCard->pan_type }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Consent:</strong></td>
                            <td><span id="consent">{{ $panCard->consent }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Order ID:</strong></td>
                            <td><span id="order_id">{{ $panCard->order_id ? $panCard->order_id : "null" }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Authorization:</strong></td>
                            <td><span id="authorization">{{ $panCard->authorization ? "Generate" : "null" }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Message:</strong></td>
                            <td><span id="message">{{ $panCard->message ? $panCard->message : "null" }}</span></td>
                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <td><span id="status" class="badge bg-success">{{ $panCard->status }}</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- container -->


</x-admin-auth-layout>