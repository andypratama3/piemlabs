@extends('layouts.contentNavbarLayout')

@section('title', 'Access Page - Access')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary text-center">Edit permission</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.access.permissions.update', $permission->slug) }}" method="POST" id="formEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="slug" value="{{ $permission->slug }}">
                    <div class="form-group">
                        <label for="name" class="form-label text-primary">Name permission</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}">
                    </div>

                    <div class="form-group"></div>
                        <label for="guard_name" class="form-label text-primary">Guard Name</label>
                        <input type="text" class="form-control" id="guard_name" name="guard_name" value="{{ $permission->guard_name }}">
                    </div>

                    <!-- Other fields or custom permissions -->

                    <div class="col-sm-12 mt-3">
                        <a href="{{ route('dashboard.access.permissions.index') }}" class="btn btn-danger">Back</a>
                        <button id="btnSubmit" type="button" class="btn btn-primary float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-script')

<script>
    $(document).ready(function () {
        $(".checkAll").on('change', function () {
            if ($(this).is(':checked')) {
                $(".check").prop('checked', true);
            } else {
                $(".check").prop('checked', false);
            }
        });

        $('#btnSubmit').on('click', function () {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed) {
                    $('#formEdit').submit();
                }
            })
        });
    });
</script>

@endsection
