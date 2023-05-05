@extends('admin.layout.layout')

@section('page_title', 'Vendor ' . ucfirst($slug))
@section('sub_title', 'Vendor ' . ucfirst($slug))

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if ($slug == 'personal')
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Update Personal Details</h3>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="error-msg alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (Session::has('msg'))
                                    <div class="alert alert-{{ Session::get('cls') }} alert-dismissible fade show"
                                        role="alert">
                                        {{ Session::get('msg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {!! Form::model($vendorData, ['route' => ['admin.updatevendordetails', $slug], 'files' => true]) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', $vendorData?->name, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', $vendorData?->email, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mobile', 'Mobile') !!}
                                    {!! Form::text('mobile', $vendorData?->mobile, ['class' => 'form-control', 'placeholder' => 'Enter Mobile']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::text('address', $vendorData?->address, ['class' => 'form-control', 'placeholder' => 'Enter Address']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('city', 'City') !!}
                                    {!! Form::text('city', $vendorData?->city, ['class' => 'form-control', 'placeholder' => 'Enter City']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('state', 'State') !!}
                                    {!! Form::text('state', $vendorData?->state, ['class' => 'form-control', 'placeholder' => 'Enter State']) !!}
                                </div>

                                <div class="form-group">
                                    <label for="country">Country</label>

                                    <select name="country" id="country" class="form-control">
                                        <option>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option {{ $country['id'] == $vendorData?->country ? 'selected' : ' ' }} value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('pincode', 'Pincode') !!}
                                    {!! Form::text('pincode', $vendorData?->pincode, ['class' => 'form-control', 'placeholder' => 'Enter Pincode']) !!}
                                </div>

                                <div class="form-group">
                                    <label for="image_input">Photo</label>
                                    <div class="input-group mb-2">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image_input">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <img class="prifile-img mt-4 imgw-200" id="image_preview">
                                    @if (!empty($vendorData?->image))
                                        <input type="hidden" name="old_image" value="{{ $vendorData?->image }}">
                                        <img width="400px" src="{{ asset('image/vendor/' . $vendorData?->image) }}"
                                            alt="{{ $vendorData?->name }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::button('Update Data', ['type' => 'submit', 'class' => 'btn btn-primary mt-2']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($slug == 'business')
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Update Business Details</h3>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="error-msg alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (Session::has('msg'))
                                    <div class="alert alert-{{ Session::get('cls') }} alert-dismissible fade show"
                                        role="alert">
                                        {{ Session::get('msg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {!! Form::model($vendorBusinessData, ['route' => ['admin.updatevendordetails', $slug], 'files' => true]) !!}

                                <div class="form-group">
                                    {!! Form::label('shop_name', 'Shop Name') !!}
                                    {!! Form::text('shop_name', $vendorBusinessData?->shop_name, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Name',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_address', 'Shop Address') !!}
                                    {!! Form::email('shop_address', $vendorBusinessData?->shop_address, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Address',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_city', 'Shop City') !!}
                                    {!! Form::text('shop_city', $vendorBusinessData?->shop_city, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop City',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_state', 'Shop State') !!}
                                    {!! Form::text('shop_state', $vendorBusinessData?->shop_state, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop State',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    <label for="shop_country">Shop Country</label>

                                    <select name="shop_country" id="shop_country" class="form-control">
                                        <option>Select Country</option>
                                        @foreach ($countries as $country)
                                            <option {{ $country['id'] == $vendorBusinessData?->shop_country ? 'selected' : ' ' }} value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_pincode', 'Shop Pincode') !!}
                                    {!! Form::text('shop_pincode', $vendorBusinessData?->shop_pincode, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Pincode',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_mobile', 'Shop Mobile') !!}
                                    {!! Form::text('shop_mobile', $vendorBusinessData?->shop_mobile, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Mobile',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_email', 'Shop Email') !!}
                                    {!! Form::text('shop_email', $vendorBusinessData?->shop_email, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Email',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('shop_website', 'Shop Website') !!}
                                    {!! Form::text('shop_website', $vendorBusinessData?->shop_website, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Shop Website',
                                    ]) !!}
                                </div>


                                <div class="form-group">
                                    {!! Form::label('address_proof', 'Address Proof') !!}
                                    {!! Form::select(
                                        'address_proof',
                                        [
                                            'passport' => 'Passport',
                                            'votingcard' => 'Voting Card',
                                            'pan' => 'PAN',
                                            'drivinglicene' => 'Driving Licene',
                                            'adharcard' => 'Adhar Card',
                                        ],
                                        $vendorBusinessData?->address_proof,
                                        ['placeholder' => 'Select Proof Type', 'class' => 'form-control'],
                                    ) !!}
                                </div>

                                <div class="form-group">
                                    <label for="image_input">Address Proof Image</label>
                                    <div class="input-group mb-2">
                                        <div class="custom-file">
                                            <input type="file" name="address_proof_image" class="custom-file-input"
                                                id="image_input">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <img class="prifile-img mt-4 imgw-200" id="image_preview">
                                    @if (!empty($vendorBusinessData?->address_proof_image))
                                        <input type="hidden" name="old_image"
                                            value="{{ $vendorBusinessData?->address_proof_image }}">
                                        <img width="400px"
                                            src="{{ asset('image/vendor/' . $vendorBusinessData?->address_proof_image) }}"
                                            alt="{{ $vendorBusinessData?->address_proof_image }}">
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::label('business_license_number', 'Business License Number') !!}
                                    {!! Form::text('business_license_number', $vendorBusinessData?->business_license_number, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Business License Number',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('gst_number', 'GST Number') !!}
                                    {!! Form::text('gst_number', $vendorBusinessData?->gst_number, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter GST Number',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('pan_number', 'PAN Number') !!}
                                    {!! Form::text('pan_number', $vendorBusinessData?->pan_number, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter PAN Number',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::button('Update Data', ['type' => 'submit', 'class' => 'btn btn-primary mt-2']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @elseif ($slug == 'bank')
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Update Bank Details</h3>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="error-msg alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                @if (Session::has('msg'))
                                    <div class="alert alert-{{ Session::get('cls') }} alert-dismissible fade show"
                                        role="alert">
                                        {{ Session::get('msg') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                {!! Form::model($vendorBankData, ['route' => ['admin.updatevendordetails', $slug]]) !!}

                                <div class="form-group">
                                    {!! Form::label('account_holder_name', 'Account Holder Name') !!}
                                    {!! Form::text('account_holder_name', $vendorBankData?->account_holder_name, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter account holder name',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('bank_name', 'Bank Name') !!}
                                    {!! Form::text('bank_name', $vendorBankData?->bank_name, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter bank name',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('account_number', 'Account Number') !!}
                                    {!! Form::text('account_number', $vendorBankData?->account_number, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter account number',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('bank_ifsc_code', 'Bank Ifsc Code') !!}
                                    {!! Form::text('bank_ifsc_code', $vendorBankData?->bank_ifsc_code, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter bank ifsc code',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::button('Update Data', ['type' => 'submit', 'class' => 'btn btn-primary mt-2']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('js')
        <script>
            let image;
            $('#image_preview').hide();
            $('#image_input').on('change', function(e) {
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onloadend = () => {
                    image = reader.result;
                    $('#image_preview').show();
                    $('#image_preview').attr('src', image);
                }
                reader.readAsDataURL(file);
            });
        </script>
    @endpush

@endsection
