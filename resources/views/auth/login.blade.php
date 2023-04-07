@extends('auth.layouts.layout')

@section('page_title', 'Login')

@section('content')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <div class="card-body login-card-body">
                    <h3 class="login-box-msg">Login</h3>

                    @if ($errors->any())
                        <div class="error-msg alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open(['route' => 'login', 'method' => 'post']) }}

                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['class' => 'form-control mb-2', 'placeholder' => 'Enter Your Email']) }}

                    {{ Form::label('password', 'Password') }}
                    {{ Form::password('password', ['class' => 'form-control mb-4', 'placeholder' => 'Enter Password']) }}

                    {{ Form::button('Login', ['class' => 'btn btn-primary mb-4', 'type' => 'submit']) }}
                    {{ Form::close() }}

                    <p class="mb-1">
                        <a href="#">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="{{ route('register') }}" class="text-center">Create a New Account</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    @endsection
