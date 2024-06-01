<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabasePembelian extends Model
{
    use HasFactory;

    protected $table = 'database_pembelian';
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;

    protected $fillable = [
        'kode_transaksi',
        'tanggal_transaksi',
        'kode_vendor'
    ];

    public function vendor()
    {
        return $this->belongsTo(DatabaseVendor::class, 'kode_vendor', 'kode_vendor');
    }

    public function pembelianDetail()
    {
        return $this->hasMany(DatabasePembelianDetail::class, 'kode_transaksi', 'kode_transaksi');
    }
}
