<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabasePembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'database_pembelian_detail';

    protected $fillable = [
        'kode_transaksi',
        'kode_barang',
        'jumlah'
    ];

    public function pembelian()
    {
        return $this->belongsTo(DatabasePembelian::class, 'kode_transaksi', 'kode_transaksi');
    }

    public function barang()
    {
        return $this->belongsTo(DatabaseBarang::class, 'kode_barang', 'kode_barang');
    }
}
