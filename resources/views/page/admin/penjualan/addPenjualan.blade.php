@extends('layouts/contentNavbarLayout')

@section('title', 'Form Penjualan')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Form Penjualan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Form Penjualan</li>
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

    <!-- Tempatkan pesan error di sini -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="post" action="{{ route('penjualan.add') }}">
        @csrf
        <div class="row">
            <div class="col-6 d-flex justify-content-center">
                <div class="card card-primary w-100 h-100">
                    <div class="card-header text-center">
                        <h3 class="card-title">Informasi Penjualan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="kode_transaksi">Kode Transaksi</label>
                            <input type="text" id="kode_transaksi" name="kode_transaksi" class="form-control @error('kode_transaksi') is-invalid @enderror" placeholder="Masukkan Kode Transaksi" value="{{ $newInvoiceNumber }}" readonly>
                            @error('kode_transaksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input type="date" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control @error('tanggal_transaksi') is-invalid @enderror" placeholder="Masukkan Tanggal Transaksi" value="{{ old('tanggal_transaksi', \Carbon\Carbon::now()->format('Y-m-d')) }}" required>
                            @error('tanggal_transaksi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_customer">Nama Customer</label>
                            <select name="kode_customer" id="kode_customer" class="form-control @error('kode_customer') is-invalid @enderror" required>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->kode_customer }}">{{ $customer->nama_customer }}</option>
                                @endforeach
                            </select>
                            @error('kode_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="items">Barang</label>
                            <div id="items">
                                <div class="item">
                                    <div class="mb-4">
                                        <select name="items[0][kode_barang]" class="form-control @error('items.0.kode_barang') is-invalid @enderror" required>
                                            @foreach($barangs as $barang)
                                            <option value="{{ $barang->kode_barang }}">{{ $barang->nama_barang }} (Stok: {{ $barang->unit }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <input type="number" name="items[0][jumlah]" class="form-control @error('items.0.jumlah') is-invalid @enderror" placeholder="Jumlah" required>
                                    </div>
                                    @error('items.0.kode_barang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    @error('items.0.jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="button" id="add-item" class="btn btn-primary mt-2">Form Barang</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-6 mt-4 d-flex justify-content-between">
                <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-success float-right">Form Penjualan</button>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
@endsection

@section('script_footer')
<script>
    let itemIndex = 1;
    document.getElementById('add-item').addEventListener('click', function() {
        const itemsDiv = document.getElementById('items');
        const newItem = document.createElement('div');
        newItem.classList.add('item', 'mt-2');
        newItem.innerHTML = `
            <div class="mb-4">
            <select name="items[${itemIndex}][kode_barang]" class="form-control @error('items.${itemIndex}.kode_barang') is-invalid @enderror" required>
                @foreach($barangs as $barang)
                    <option value="{{ $barang->kode_barang }}">{{ $barang->nama_barang }} (Stok: {{ $barang->unit }})</option>
                @endforeach
            </select>
            </div>
            <div class="mb-4">
            <input type="number" name="items[${itemIndex}][jumlah]" class="form-control @error('items.${itemIndex}.jumlah') is-invalid @enderror" placeholder="Jumlah" required>
            </div>
            @error('items.${itemIndex}.kode_barang')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @error('items.${itemIndex}.jumlah')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
    });
</script>
@endsection