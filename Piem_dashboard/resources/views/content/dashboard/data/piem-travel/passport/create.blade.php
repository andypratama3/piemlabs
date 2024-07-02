@extends('layouts/contentNavbarLayout')

@section('title', 'Passport - Create')

@section('vendor-style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('content')
<div class="col-12 col-lg-12">
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-tile mb-0">Create Passport</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('dashboard.piem-travel.passport.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="name">Name</label>
                    <select name="user_id" id="user_id" class="form-control select2 @error('user_id') is-invalid @enderror" data-placholder="Select User">
                        <option disabled selected>Select User</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="name">Product </label>
                    <select name="produk_id" id="produk_id" data-placholder="Select Product"
                        class="form-control select2 @error('produk_id') is-invalid @enderror">
                        <option disabled selected>Select Product</option>
                        @foreach ($produks as $produk)
                        <option value="{{ $produk->id }}">{{ $produk->name }}</option>
                        @endforeach
                    </select>
                    @error('produk_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="ktp">KTP</label>
                            <input type="file" name="ktp" id="ktp" class="form-control @error('ktp') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('ktp')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-ktp" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="kk">Kartu Kerluarga</label>
                            <input type="file" name="kk" id="kk" class="form-control @error('kk') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('kk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-kk" alt=""  class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="akta_lahir">Akta lahir</label>
                            <input type="file" name="akta_lahir" id="akta_lahir" class="form-control @error('akta_lahir') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('akta_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-akta_lahir" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4 color-black ">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label class="form-label" for="ijazah">Ijazah</label>
                            <input type="file" name="ijazah" id="ijazah" class="form-control @error('ijazah') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('ijazah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-ijazah" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="surat_kawin">Surat Kawin</label>
                            <input type="file" name="surat_kawin" id="surat_kawin" class="form-control @error('surat_kawin') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('surat_kawin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-surat_kawin" alt=""  class="img-fluid">
                            </div>
                        </div>
                        <div class="col">
                            <label class="form-label" for="passport">Passport</label>
                            <input type="file" name="passport" id="passport" class="form-control @error('passport') is-invalid @enderror" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,text/plain, application/pdf, image/*">
                            @error('passport')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                            <div class="mt-2">
                                <img id="output-passport" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-2">
                    <a href="{{ route('dashboard.list.kategori.index') }}" class="btn btn-danger btn-sm">Back</a>
                    <button class="btn btn-primary btn-sm float-end">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();

    document.addEventListener('DOMContentLoaded', () => {
        const handleFileChange = (inputId, outputId) => {
            const input = document.getElementById(inputId);
            const output = document.getElementById(outputId);

            input.addEventListener('change', () => {
                const reader = new FileReader();

                reader.onload = (e) => {
                    output.src = e.target.result;
                    console.log(e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            });
        };

        handleFileChange('ktp', 'output-ktp');
        handleFileChange('kk', 'output-kk');
        handleFileChange('akta_lahir', 'output-akta_lahir');
        handleFileChange('ijazah', 'output-ijazah');
        handleFileChange('surat_kawin', 'output-surat_kawin');
        handleFileChange('passport', 'output-passport');


    });





</script>
@endsection
@endsection
