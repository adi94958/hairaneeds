@extends('layouts/contentNavbarLayout')

@section('title', 'Tambah Customer')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Customer</h1>
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
    <form id="form-tambah-customer" method="post" action="{{ route('customer.add') }}">
        @csrf
        <div class="row">
            <div class="col-6 d-flex justify-content-center">
                <div class="card card-primary w-100 h-100">
                    <div class="card-header text-center">
                        <h3 class="card-title">Informasi Customer</h3>
                    </div>
                    <div class="card-body">
                        <!-- Tambahkan input type hidden untuk kode customer -->
                        <input type="hidden" id="kode_customer" name="kode_customer" value="{{ $next_customer_code }}" readonly>
                        <!-- Tampilkan kode customer sebagai text -->
                        <div class="form-group">
                            <label for="kode_customer">Kode Customer</label>
                            <input type="text" class="form-control" value="{{ $next_customer_code }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_customer">Nama Customer</label>
                            <input type="text" id="nama_customer" name="nama_customer" class="form-control @error('nama_customer') is-invalid @enderror" placeholder="Masukkan Nama Customer" value="{{ old('nama_customer') }}" required>
                            @error('nama_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat" value="{{ old('alamat') }}" required>
                            @error('alamat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" placeholder="Masukkan Nomor Telepon" value="{{ old('no_telp') }}" required>
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
                <a href="{{ route('customer.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Tambah Customer</button>
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
        $('#form-tambah-customer').validate({
            rules: {
                kode_customer: {
                    required: true,
                    minlength: 3
                },
                nama_customer: {
                    required: true
                },
                alamat: {
                    required: true
                },
                no_telp: {
                    required: true,
                    number: true
                }
            },
            messages: {
                kode_customer: {
                    required: "Kode Customer harus diisi",
                    minlength: "Kode Customer minimal 3 karakter"
                },
                nama_customer: {
                    required: "Nama Customer harus diisi"
                },
                alamat: {
                    required: "Alamat harus diisi"
                },
                no_telp: {
                    required: "Nomor Telepon harus diisi",
                    number: "Nomor Telepon harus berupa angka"
                }
            }
        });
    });
</script>
@endsection