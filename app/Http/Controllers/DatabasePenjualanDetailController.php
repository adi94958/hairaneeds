<?php

namespace App\Http\Controllers;

use App\Models\DatabasePenjualan;
use App\Models\DatabasePenjualanDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatabasePenjualanDetailController extends Controller
{
    public function index()
    {
        return view('page.admin.penjualan.indexDetailPenjualan');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabasePenjualanDetail::with('barang')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barang.kode_barang', function ($row) {
                    return $row->barang->kode_barang;
                })
                ->addColumn('barang.nama_barang', function ($row) {
                    return $row->barang->nama_barang;
                })
                ->addColumn('barang.harga_jual', function ($row) {
                    return $row->barang->harga_jual;
                })
                ->make(true);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }
}
