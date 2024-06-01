@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Vendor')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Tambah Vendor</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Vendor</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content container">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif
    <form method="post" action="{{ route('vendor.add') }}">
        @csrf
        <div class="row">
            <div class="col-6 d-flex justify-content-center">
                <div class="card card-primary w-100 h-100">
                    <div class="card-header text-center">
                        <h3 class="card-title">Informasi Vendor</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tambahkan input type hidden untuk kode customer -->
                        <input type="hidden" id="kode_vendor" name="kode_vendor" value="{{ $next_vendor_code }}" readonly>
                        <!-- Tampilkan kode customer sebagai text -->
                        <div class="form-group">
                            <label for="kode_vendor">Kode Vendor</label>
                            <input type="text" class="form-control" value="{{ $next_vendor_code }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_vendor">Nama Vendor</label>
                            <input type="text" id="nama_vendor" name="nama_vendor" class="form-control @error('nama_vendor') is-invalid @enderror" placeholder="Masukkan Nama Vendor" value="{{ old('nama_vendor') }}" required>
                            @error('nama_vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <input type="text" id="brand" name="alamat" class="form-control @error('brand') is-invalid @enderror" placeholder="Masukkan Brand Vendor" value="{{ old('brand') }}" required>
                            @error('brand')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat Vendor" value="{{ old('alamat') }}" required>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon Vendor" value="{{ old('no_telp') }}" required>
                            @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-6 mt-4 d-flex justify-content-between">
                <a href="{{ route('vendor.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Tambah Vendor</button>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->

@endsection

@section('script_footer')
<!-- Script untuk validasi form -->
<script>
    $(document).ready(function() {
        $('#form-tambah-vendor').validate({
            rules: {
                kode_vendor: {
                    required: true,
                    minlength: 3
                },
                nama_vendor: {
                    required: true
                },
                alamat: {
                    required: true
                },
                no_telp: {
                    required: true
                }
            },
            messages: {
                kode_vendor: {
                    required: "Kode Vendor harus diisi",
                    minlength: "Kode Vendor minimal 3 karakter"
                },
                nama_vendor: {
                    required: "Nama Vendor harus diisi"
                },
                alamat: {
                    required: "Alamat harus diisi"
                },
                no_telp: {
                    required: "Nomor Telepon harus diisi"
                }
            }
        });
    });
</script>
@endsection