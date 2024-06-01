@extends('layouts/contentNavbarLayout')

@section('title', 'Ubah Barang')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Ubah Barang</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Ubah Barang</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    @if(session('status'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
        {{ session('status') }}
    </div>
    @endif
    <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6 d-flex justify-content-center">
                <div class="card card-primary w-100 h-100">
                    <div class="card-header text-center">
                        <h3 class="card-title">Informasi Data Barang</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputKodeBarang">Kode Barang</label>
                            <input type="text" id="inputKodeBarang" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" placeholder="Masukkan Kode Barang" value="{{ $barang -> kode_barang}}" required autocomplete="kode_barang">
                            @error('kode_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNamaBarang">Nama Barang</label>
                            <input type="text" id="inputNamaBarang" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" placeholder="Masukkan Nama Barang" value="{{ $barang->nama_barang }}" required autocomplete="nama_barang">
                            @error('nama_barang')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputHargaBeli">Harga Beli</label>
                            <input type="number" id="inputHargaBeli" name="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" placeholder="Masukkan Harga Beli" value="{{ $barang->harga_beli }}" required autocomplete="harga_beli">
                            @error('harga_beli')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputHargaJual">Harga Jual</label>
                            <input type="number" id="inputHargaJual" name="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" placeholder="Masukkan Harga Jual" value="{{ $barang->harga_jual }}" required autocomplete="harga_jual">
                            @error('harga_jual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputUnit">Unit</label>
                            <input type="text" id="inputUnit" name="unit" class="form-control @error('unit') is-invalid @enderror" placeholder="Masukkan Unit" value="{{ $barang->unit }}" required autocomplete="unit">
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
                <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Simpan</button>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->

@endsection @section('script_footer')
<script>
    inputFoto.onchange = evt => {
        const [file] = inputFoto.files
        if (file) {
            prevImg.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection