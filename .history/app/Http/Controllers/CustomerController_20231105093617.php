<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{

    public function index(): View
    {
        return view('master.customer.index');
    }

    public function data()
    {
      $customer = Customer::orderBy('kodeMember')->get();

       return datatables()
       ->of($customer)
       ->addIndexColumn()
       ->addColumn('kodeMember', function($customer){
        return '<span class="badge badge-success">'. $customer->kodeMember .'</span>';
       })
       ->addColumn('aksi', function($customer){
        return '
        <div class="button-group">
        <button onclick="editForm(`'. route('customer.update', $customer->id_customer) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button onclick="deleteData(`'. route('customer.destroy', $customer->id_customer) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi'])
       ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $customer = Customer::latest()->first();
      $kodeMember = (int)$customer->kodeMember +1 ?? 1;

      $customer = new Customer();
      $customer->kodeMember = tambah_nol_didepan($kodeMember, 5);

      $customer->namaCustomer = $request->namaCustomer;
      $customer->alamat = $request->alamat;
      $customer->noTelepon = $request->noTelepon;
      $customer->save();

        return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
         $customer = Customer::find($id);
         $customer->namaCustomer = $request->namaCustomer;
         $customer->update();

        return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        $customer->delete();

        return response(null, 204);
    }
}
