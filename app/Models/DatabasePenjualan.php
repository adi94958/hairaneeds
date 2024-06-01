<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabasePenjualan extends Model
{
    use HasFactory;

    protected $table = 'database_penjualan';
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;

    protected $fillable = [
        'kode_transaksi',
        'tanggal_transaksi',
        'kode_customer'
    ];

    public function customer()
    {
        return $this->belongsTo(DatabaseCustomer::class, 'kode_customer', 'kode_customer');
    }

    public function penjualanDetail()
    {
        return $this->hasMany(DatabasePenjualanDetail::class, 'kode_transaksi', 'kode_transaksi');
    }
}
