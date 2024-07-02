@extends('layouts.contentNavbarLayout')

@section('title', 'Access Page - Access')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-2">Access / Permissions List
            <a href="{{ route('dashboard.access.permissions.create') }}" class="btn btn-primary btn-sm float-end"><i class="mdi mdi-plus"></i> Create</a>
        </h4>
        <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-permissions table border-top">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Guard Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ ++$no }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>
                                <a href="{{ route('dashboard.access.permissions.edit', $permission->slug) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-pen"></i></a>
                                <a href="#" data-id="{{ $permission->slug }}" class="btn btn-icon btn-delete btn-danger">
                                    <i class="mdi mdi-delete"></i>
                                </a>
                                <!-- Form for delete action -->
                                <form action="{{ route('dashboard.access.permissions.destroy', $permission->slug) }}" method="POST" id="delete-{{ $permission->slug }}" style="display: none;">
                                    @csrf
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function (e) {
            e.preventDefault(); // Prevent the default action
            var id = $(this).data('id');
            console.log(id);
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
                    $('#delete-' + id).submit(); // Submit the corresponding form
                }
            });
        });
    });
</script>
@endsection
