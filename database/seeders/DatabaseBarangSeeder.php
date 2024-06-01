<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseBarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('database_barang')->insert([
            ['kode_barang' => 'MG001', 'nama_barang' => 'Mars Mug', 'harga_beli' => 90000, 'harga_jual' => 100000, 'unit' => 61],
            ['kode_barang' => 'MG002', 'nama_barang' => 'Venus Mug', 'harga_beli' => 105000, 'harga_jual' => 125000, 'unit' => 60],
            ['kode_barang' => 'MG003', 'nama_barang' => 'Curious Mug', 'harga_beli' => 108000, 'harga_jual' => 130000, 'unit' => 60],
            ['kode_barang' => 'MG004', 'nama_barang' => 'Jinji Mug', 'harga_beli' => 111000, 'harga_jual' => 155000, 'unit' => 60],
            ['kode_barang' => 'MG005', 'nama_barang' => 'Maxy Mug', 'harga_beli' => 135000, 'harga_jual' => 185000, 'unit' => 60],
            ['kode_barang' => 'PL001', 'nama_barang' => 'Mars Plate', 'harga_beli' => 135000, 'harga_jual' => 150000, 'unit' => 60],
            ['kode_barang' => 'PL002', 'nama_barang' => 'Venus Plate', 'harga_beli' => 155000, 'harga_jual' => 180000, 'unit' => 60],
            ['kode_barang' => 'PL003', 'nama_barang' => 'Curious Plate', 'harga_beli' => 185000, 'harga_jual' => 215000, 'unit' => 60],
            ['kode_barang' => 'PL004', 'nama_barang' => 'Jinji Plate', 'harga_beli' => 205000, 'harga_jual' => 225000, 'unit' => 60],
            ['kode_barang' => 'PL005', 'nama_barang' => 'Maxy Plate', 'harga_beli' => 216000, 'harga_jual' => 255000, 'unit' => 60],
            ['kode_barang' => 'BW001', 'nama_barang' => 'Mars Bowl', 'harga_beli' => 115000, 'harga_jual' => 130000, 'unit' => 60],
            ['kode_barang' => 'BW002', 'nama_barang' => 'Venus Bowl', 'harga_beli' => 136000, 'harga_jual' => 145000, 'unit' => 60],
            ['kode_barang' => 'BW003', 'nama_barang' => 'Curious Bowl', 'harga_beli' => 144000, 'harga_jual' => 165000, 'unit' => 60],
            ['kode_barang' => 'BW004', 'nama_barang' => 'Jinji Bowl', 'harga_beli' => 165000, 'harga_jual' => 180000, 'unit' => 60],
            ['kode_barang' => 'BW005', 'nama_barang' => 'Maxy Bowl', 'harga_beli' => 178000, 'harga_jual' => 195000, 'unit' => 60],
            ['kode_barang' => 'SP001', 'nama_barang' => 'Mars Spoon', 'harga_beli' => 25000, 'harga_jual' => 35000, 'unit' => 120],
            ['kode_barang' => 'SP002', 'nama_barang' => 'Venus Spoon', 'harga_beli' => 34000, 'harga_jual' => 45000, 'unit' => 120],
            ['kode_barang' => 'SP003', 'nama_barang' => 'Curious Spoon', 'harga_beli' => 38000, 'harga_jual' => 50000, 'unit' => 120],
            ['kode_barang' => 'SP004', 'nama_barang' => 'Jinji Spoon', 'harga_beli' => 53000, 'harga_jual' => 75000, 'unit' => 120],
            ['kode_barang' => 'SP005', 'nama_barang' => 'Maxy Spoon', 'harga_beli' => 65000, 'harga_jual' => 90000, 'unit' => 120],
            ['kode_barang' => 'FR001', 'nama_barang' => 'Mars Fork', 'harga_beli' => 25000, 'harga_jual' => 35000, 'unit' => 120],
            ['kode_barang' => 'FR002', 'nama_barang' => 'Venus Fork', 'harga_beli' => 34000, 'harga_jual' => 45000, 'unit' => 120],
            ['kode_barang' => 'FR003', 'nama_barang' => 'Curious Fork', 'harga_beli' => 38000, 'harga_jual' => 50000, 'unit' => 120],
            ['kode_barang' => 'FR004', 'nama_barang' => 'Jinji Fork', 'harga_beli' => 53000, 'harga_jual' => 75000, 'unit' => 120],
            ['kode_barang' => 'FR005', 'nama_barang' => 'Maxy Fork', 'harga_beli' => 65000, 'harga_jual' => 90000, 'unit' => 120],
            ['kode_barang' => 'KN001', 'nama_barang' => 'Mars Knife', 'harga_beli' => 125000, 'harga_jual' => 140000, 'unit' => 90],
            ['kode_barang' => 'KN002', 'nama_barang' => 'Venus Knife', 'harga_beli' => 135000, 'harga_jual' => 155000, 'unit' => 90],
            ['kode_barang' => 'KN003', 'nama_barang' => 'Curious Knife', 'harga_beli' => 155000, 'harga_jual' => 175000, 'unit' => 90],
            ['kode_barang' => 'KN004', 'nama_barang' => 'Jinji Knife', 'harga_beli' => 167000, 'harga_jual' => 190000, 'unit' => 90],
            ['kode_barang' => 'KN005', 'nama_barang' => 'Maxy Knife', 'harga_beli' => 180000, 'harga_jual' => 215000, 'unit' => 90],
            ['kode_barang' => 'BT001', 'nama_barang' => 'Mars Bottle', 'harga_beli' => 100000, 'harga_jual' => 100000, 'unit' => 50],
            ['kode_barang' => 'BT002', 'nama_barang' => 'Venus Bottle', 'harga_beli' => 113000, 'harga_jual' => 130000, 'unit' => 50],
            ['kode_barang' => 'BT003', 'nama_barang' => 'Curious Bottle', 'harga_beli' => 138000, 'harga_jual' => 155000, 'unit' => 50],
            ['kode_barang' => 'BT004', 'nama_barang' => 'Jinji Bottle', 'harga_beli' => 142000, 'harga_jual' => 175000, 'unit' => 50],
            ['kode_barang' => 'BT005', 'nama_barang' => 'Maxy Bottle', 'harga_beli' => 168000, 'harga_jual' => 190000, 'unit' => 50],
            ['kode_barang' => 'CS001', 'nama_barang' => 'Mars Chopstick', 'harga_beli' => 38000, 'harga_jual' => 55000, 'unit' => 60],
            ['kode_barang' => 'CS002', 'nama_barang' => 'Venus Chopstick', 'harga_beli' => 46000, 'harga_jual' => 65000, 'unit' => 60],
            ['kode_barang' => 'CS003', 'nama_barang' => 'Curious Chopstick', 'harga_beli' => 52000, 'harga_jual' => 70000, 'unit' => 60],
            ['kode_barang' => 'CS004', 'nama_barang' => 'Jinji Chopstick', 'harga_beli' => 59000, 'harga_jual' => 85000, 'unit' => 60],
            ['kode_barang' => 'CS005', 'nama_barang' => 'Maxy Chopstick', 'harga_beli' => 65000, 'harga_jual' => 100000, 'unit' => 60],
            ['kode_barang' => 'TP001', 'nama_barang' => 'Mars Teapot', 'harga_beli' => 100000, 'harga_jual' => 110000, 'unit' => 40],
            ['kode_barang' => 'TP002', 'nama_barang' => 'Venus Teapot', 'harga_beli' => 108000, 'harga_jual' => 125000, 'unit' => 40],
            ['kode_barang' => 'TP003', 'nama_barang' => 'Curious Teapot', 'harga_beli' => 122000, 'harga_jual' => 145000, 'unit' => 40],
            ['kode_barang' => 'TP004', 'nama_barang' => 'Jinji Teapot', 'harga_beli' => 134000, 'harga_jual' => 155000, 'unit' => 40],
            ['kode_barang' => 'TP005', 'nama_barang' => 'Maxy Teapot', 'harga_beli' => 156000, 'harga_jual' => 180000, 'unit' => 40],
            ['kode_barang' => 'PX001', 'nama_barang' => 'Mars Pyrex', 'harga_beli' => 225000, 'harga_jual' => 250000, 'unit' => 50],
            ['kode_barang' => 'PX002', 'nama_barang' => 'Venus Pyrex', 'harga_beli' => 254000, 'harga_jual' => 270000, 'unit' => 50],
            ['kode_barang' => 'PX003', 'nama_barang' => 'Curious Pyrex', 'harga_beli' => 265000, 'harga_jual' => 285000, 'unit' => 50],
            ['kode_barang' => 'PX004', 'nama_barang' => 'Jinji Pyrex', 'harga_beli' => 278000, 'harga_jual' => 310000, 'unit' => 50],
            ['kode_barang' => 'PX005', 'nama_barang' => 'Maxy Pyrex', 'harga_beli' => 298000, 'harga_jual' => 340000, 'unit' => 50],
        ]);
    }
}
