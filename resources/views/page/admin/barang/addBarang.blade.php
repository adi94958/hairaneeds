@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Barang</h1>
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
    <form method="post" action="{{ route('barang.add') }}">
        @csrf
        <div class="row">
            <div class="col-6 d-flex justify-content-center">
                <div class="card card-primary w-100 h-100">
                    <div class="card-header text-center">
                        <h3 class="card-title">Informasi Barang</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Barang</label>
                            <input type="text" id="kode_barang" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" placeholder="Masukkan Kode Barang" value="{{ old('kode_barang') }}" required>
                            @error('kode_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_barang">Nama Barang</label>
                            <input type="text" id="nama_barang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Masukkan Nama Barang" value="{{ old('nama_barang') }}" required>
                            @error('nama_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli</label>
                            <input type="number" id="harga_beli" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Masukkan Harga Beli" value="{{ old('harga_beli') }}" required>
                            @error('harga_beli')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual</label>
                            <input type="number" id="harga_jual" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Masukkan Harga Jual" value="{{ old('harga_jual') }}" required>
                            @error('harga_jual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Masukkan Unit Barang" value="{{ old('unit') }}" required>
                            @error('unit')
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
                <a href="{{ route('barang.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Tambah Barang</button>
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
        $('#form-tambah-barang').validate({
            rules: {
                kode_barang: {
                    required: true,
                    minlength: 3
                },
                nama_barang: {
                    required: true
                },
                harga_beli: {
                    required: true,
                    number: true
                },
                harga_jual: {
                    required: true,
                    number: true
                },
                unit: {
                    required: true
                }
            },
            messages: {
                kode_barang: {
                    required: "Kode Barang harus diisi",
                    minlength: "Kode Barang minimal 3 karakter"
                },
                nama_barang: {
                    required: "Nama Barang harus diisi"
                },
                harga_beli: {
                    required: "Harga Beli harus diisi",
                    number: "Harga Beli harus berupa angka"
                },
                harga_jual: {
                    required: "Harga Jual harus diisi",
                    number: "Harga Jual harus berupa angka"
                },
                unit: {
                    required: "Unit harus diisi"
                }
            }
        });
    });
</script>
@endsection