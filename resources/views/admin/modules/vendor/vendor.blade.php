@extends('admin.layout.layout')

@section('page_title', 'Vendor ' . ucfirst($slug))
@section('sub_title', 'Vendor ' . ucfirst($slug))

@section('content')
    <section class="content">
        <div class="container-fluid">
            @if ($slug == 'personal')
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Update Details</h3>
                        </div>
                        <div class="card-body">

                            {{-- @if ($errors->any())
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
                            @endif --}}

                            {{-- @if (Session::has('pmsg'))
                                <div class="alert alert-{{ Session::get('cls') }} alert-dismissible fade show"
                                    role="alert">
                                    {{ Session::get('pmsg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif --}}

                            <form action="{{ route('admin.updatevendordetails', 'personal') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $vendorData->name }}" id="name"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" value="{{ $vendorData->address }}" id="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ $vendorData->city }}" id="city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <input type="text" name="state" class="form-control" value="{{ $vendorData->state }}" id="state" placeholder="State">
                                </div>
                                <div class="form-group">
                                    <label for="state">Country</label>
                                    <input type="text" name="country" class="form-control" value="{{ $vendorData->country }}" id="country" placeholder="Country">
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" name="pincode" class="form-control" value="{{ $vendorData->pincode }}" id="pincode" placeholder="Pincode">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" value="{{ $vendorData->mobile }}" id="mobile" placeholder="Mobile">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $vendorData->email }}" id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($slug == 'business')
                business
            @elseif ($slug == 'bangk')
                bank
            @endif
        </div>
    </section>
@endsection
