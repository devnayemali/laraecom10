@extends('admin.layout.layout')

@section('page_title', 'Admin List')
@section('sub_title', 'Admin List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <th>Id : </th>
                                        <td>{{ $admin->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name : </th>
                                        <td>{{ $admin->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email : </th>
                                        <td>{{ $admin->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mobile : </th>
                                        <td>{{ $admin->mobile }}</td>
                                    </tr>
                                    <tr>
                                        <th>Image : </th>
                                        <td><img src="{{ asset('image/profile/' . $admin->image) }}"
                                                alt="{{ $admin->name }}'s image"></td>
                                    </tr>
                                    <tr>
                                        <th>Status : </th>
                                        <td>{!! $admin->status == 1
                                            ? '<span class="text-success">Active</span>'
                                            : '<span class="text-danger">Inactive</span>' !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Date Time : </th>
                                        <td>
                                            <p class="mb-0">Created : {{ $admin->created_at->toDayDateTimeString() }}
                                            </p>
                                            <p class="mb-0">Updated :
                                                {{ $admin->updated_at == $admin->created_at ? 'Not Updated Yet' : $admin->updated_at->toDayDateTimeString() }}
                                            </p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th></th>
                                        <td><a class="btn btn-success" href="{{ route('admin.index') }}">Back</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    @push('js')
        <script>
            $('.delete_btn').on('click', function() {
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Are you sure to delete ?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#form_${id}`).submit();
                    }
                })
            });
        </script>
    @endpush
@endsection
