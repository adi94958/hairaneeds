<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatabaseVendor extends Model
{
    use HasFactory;

    protected $table = 'database_vendor';
    protected $primaryKey = 'kode_vendor';
    public $incrementing = false;

    protected $fillable = [
        'kode_vendor',
        'nama_vendor',
        'brand',
        'alamat',
        'no_telp'
    ];

    public function pembelian()
    {
        return $this->hasMany(DatabasePembelian::class, 'kode_vendor', 'kode_barang');
    }
}
