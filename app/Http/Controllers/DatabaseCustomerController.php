<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DatabaseCustomer;
use Yajra\DataTables\DataTables;

class DatabaseCustomerController extends Controller
{
    public function index()
    {
        return view('page.admin.customer.index');
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = DatabaseCustomer::select(['kode_customer', 'nama_customer', 'alamat', 'no_telp']);
            return Datatables::of($data)
                ->addColumn('options', function ($customer) {
                    $editUrl = route('customer.update', $customer->kode_customer); // Assuming 'update' is the route name for editing a customer
                    $deleteUrl = route('customer.destroy', $customer->kode_customer); // Assuming 'destroy' is the route name for deleting a customer
                    return "
                    <button style='border: none; background-color:transparent; color: #9055fd;' onclick='window.location=\"$editUrl\"'>
                        <i class='mdi mdi-pencil mdi-24px'></i>
                    </button>
                    <button style='border: none; background-color:transparent; color: #ff4c51;' class='hapusData' data-kode_barang='$customer->kode_customer' data-url='$deleteUrl'>
                        <i class='mdi mdi-delete mdi-24px'></i>
                    </button>";
                })
                ->rawColumns(['options'])
                ->make(true);
        }
    }

    public function tambahCustomer(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'nama_customer' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
            ]);

            // Generate the next customer code
            $latestCustomer = DatabaseCustomer::orderBy('kode_customer', 'desc')->first();
            if ($latestCustomer) {
                $lastCustomerCode = substr($latestCustomer->kode_customer, 1); // Ambil angka dari kode terakhir
                $nextCustomerCode = 'C' . str_pad(intval($lastCustomerCode) + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format ulang ke 3 digit
            } else {
                $nextCustomerCode = 'C001';
            }

            DatabaseCustomer::create([
                'kode_customer' => $nextCustomerCode,
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('customer.index')->with('status', 'Data Customer telah ditambahkan');
        }

        // Generate the next customer code for display
        $latestCustomer = DatabaseCustomer::orderBy('kode_customer', 'desc')->first();
        if ($latestCustomer) {
            $lastCustomerCode = substr($latestCustomer->kode_customer, 1); // Ambil angka dari kode terakhir
            $nextCustomerCode = 'C' . str_pad(intval($lastCustomerCode) + 1, 3, '0', STR_PAD_LEFT); // Tambahkan 1 dan format ulang ke 3 digit
        } else {
            $nextCustomerCode = 'C001';
        }

        return view('page.admin.customer.addCustomer', ['next_customer_code' => $nextCustomerCode]);
    }


    public function updateCustomer($kode_customer, Request $request)
    {
        $customer = DatabaseCustomer::findOrFail($kode_customer);

        if ($request->isMethod('post')) {
            // Update data customer
            $customer->update([
                'kode_customer' => $request->kode_customer,
                'nama_customer' => $request->nama_customer,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
            ]);

            return redirect()->route('customer.index')->with('status', 'Data Customer berhasil diperbarui.');
        }

        return view('page.admin.customer.updateCustomer', [
            'customer' => $customer
        ]);
    }

    public function hapusCustomer($kode_customer)
    {
        $customer = DatabaseCustomer::findOrFail($kode_customer);
        $customer->delete();

        return response()->json([
            'msg' => 'Data yang dipilih telah dihapus'
        ]);
    }
}
