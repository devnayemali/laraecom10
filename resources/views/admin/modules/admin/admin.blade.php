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
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            @if ($admin->id == Auth::user()->id)
                                                <td><a href="{{ route('admin.admin-view', $admin->id) }}">{{ $admin->name }}
                                                        (You)
                                                    </a></td>
                                            @else
                                                <td><a
                                                        href="{{ route('admin.admin-view', $admin->id) }}">{{ $admin->name }}</a>
                                                </td>
                                            @endif

                                            <td>{{ $admin->mobile }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->role == \app\Models\User::SUPERADMIN ? 'Super Admin' : 'Admin' }}
                                            </td>
                                            <td>
                                                <div class="switch-item">
                                                    <input type="checkbox" data-status="{{ $admin->status }}" name="status"
                                                        data-id="{{ $admin->id }}" id="admin_{{ $admin->id }}"
                                                        class="control switch_btn"
                                                        {{ $admin->status == 1 ? 'checked' : ' ' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0">Created : {{ $admin->created_at->toDayDateTimeString() }}
                                                </p>
                                                <p class="mb-0">Updated :
                                                    {{ $admin->updated_at == $admin->created_at ? 'Not Updated Yet' : $admin->updated_at->toDayDateTimeString() }}
                                                </p>
                                            </td>

                                            <td>
                                                <a class="mr-1 text-info"
                                                    href="{{ route('admin.admin-view', $admin->id) }}"><i
                                                        class="fas fa-eye"></i></a>


                                                @if ($admin->id == Auth::user()->id)
                                                    |
                                                    <a class="mx-1 text-warning" href="{{ route('admin.profile') }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    {{-- |
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
                                                {!! Form::close() !!} --}}
                                                @endif
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
        <script src="{{ url('admin/js/axios.min.js') }}"></script>
        <script>
            let domain = window.location.origin;

            $('.switch_btn').on('click', function() {
                let admin_id = $(this).attr('data-id');
                let admin_status = $(this).attr('data-status');

                if (admin_status == 1) {
                    $(this).attr('data-status', 0);
                    admin_status = 0;
                } else {
                    $(this).attr('data-status', 1);
                    admin_status = 1;
                }

                axios.post(domain + '/dashboard/admin-status/' + admin_id, {
                        status: admin_status,
                        admin_id: admin_id
                    })
                    .then(function(response) {
                        let status = response.data;
                        if (status == 1) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'User Approved Successfully',
                            })
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'User Unapproved Successfully',
                            })
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });

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
