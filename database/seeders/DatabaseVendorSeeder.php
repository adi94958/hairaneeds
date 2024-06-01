<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseVendorSeeder extends Seeder
{
    public function run()
    {
        DB::table('database_vendor')->insert([
            [
                'kode_vendor' => 'V001',
                'nama_vendor' => 'PT Sentosa Woods',
                'brand' => 'Mars',
                'alamat' => 'Jl Timur Barat',
                'no_telp' => '021756892',
            ],
            [
                'kode_vendor' => 'V002',
                'nama_vendor' => 'PT Semua Ada',
                'brand' => 'Venus',
                'alamat' => 'Jl Raya Mangga No. 12, Bekasi',
                'no_telp' => '021112987',
            ],
            [
                'kode_vendor' => 'V003',
                'nama_vendor' => 'PT Mega Jaya',
                'brand' => 'Curious',
                'alamat' => 'Jl A. Yani No 3, Serang',
                'no_telp' => '0254327654',
            ],
            [
                'kode_vendor' => 'V004',
                'nama_vendor' => 'PT Tanah Air',
                'brand' => 'Jinji',
                'alamat' => 'Jl Branggas No. 123,Klaten',
                'no_telp' => '0271823495',
            ],
            [
                'kode_vendor' => 'V005',
                'nama_vendor' => 'PT Adonia Wijaya',
                'brand' => 'Maxy',
                'alamat' => 'Jl Engku Putri Utara No 53, Batam',
                'no_telp' => '0772843876',
            ],
        ]);
    }
}
