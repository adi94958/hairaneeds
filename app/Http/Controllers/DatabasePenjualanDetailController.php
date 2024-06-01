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
                ->addColumn('options', function ($detailPenjualan) {
                    $deleteUrl = route('penjualan.destroy', $detailPenjualan->kode_transaksi); // Assuming 'destroy' is the route name for deleting a 'vendor'
                    return "
                        <button style='border: none; background-color:transparent; color: red;' class='hapusData' data-id='$detailPenjualan->kode_transaksi' data-url='$deleteUrl'>
                            <i class='mdi mdi-delete mdi-24px'></i>
                        </button>
                    ";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function hapusPenjualan($kode_transaksi)
    {
        $penjualan = DatabasePenjualan::findOrFail($kode_transaksi);
        $penjualan->delete();

        return response()->json(['msg' => 'Data Penjualan berhasil dihapus.']);
    }
}
