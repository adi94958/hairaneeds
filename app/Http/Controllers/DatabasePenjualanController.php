<?php

namespace App\Http\Controllers;

use App\Models\DatabasePenjualan;
use App\Models\DatabasePenjualanDetail;
use App\Models\DatabaseCustomer;
use App\Models\DatabaseBarang;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DatabasePenjualanController extends Controller
{
    public function index()
    {
        return view('page.admin.penjualan.indexPenjualan');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabasePenjualan::with('customer', 'penjualanDetail')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('customer.kode_customer', function ($row) {
                    return $row->customer->kode_customer;
                })
                ->addColumn('customer.nama_customer', function ($row) {
                    return $row->customer->nama_customer;
                })
                ->addColumn('customer.alamat', function ($row) {
                    return $row->customer->alamat;
                })
                ->addColumn('customer.no_telp', function ($row) {
                    return $row->customer->no_telp;
                })
                ->addColumn('total_harga', function ($row) {
                    // Calculate total harga
                    $totalHarga = $row->penjualanDetail->sum(function ($detail) {
                        return $detail->jumlah * $detail->barang->harga_jual;
                    });
                    return 'Rp ' . number_format($totalHarga, 0, ',', '.');
                })
                ->addColumn('options', function ($penjualan) {
                    $deleteUrl = route('penjualan.destroy', $penjualan->kode_transaksi);

                    return "
                        <button style='border: none; background-color:transparent; color: red;' class='hapusData' data-id='$penjualan->kode_transaksi' data-url='$deleteUrl'>
                            <i class='mdi mdi-delete mdi-24px'></i>
                        </button>
                    ";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function tambahPenjualan(Request $request)
    {
        // Ambil nomor faktur terakhir dari database
        $lastInvoice = DatabasePenjualan::orderBy('kode_transaksi', 'desc')->first();

        // Jika ada faktur terakhir, buat faktur baru dengan menambah 1
        if ($lastInvoice) {
            $lastNumber = intval(substr($lastInvoice->kode_transaksi, 3));
            $newNumber = $lastNumber + 1;
            $newInvoiceNumber = 'TR' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika tidak ada faktur terakhir, mulai dari FJ-001
            $newInvoiceNumber = 'TR001';
        }

        $customers = DatabaseCustomer::all();
        $barangs = DatabaseBarang::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'kode_transaksi' => 'required|unique:database_penjualan,kode_transaksi',
                'tanggal_transaksi' => 'required|date',
                'kode_customer' => 'required|exists:database_customer,kode_customer',
                'items' => 'required|array',
                'items.*.kode_barang' => 'required|exists:database_barang,kode_barang',
                'items.*.jumlah' => 'required|integer|min:1',
            ]);

            $penjualan = DatabasePenjualan::create([
                'kode_transaksi' => $request->kode_transaksi,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'kode_customer' => $request->kode_customer,
            ]);

            foreach ($request->items as $item) {
                $barang = DatabaseBarang::where('kode_barang', $item['kode_barang'])->first();
                if ($barang->unit >= $item['jumlah']) {
                    $barang->unit -= $item['jumlah'];
                    $barang->save();

                    DatabasePenjualanDetail::create([
                        'kode_transaksi' => $penjualan->kode_transaksi,
                        'kode_barang' => $item['kode_barang'],
                        'jumlah' => $item['jumlah'],
                    ]);
                } else {
                    return redirect()->back()->withErrors(['msg' => 'Stok barang ' . $barang->nama_barang . ' tidak mencukupi.']);
                }
            }

            return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil ditambahkan.');
        }

        return view('page.admin.penjualan.addPenjualan', compact('newInvoiceNumber', 'customers', 'barangs'));
    }

    public function hapusPenjualan($kode_transaksi)
    {
        $penjualan = DatabasePenjualan::findOrFail($kode_transaksi);
        $penjualan->delete();

        return response()->json(['msg' => 'Data Penjualan berhasil dihapus.']);
    }
}
