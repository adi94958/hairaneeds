<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatabaseVendor;
use Yajra\DataTables\DataTables;

class DatabaseVendorController extends Controller
{
    public function index()
    {
        return view('page.admin.vendor.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabaseVendor::select(['kode_vendor', 'nama_vendor', 'brand', 'alamat', 'no_telp']);
            return Datatables::of($data)
                ->addColumn('options', function ($vendor) {
                    $editUrl = route('vendor.update', $vendor->kode_vendor); // Assuming 'update' is the route name for editing a 'vendor'
                    $deleteUrl = route('vendor.destroy', $vendor->kode_vendor); // Assuming 'destroy' is the route name for deleting a 'vendor'
                    return "
                    <button style='border: none; background-color:transparent; color: #9055fd;' onclick='window.location=\"$editUrl\"'>
                        <i class='mdi mdi-pencil mdi-24px'></i>
                    </button>
                    <button style='border: none; background-color:transparent; color: #ff4c51;' class='hapusData' data-kode_barang='$vendor->kode_vendor' data-url='$deleteUrl'>
                        <i class='mdi mdi-delete mdi-24px'></i>
                    </button>";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
    }

    public function tambahVendor(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_vendor' => 'required',
                'brand' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
            ]);

            // Generate the next vendor code
            $latestVendor = DatabaseVendor::orderBy('kode_vendor', 'desc')->first();
            if ($latestVendor) {
                $lastVendorCode = substr($latestVendor->kode_vendor, 1); // Ambil angka dari kode terakhir
                $nextVendorCode = 'V' . str_pad(intval($lastVendorCode) + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format ulang ke 3 digit
            } else {
                $nextVendorCode = 'V001';
            }

            DatabaseVendor::create([
                'kode_vendor' => $nextVendorCode,
                'nama_vendor' => $request->nama_vendor,
                'brand' => $request->brand,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('vendor.index')->with('status', 'Data Vendor telah ditambahkan');
        }

        // Generate the next vendor code for display
        $latestVendor = DatabaseVendor::orderBy('kode_vendor', 'desc')->first();
        if ($latestVendor) {
            $lastVendorCode = substr($latestVendor->kode_vendor, 1); // Ambil angka dari kode terakhir
            $nextVendorCode = 'V' . str_pad(intval($lastVendorCode) + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format ulang ke 3 digit
        } else {
            $nextVendorCode = 'V001';
        }

        return view('page.admin.vendor.addVendor', ['next_vendor_code' => $nextVendorCode]);
    }


    public function updateVendor($kode_vendor, Request $request)
    {
        $vendor = DatabaseVendor::findOrFail($kode_vendor);

        if ($request->isMethod('post')) {
            // Update data vendor
            $vendor->update([
                'kode_vendor' => $request->kode_vendor,
                'nama_vendor' => $request->nama_vendor,
                'brand' => $request->brand,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('vendor.update', ['kode_vendor' => $vendor->kode_vendor])->with('status', 'Data telah tersimpan di database');
        }

        return view('page.admin.vendor.updateVendor', [
            'vendor' => $vendor
        ]);
    }

    public function hapusVendor($kode_vendor)
    {
        $vendor = DatabaseVendor::findOrFail($kode_vendor);
        $vendor->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
