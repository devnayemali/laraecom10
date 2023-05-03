@extends('admin.layout.layout')

@section('page_title', 'Admin List')
@section('sub_title', 'Admin List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td><a href="{{ $admin->id }}">{{ $admin->name }}</a></td>
                                            <td>{{ $admin->mobile }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{!! $admin->status == 1
                                                ? '<span class="text-success">Active</span>'
                                                : '<span class="text-danger">Inactive</span>' !!}</td>
                                            <td>
                                                <p class="mb-0">Created : {{ $admin->created_at->toDayDateTimeString() }}
                                                </p>
                                                <p class="mb-0">Updated :
                                                    {{ $admin->updated_at == $admin->created_at ? 'Not Updated Yet' : $admin->updated_at->toDayDateTimeString() }}
                                                </p>
                                            </td>

                                            <td>
                                                <a class="mr-1 text-info" href="#"><i class="fas fa-eye"></i></a> |
                                                <a class="mx-1 text-warning" href="#"><i class="fas fa-edit"></i></a>
                                                |

                                                {!! Form::open([
                                                    'method' => 'delete',
                                                    'id' => 'form_' . $admin->id,
                                                    'route' => ['admin.destroy', $admin->id],
                                                    'class' => 'd-inline-block',
                                                ]) !!}
                                                {!! Form::button('<i class="text-danger fas fa-trash"></i>', [
                                                    'type' => 'button',
                                                    'data-id' => $admin->id,
                                                    'class' => 'delete_btn ml-1 border-0 bg-transparent',
                                                ]) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
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
