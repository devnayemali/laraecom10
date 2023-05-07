@extends('admin.layout.layout')

@section('page_title', 'Category List')
@section('sub_title', 'Category List')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category List Table</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <button type="button" class="btn btn-primary add-modal-btn">
                                        Add New Category
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
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                <div class="switch-item">
                                                    <input type="checkbox" data-status="{{ $category->status }}"
                                                        name="status" data-id="{{ $category->id }}"
                                                        id="category_{{ $category->id }}" class="control switch_btn"
                                                        {{ $category->status == 1 ? 'checked' : ' ' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0">Created :
                                                    {{ $category->created_at->toDayDateTimeString() }}
                                                </p>
                                                <p class="mb-0">Updated :
                                                    {!! $category->updated_at == $category->created_at
                                                        ? '<span class="text-warning">Not Updated Yet</span>'
                                                        : $category->updated_at->toDayDateTimeString() !!}
                                                </p>
                                            </td>

                                            <td>
                                                <button data-category-name="{{ $category->name }}" data-id={{ $category->id }}
                                                    class="btn btn-warning edit-modal-btn border-0"><i
                                                        class="fas fa-edit"></i></button>
                                                <button data-id={{ $category->id }}
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
