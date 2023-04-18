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
                                    {!! Form::label('country', 'Country') !!}
                                    {!! Form::text('country', $vendorData?->country, ['class' => 'form-control', 'placeholder' => 'Enter Country']) !!}
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

                                {!! Form::model($vendorBusinessData, ['route' => ['admin.updatevendordetails', $slug]]) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Name') !!}
                                    {!! Form::text('name', $vendorBusinessData?->name, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::email('email', $vendorBusinessData?->email, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Email',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('address', 'Address') !!}
                                    {!! Form::text('address', $vendorBusinessData?->address, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Address',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('city', 'City') !!}
                                    {!! Form::text('city', $vendorBusinessData?->city, ['class' => 'form-control', 'placeholder' => 'Enter City']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('state', 'State') !!}
                                    {!! Form::text('state', $vendorBusinessData?->state, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter State',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('country', 'Country') !!}
                                    {!! Form::text('country', $vendorBusinessData?->country, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Country',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('pincode', 'Pincode') !!}
                                    {!! Form::text('pincode', $vendorBusinessData?->pincode, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Pincode',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mobile', 'Mobile') !!}
                                    {!! Form::text('mobile', $vendorBusinessData?->mobile, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Mobile',
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
            @elseif ($slug == 'bangk')
                bank
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
