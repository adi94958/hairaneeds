<?php

namespace App\Http\Controllers;

use App\Models\DatabasePembelian;
use App\Models\DatabasePembelianDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatabasePembelianDetailController extends Controller
{
    public function index()
    {
        return view('page.admin.pembelian.indexDetailPembelian');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabasePembelianDetail::with('barang')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('barang.kode_barang', function ($row) {
                    return $row->barang->kode_barang;
                })
                ->addColumn('barang.nama_barang', function ($row) {
                    return $row->barang->nama_barang;
                })
                ->addColumn('barang.harga_jual', function ($row) {
                    return $row->barang->harga_beli;
                })
                ->addColumn('options', function ($detailPembelian) {
                    $deleteUrl = route('pembelian.destroy', $detailPembelian->kode_transaksi);
                    return "
                        <button style='border: none; background-color:transparent; color: red;' class='hapusData' data-id='$detailPembelian->kode_transaksi' data-url='$deleteUrl'>
                            <i class='mdi mdi-delete mdi-24px'></i>
                        </button>
                    ";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function hapusPembelian($kode_transaksi)
    {
        $pembelian = DatabasePembelian::findOrFail($kode_transaksi);
        $pembelian->delete();

        return response()->json(['msg' => 'Data Pembelian berhasil dihapus.']);
    }
}
