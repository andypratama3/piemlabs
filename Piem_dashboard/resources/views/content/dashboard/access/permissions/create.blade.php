@extends('layouts/contentNavbarLayout')

@section('title', 'Access Page - Access')


@section('content')

<div class="row">
    <div class="col-lg-12">
        <!-- Form Basic -->
        <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary text-center">Create permission</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('dashboard.access.permissions.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label text-primary">Name permission </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukan Nama permission">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="guard_name" class="form-label text-primary">Guard Name</label>
                        <input type="text" class="form-control @error('guard_name') is-invalid @enderror" id="guard_name" name="guard_name" placeholder="Masukan guard_name">
                        @error('guard_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-sm-12 mt-3">
                        <a href="{{ route('dashboard.access.permissions.index') }}" class="btn btn-danger ">Back</a>
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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

        var i = 5;
        $("#dynamic-ar").click(function () {
            ++i;
            $("#dynamicAddRemove").append(`
                <tr>
                    <td>
                        <input type="text" class="form-control" name="permissions[${i}]" placeholder="Masukkan Custom Permission">
                    </td>
                    <td colspan="2">
                        <button type="button" class="btn btn-sm btn-danger remove-input-field"><i class="mdi mdi-delete"></i></button>
                    </td>
                </tr>
            `);
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
            --i;
        });
    });
</script>
@endsection

@endsection
