<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Penjualan data to be seeded
        DB::table('database_penjualan')->insert([
            [
                'kode_transaksi' => 'TR001',
                'tanggal_transaksi' => '2024-01-03',
                'kode_customer' => 'C001',
            ],
            [
                'kode_transaksi' => 'TR002',
                'tanggal_transaksi' => '2024-03-03',
                'kode_customer' => 'C002',
            ],
            [
                'kode_transaksi' => 'TR003',
                'tanggal_transaksi' => '2024-05-03',
                'kode_customer' => 'C005',
            ],
            [
                'kode_transaksi' => 'TR004',
                'tanggal_transaksi' => '2024-04-15',
                'kode_customer' => 'C004',
            ],
            [
                'kode_transaksi' => 'TR005',
                'tanggal_transaksi' => '2023-04-15',
                'kode_customer' => 'C004',
            ],
        ]);

        DB::table('database_penjualan_detail')->insert([
            [
                'kode_transaksi' => 'TR001',
                'kode_barang' => 'MG001',
                'jumlah' => 2,
            ],
            [
                'kode_transaksi' => 'TR001',
                'kode_barang' => 'MG002',
                'jumlah' => 4,
            ],
            [
                'kode_transaksi' => 'TR002',
                'kode_barang' => 'MG003',
                'jumlah' => 5,
            ],
            [
                'kode_transaksi' => 'TR002',
                'kode_barang' => 'PL001',
                'jumlah' => 2,
            ],
            [
                'kode_transaksi' => 'TR003',
                'kode_barang' => 'PL002',
                'jumlah' => 2,
            ],
            [
                'kode_transaksi' => 'TR004',
                'kode_barang' => 'PL003',
                'jumlah' => 4,
            ],
            [
                'kode_transaksi' => 'TR005',
                'kode_barang' => 'PL004',
                'jumlah' => 2,
            ],
            [
                'kode_transaksi' => 'TR005',
                'kode_barang' => 'BW001',
                'jumlah' => 1,
            ],
        ]);
    }
}
