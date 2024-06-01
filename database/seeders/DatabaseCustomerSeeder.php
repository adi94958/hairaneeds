<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('database_customer')->insert([
            [
                'kode_customer' => 'C001',
                'nama_customer' => 'Harahap Hardware',
                'alamat' => 'Jl Gegerkalong',
                'no_telp' => '0251895295'
            ],
            [
                'kode_customer' => 'C002',
                'nama_customer' => 'Pelangi House',
                'alamat' => 'Jl Surapati No 23, Bandung',
                'no_telp' => '022982310'
            ],
            [
                'kode_customer' => 'C003',
                'nama_customer' => 'Harapan Baru',
                'alamat' => 'Jl Merdeka No 1, Bandung',
                'no_telp' => '022712903'
            ],
            [
                'kode_customer' => 'C004',
                'nama_customer' => 'Bara Furniture',
                'alamat' => 'Jl Bangka No 187, Jakarta Barat',
                'no_telp' => '021837604'
            ],
            [
                'kode_customer' => 'C005',
                'nama_customer' => 'Zania Warehouse',
                'alamat' => 'Jl Layung Barat No 45, Jakarta Selatan',
                'no_telp' => '021534733'
            ],
        ]);
    }
}
