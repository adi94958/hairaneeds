<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseBarang extends Model
{
    use HasFactory;

    protected $table = 'database_barang';
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'unit'
    ];

    public function penjualanDetail()
    {
        return $this->hasMany(DatabasePenjualanDetail::class, 'kode_barang', 'kode_barang');
    }

    public function pembelianDetail()
    {
        return $this->hasMany(DatabasePembelianDetail::class, 'kode_barang', 'kode_barang');
    }
}
