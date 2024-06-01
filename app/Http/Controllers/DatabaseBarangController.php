<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatabaseBarang;
use App\Models\DatabasePenjualanDetail;
use Yajra\DataTables\DataTables;

class DatabaseBarangController extends Controller
{
    public function index()
    {
        return view('page.admin.barang.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabaseBarang::select(['kode_barang', 'nama_barang', 'harga_beli', 'harga_jual', 'unit']);
            return Datatables::of($data)
                ->addColumn('options', function ($barang) {
                    $editUrl = route('barang.update', $barang->kode_barang); // Assuming 'update' is the route name for editing a 'barang'
                    $deleteUrl = route('barang.destroy', $barang->kode_barang); // Assuming 'destroy' is the route name for deleting a 'barang'
                    return "
                    <button style='border: none; background-color:transparent; color: #9055fd;' onclick='window.location=\"$editUrl\"'>
                        <i class='mdi mdi-pencil mdi-24px'></i>
                    </button>
                    <button style='border: none; background-color:transparent; color: #ff4c51;' class='hapusData' data-kode_barang='$barang->kode_barang' data-url='$deleteUrl'>
                        <i class='mdi mdi-delete mdi-24px'></i>
                    </button>";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
    }

    public function tambahBarang(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'kode_barang' => 'required|unique:database_barang,kode_barang',
                'nama_barang' => 'required',
                'harga_beli' => 'required|numeric',
                'harga_jual' => 'required|numeric',
                'unit' => 'required',
            ], [
                'kode_barang.unique' => 'Kode Barang sudah digunakan, mohon gunakan kode yang lain.',
            ]);

            DatabaseBarang::create([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'unit' => $request->unit,
            ]);

            return redirect()->route('barang.index')->with('status', 'Data Barang telah ditambahkan');
        }

        return view('page.admin.barang.addBarang');
    }

    public function updateBarang($kode_barang, Request $request)
    {
        $barang = DatabaseBarang::findOrFail($kode_barang);

        if ($request->isMethod('post')) {
            $barang->update([
                'kode_barang' => $request->kode_barang,
                'nama_barang' => $request->nama_barang,
                'harga_beli' => $request->harga_beli,
                'harga_jual' => $request->harga_jual,
                'unit' => $request->unit,
            ]);
            return redirect()->route('barang.update', ['kode_barang' => $barang->kode_barang])->with('status', 'Data telah tersimpan di database');
        }
        return view('page.admin.barang.updateBarang', [
            'barang' => $barang
        ]);
    }

    public function hapusBarang($id_transaksi)
    {
        $barang = DatabaseBarang::findOrFail($id_transaksi);
        $barang->delete($id_transaksi);

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
