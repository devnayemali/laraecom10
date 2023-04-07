@extends('auth.layouts.layout')

@section('page_title', 'Register')

@section('content')
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card">
            <div class="card-body register-card-body">
                <h3 class="login-box-msg">Register</h3>

                @if ($errors->any())
                    <div class="error-msg alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open(['route' => 'register', 'method' => 'post']) }}

                {{ Form::label('name', 'Name') }}
                {{ Form::text('name', null, ['class' => 'form-control mb-2', 'placeholder' => 'Enter Your Full Name']) }}

                {{ Form::label('email', 'Email') }}
                {{ Form::text('email', null, ['class' => 'form-control mb-2', 'placeholder' => 'Enter Your Email']) }}

                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', ['class' => 'form-control mb-2', 'placeholder' => 'Enter Password']) }}

                {{ Form::label('password_confirmation', 'Confirm Password') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control mb-4', 'placeholder' => 'Enter Confirm Password']) }}

                {{ Form::button('Register', ['class' => 'btn btn-primary mb-2', 'type' => 'submit']) }}
                {{ Form::close() }}
                <a href="{{ route('login') }}" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection
