<x-user-auth-layout>
    @section('title', $formData ? 'NSDL | PanCard Edit' : 'NSDL | PanCard Apply')
    @section('page-title', $formData ? 'NSDL | PanCard Edit' : 'NSDL | PanCard Apply')
    @section('breadcrumb')
        {{ $formData ? Breadcrumbs::render('nsdl.pan-card.edit', $formData) : Breadcrumbs::render('nsdl.pan-card.create') }}
    @endsection

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ $formData ? route('nsdl.pan-card.update', $formData) : route('nsdl.pan-card.store') }}"
            method="post">
            @csrf
            @if ($formData)
                @method('PUT')
            @endif

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">
                        PanCard Application
                    </h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-2"></div>

                        <div class="col-md-8">

                            <div class="row">

                                <!-- Application mode selectInput-->
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Application Mode</label>
                                    <select name="application_mode" class="form-control">
                                        <option value="" selected disabled>--select application mode--
                                        </option>
                                        <option value="EKYC" @if (old('application_mode', $formData->application_mode ?? '') == 'EKYC') selected @endif>
                                            Instant PAN application through e-KYC method
                                        </option>
                                        <option value="ESIGN" @if (old('application_mode', $formData->application_mode ?? '') == 'ESIGN') selected @endif>
                                            Scan based PAN application</option>
                                    </select>
                                    @error('application_mode')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Application type selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Application Type</label>
                                    <select name="application_type" class="form-control">
                                        <option value="" selected disabled>--select application type--
                                        </option>
                                        <option value="49A" @if (old('application_type', $formData->application_type ?? '') == '49A') selected @endif>PAN
                                            - Indian Citizen (Form 49A)</option>
                                        <option value="CR" @if (old('application_type', $formData->application_type ?? '') == 'CR') selected @endif>
                                            Changes/Correction/Reprint PAN application</option>
                                    </select>
                                    @error('application_type')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- category selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Category</label>
                                    <select name="category" class="form-control">
                                        <option value="" selected disabled>--select category--</option>
                                        <option value="P" @if (old('category', $formData->category ?? '') == 'P') selected @endif>
                                            Individual</option>
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- name selectInput-->
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter name"
                                        value="{{ old('name', $formData->name ?? '') }}">
                                    @error('name')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- gender selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="" selected disabled>--select gender--</option>
                                        <option value="M" @if (old('gender', $formData->gender ?? '') == 'M') selected @endif>
                                            Male</option>
                                        <option value="F" @if (old('gender', $formData->gender ?? '') == 'F') selected @endif>
                                            Female</option>
                                        <option value="T" @if (old('gender', $formData->gender ?? '') == 'T') selected @endif>
                                            Trans</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- mobile selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control"
                                        placeholder="+91 9794xxx940"
                                        value="{{ old('mobile', $formData->mobile ?? '') }}">
                                    @error('mobile')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- email selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control"
                                        placeholder="example@email.com"
                                        value="{{ old('email', $formData->email ?? '') }}">
                                    @error('email')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- pan type selectInput-->
                                <div class="col-md-6 mb-3">
                                    <label for="" class="form-label">PAN Type</label>
                                    <select name="pan_type" class="form-control">
                                        <option value="" selected disabled>--select PAN type--</option>
                                        <option value="Y" @if (old('pan_type', $formData->pan_type ?? '') == 'Y') selected @endif>
                                            Both Physical PAN and e-PAN</option>
                                        <option value="N" @if (old('pan_type', $formData->pan_type ?? '') == 'N') selected @endif>
                                            Only e-PAN</option>
                                    </select>
                                    @error('pan_type')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- pan type selectInput-->
                                <div class="col-12">
                                    <div class="form-check mb-2">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="consent"
                                            id="flexCheckDefault" 
                                            @if (!empty($formData) && $formData->consent == 'Y') checked @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            I have no objection in authenticating myself and fully understand that
                                            information provided by me shall be used for authenticating my identity
                                            through Aadhaar Authentication System for the purpose stated above and
                                            no other purpose.
                                        </label>
                                    </div>
                                    @error('consent')
                                        <span class="invalid-feedback text-danger d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                

                            </div>

                            <hr>
                            <button class="btn btn-primary px-5">Process</button>

                        </div>

                        <div class="col-md-2"></div>

                    </div>
                </div>
            </div>
        </form>
    </div> <!-- container -->




</x-user-auth-layout>
