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
                            <h3 class="card-title">Add Section</h3>
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

                            <form action="{{ route('admin.updateprofile') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="name" name="name" class="form-control" id="name"
                                        placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mt-2">Add Section</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
