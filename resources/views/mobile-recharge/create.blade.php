<x-user-auth-layout>
    @section('title', __('Recharge | Create'))
    @section('page-title', 'Recharge | Create')
    @section('breadcrumb')
        {{ Breadcrumbs::render('mobile-recharge.create') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('mobile-recharge.store', ['type' => $type]) }}" method="post">
            @csrf
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">
                        @if ($type === 'mobile')
                            Mobile Recharge
                        @elseif($type === 'dth')
                            DTH Recharge
                        @else
                            Recharge
                        @endif
                    </h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3"></div>
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="mobile_number" class="form-label">
                                    @if ($type === 'mobile')
                                        Mobile Number
                                    @elseif($type === 'dth')
                                        DTH Number
                                    @else
                                        Number
                                    @endif
                                </label>
                                <input type="mobile_number" class="form-control" name="mobile_number"
                                    value="{{ old('mobile_number') }}" placeholder="Enter Mobile number">
                                @error('mobile_number')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="operator" class="form-label">Operator</label>
                                <select name="operator" class="form-control" id="operatorInput">
                                    <option value="">---select---</option>
                                    @foreach ($operators as $operator)
                                        <option value="{{ $operator->code }}"
                                            @if (old('operator') == $operator->code) selected @endif>{{ $operator->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('operator')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="is_active" class="form-label">Circle</label>
                                <select name="circle" class="form-control" id="circleInput">
                                    <option value="">---select---</option>
                                    @foreach ($circles as $circle)
                                        <option value="{{ $circle->code }}"
                                            @if (old('circle') == $circle->code) selected @endif>{{ $circle->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('circle')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Plans</label>
                                <div class="d-flex flex-row justify-content-between gap-2">
                                    <input type="text" name="amount" class="form-control" id="amount"
                                        value="{{ old('amount') }}">
                                    <button type="button" class="btn btn-success" id="fetchPlans">Get Plans</button>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Process</button>

                        </div>

                        <div class="col-md-3"></div>

                    </div>
                </div>
            </div>
        </form>
    </div> <!-- container -->

    <!-- Plan Modals -->
    <!-- Modal -->
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="showPlanModel">
        <div class="modal-dialog modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plans</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" id="showPlans">

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>


    @section('page-js')
        <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
        </script>

        <script>
            $(document).ready(function() {
                $('#fetchPlans').on('click', function() {
                    const operatorInput = $('#operatorInput').val();
                    const circleInput = $('#circleInput').val();

                    // Validate inputs before making the request
                    if (!operatorInput || !circleInput) {
                        toastr.error('Both operator and circle are required.');
                        return; // Stop further execution
                    }

                    // Sanitize inputs (you can also use libraries like DOMPurify for advanced sanitization)
                    const sanitizedOperator = operatorInput.trim();
                    const sanitizedCircle = circleInput.trim();

                    // Show loading overlay
                    $.LoadingOverlay("show");

                    $.ajax({
                        url: '{{ route('mobile-recharge.fetch-plans') }}',
                        type: 'POST',
                        data: {
                            operator: sanitizedOperator,
                            circle: sanitizedCircle,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            $.LoadingOverlay("hide");
                            if (response.error) {
                                toastr.error(response.error);
                            } else {
                                $('#showPlanModel').modal('show');
                                $('#showPlans').html(response);
                            }
                        },
                        error: function(error) {
                            $.LoadingOverlay("hide");
                            if (error.responseJSON && error.responseJSON.error) {
                                toastr.error(error.responseJSON.error);
                            } else {
                                toastr.error('Failed to fetch plans. Please try again later.');
                            }
                        }
                    });
                });
            });

            const setPlanAmt = (amt) => {
                $('#showPlanModel').modal('hide');
                $('#amount').val(amt);
            }
        </script>


    @endsection

</x-user-auth-layout>
