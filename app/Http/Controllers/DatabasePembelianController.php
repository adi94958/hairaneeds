<?php

namespace App\Http\Controllers;

use App\Models\DatabasePembelian;
use App\Models\DatabasePembelianDetail;
use App\Models\DatabaseVendor;
use App\Models\DatabaseBarang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatabasePembelianController extends Controller
{
    public function index()
    {
        return view('page.admin.pembelian.indexPembelian');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabasePembelian::with('vendor')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('vendor.kode_vendor', function ($row) {
                    return $row->vendor->kode_vendor;
                })
                ->addColumn('vendor.nama_vendor', function ($row) {
                    return $row->vendor->nama_vendor;
                })
                ->addColumn('vendor.alamat', function ($row) {
                    return $row->vendor->alamat;
                })
                ->addColumn('vendor.no_telp', function ($row) {
                    return $row->vendor->no_telp;
                })
                ->addColumn('options', function ($pembelian) {
                    $deleteUrl = route('pembelian.destroy', $pembelian->kode_transaksi); // Assuming 'destroy' is the route name for deleting a 'vendor'
                    return "
                    <button style='border: none; background-color:transparent; color: red;' class='hapusData' data-id='$pembelian->kode_transaksi' data-url='$deleteUrl'>
                        <i class='mdi mdi-delete mdi-24px'></i>
                    </button>
                ";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function tambahPembelian(Request $request)
    {
        // Ambil nomor faktur terakhir dari database
        $lastInvoice = DatabasePembelian::orderBy('kode_transaksi', 'desc')->first();

        // Jika ada faktur terakhir, buat faktur baru dengan menambah 1
        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice->kode_transaksi, 3));
            $newNumber = $lastNumber + 1;
            $newInvoiceNumber = 'TR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada faktur terakhir, mulai dari FJ-001
            $newInvoiceNumber = 'TR001';
        }

        $vendors = DatabaseVendor::all();
        $barangs = DatabaseBarang::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'kode_transaksi' => 'required|unique:database_pembelian,kode_transaksi',
                'tanggal_transaksi' => 'required|date',
                'kode_vendor' => 'required|exists:database_vendor,kode_vendor',
                'items' => 'required|array',
                'items.*.kode_barang' => 'required|exists:database_barang,kode_barang',
                'items.*.jumlah' => 'required|integer|min:1',
            ]);

            $pembelian = DatabasePembelian::create([
                'kode_transaksi' => $request->kode_transaksi,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'kode_vendor' => $request->kode_vendor,
            ]);

            foreach ($request->items as $item) {
                // Ambil data barang yang dibeli
                $barang = DatabaseBarang::where('kode_barang', $item['kode_barang'])->first();

                // Tambahkan jumlah barang yang dibeli ke stok barang
                $barang->unit += $item['jumlah'];
                $barang->save();

                // Simpan detail pembelian
                DatabasePembelianDetail::create([
                    'kode_transaksi' => $pembelian->kode_transaksi,
                    'kode_barang' => $item['kode_barang'],
                    'jumlah' => $item['jumlah'],
                ]);
            }

            return redirect()->route('pembelian.index')->with('success', 'Data pembelian berhasil ditambahkan.');
        }

        return view('page.admin.pembelian.addPembelian', compact('newInvoiceNumber', 'vendors', 'barangs'));
    }

    public function hapusPembelian($kode_transaksi)
    {
        $pembelian = DatabasePembelian::findOrFail($kode_transaksi);
        $pembelian->delete();

        return response()->json(['msg' => 'Data Pembelian berhasil dihapus.']);
    }
}
