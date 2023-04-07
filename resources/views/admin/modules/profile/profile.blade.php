@extends('admin.layout.layout')

@section('page_title', 'Profile')
@section('sub_title', 'Profile')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Update Profile</h3>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" class="form-control" value="{{ $adminData->name }}" id="name"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" value="{{ $adminData->email }}"
                                        id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="mobile" class="form-control" id="mobile"
                                        value="{{ $adminData->mobile }}" placeholder="Mobile">
                                </div>
                                <div class="form-group">
                                    <label for="image">Photo</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="image" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @if (!empty($adminData->image))
                                        <img src="{{ $adminData->image }}" alt="{{ $adminData->name }}">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Update Password</h3>
                        </div>
                        <div class="card-body">
                            @if (Session::has('msg'))
                                <div class="alert alert-{{ Session::get('cls') }} alert-dismissible fade show" role="alert">
                                    {{ Session::get('msg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form action="{{ route('admin.updatepassword') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control" name="current_password"
                                        id="current_password" placeholder="Enter Current Password">
                                    <p class="mb-0 lh-1" id="current_password_msg"></p>
                                </div>
                                <div class="form-group">
                                    <label for="new_password">New Password</label>
                                    <input type="password" name="new_password" class="form-control" id="new_password"
                                        placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control"
                                        id="confirm_password" placeholder="Enter Confirm Password">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('js')
        <script>
            // Current password check
            $('#current_password').keyup(function() {
                let current_password = $(this).val();
                if (current_password != '') {
                    $.ajax({
                        type: 'post',
                        url: 'check-current-password',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            current_password: current_password
                        },
                        success: function(res) {
                            if (res == "false") {
                                $('#current_password_msg').html(
                                    '<span class="text-danger">Password is not currect</span>');
                            } else if (res == "true") {
                                $('#current_password_msg').html(
                                    '<span class="text-success">Password is currect</span>');
                            }
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });
                } else {
                    $('#current_password_msg').html('');
                }
            });
        </script>
    @endpush
@endsection
