@extends('admin.layout.layout')

@section('page_title', 'Section List')
@section('sub_title', 'Section List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Section List Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-primary add-modal-btn">
                                        Add Section
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Section Name</th>
                                        <th>Status</th>
                                        <th>Date Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section)
                                        <tr>
                                            <td>{{ $section->id }}</td>
                                            <td>{{ $section->name }}</td>
                                            <td>
                                                <div class="switch-item">
                                                    <input type="checkbox" data-status="{{ $section->status }}"
                                                        name="status" data-id="{{ $section->id }}"
                                                        id="section_{{ $section->id }}" class="control switch_btn"
                                                        {{ $section->status == 1 ? 'checked' : ' ' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0">Created :
                                                    {{ $section->created_at->toDayDateTimeString() }}
                                                </p>
                                                <p class="mb-0">Updated :
                                                    {!! $section->updated_at == $section->created_at
                                                        ? '<span class="text-warning">Not Updated Yet</span>'
                                                        : $section->updated_at->toDayDateTimeString() !!}
                                                </p>
                                            </td>

                                            <td>
                                                <button data-name="{{ $section->name }}" data-id={{ $section->id }}
                                                    class="btn btn-warning edit-modal-btn border-0"><i
                                                        class="fas fa-edit"></i></button>
                                                <button data-id={{ $section->id }}
                                                    class="btn btn-danger border-0 delete-btn"><i
                                                        class="fas fa-trash"></i></button>
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

    <!-- Add Modal Start -->
    <div class="modal fade" id="add-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Section Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.section-store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="name" name="name" class="form-control" required id="name"
                                placeholder="Name">
                        </div>
                        <div class="form-group">
                            <label for="name">Select Status</label>
                            <select name="status" class="form-control" id="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Add Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal End -->

    <!-- Update Modal Start -->
    <div class="modal fade" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Section Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.section-update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="section_id">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="" class="form-control" required
                                id="update_name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Update Section</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Update Modal End -->

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
            $('.add-modal-btn').on('click', function() {
                $('#add-modal').modal('show');
            });

            $('.edit-modal-btn').on('click', function() {
                let name = $(this).attr('data-name');
                let section_id = $(this).attr('data-id');
                $('#update_name').val(name);
                $('#section_id').val(section_id);
                $('#edit-modal').modal('show');
            });

            let domain = window.location.origin;

            $('.switch_btn').on('click', function() {
                let section_id = $(this).attr('data-id');
                let section_status = $(this).attr('data-status');

                if (section_status == 1) {
                    $(this).attr('data-status', 0);
                    section_status = 0;
                } else {
                    $(this).attr('data-status', 1);
                    section_status = 1;
                }

                axios.post(domain + '/dashboard/section-status/' + section_id, {
                        section_status: section_status,
                        section_id: section_id
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
                                title: 'Section Active Successfully',
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
                                title: 'Section Inactive Successfully',
                            })
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            });

            $('.delete-btn').on('click', function() {
                let id = $(this).attr('data-id');
                let click_row = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(domain + '/dashboard/section-delete/' + id, {
                        id: id
                    })
                    .then(function(response) {
                        let status = response.data;
                        if (status == 1) {
                            click_row.closest("tr").hide(500);
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
                                title: 'Section Delete Successfully',
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
                                title: 'Some Thing Wrong',
                            })
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                    }
                })
            });
        </script>
    @endpush
@endsection
