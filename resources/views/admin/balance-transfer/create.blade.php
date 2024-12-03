<x-admin-auth-layout>
    @section('title', 'Balance Transfer | Create')
    @section('page-title', 'Balance Transfer | Create')
    @section('breadcrumb')
        {{ Breadcrumbs::render('admin.balance-transfer.create') }}
    @endsection
    @section('page-head')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    @endsection

    <form action="{{ route('admin.balance-transfer.store') }}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Balance Transfer</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="user" class="form-label">User</label>
                        <select name="user" class="form-control" id="select-field">
                            <option value="">---select---</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @if (old('user') == $user->id) selected @endif>
                                    {{ $user->name }} - {{ $user->email }} (Balance : {{ $user->wallet }})
                                </option>
                            @endforeach
                        </select>
                        @error('user')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-100"></div>

                    <div class="col-md-6 mb-3">
                        <label for="user" class="form-label">Amount</label>
                        <input type="number" class="form-control" name="amount" placeholder="Enter amount">
                        @error('amount')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="w-100"></div>


                    <div class="col-md-6 mb-3">
                        <label for="user" class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" cols="5" rows="5" placeholder="Write some notes">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary px-5">Transfer</button>
            </div>
        </div>

    </form>

    @section('page-js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $('#select-field').select2({
                theme: 'bootstrap-5'
            });
        </script>
    @endsection

</x-admin-auth-layout>
