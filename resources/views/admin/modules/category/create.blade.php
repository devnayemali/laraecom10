@extends('admin.layout.layout')

@section('page_title', 'Category Create')
@section('sub_title', 'Category Create')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Add Category</h3>
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

                    {!! Form::open(['route' => 'admin.category-store', 'method' => 'post', 'files' => true]) !!}
                    <div class="row justify-content-center">
                        <div class="col-xl-6">
                            <div class="mr-2">
                                <div class="form-group">
                                    {!! Form::label('category_name', 'Category Name') !!}
                                    {!! Form::text('category_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Name']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('section_id', 'Select Section') !!}
                                    {!! Form::select('section_id', $section, null, ['class' => 'form-control', 'placeholder' => 'Select Section']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description', 'Category Description') !!}
                                    {!! Form::textarea('url', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Category Description',
                                        'cols' => 20,
                                        'rows' => 5,
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('meta_description', 'Category Meta Description') !!}
                                    {!! Form::textarea('meta_description', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Meta Description',
                                        'cols' => 20,
                                        'rows' => 5,
                                    ]) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="ml-2">
                                <div class="form-group">
                                    {!! Form::label('parent_id', 'Select Parent Category') !!}
                                    {!! Form::select('parent_id', $parent_cat, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Select Parent Category',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('url', 'Category URL') !!}
                                    {!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Enter Category URL']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('category_discount', 'Category Discount') !!}
                                    {!! Form::text('category_discount', null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Enter Category Discount',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('meta_title', 'Category Meta Title') !!}
                                    {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Category Meta Title']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('status', 'Select Status') !!}
                                    {!! Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Select Status',
                                    ]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('category_image', 'Category Image') !!}
                                    {!! Form::file('photo', ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::button('Add New Category', ['class' => 'btn btn-primary', 'type' => 'submit']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </section>

    @if (session('msg'))
        @push('js')
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: '{{ session('cls') }}',
                    title: '{{ session('msg') }}'
                });
            </script>
        @endpush
    @endif

@endsection
