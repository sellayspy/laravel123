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
      $customer = Customer::orderBy('kode_member')->get();

       return datatables()
       ->of($customer)
       ->addIndexColumn()
       ->addColumn('select_all', function ($customer) {
        return '<input type="checkbox" name="id_customer[]" value="'. $customer->id_customer .'">
        ';
       })
       ->addColumn('kode_member', function($customer){
        return '<span class="label label-success">'. $customer->kode_member .'</span>';
       })
       ->addColumn('aksi', function($customer){
        return '
        <div class="button-group">
        <button onclick="editForm(`'. route('customer.update', $customer->id_customer) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button onclick="deleteData(`'. route('customer.destroy', $customer->id_customer) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi','kode_member','select_all'])
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
        $kode_member = (int) $customer->kode_member +1 ?? 1;

        $customer = new Customer();
        $customer->kode_member = tambah_nol_didepan($kode_member, 5);
        $customer->namaCustomer = $request->namaCustomer;
        $customer->noTelepon = $request->noTelepon;
        $customer->alamat     = $request->alamat;
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
       $customer = Customer::find($id)->update($request->all());

        return response()->json('Data Berhasil Di Update', 200);
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

  /*  public function deleteSelected(Request $request)
    {
        foreach ($request->id_customer as $id) {
            $customer = Customer::find($id);
            $customer->delete();
        }
        return response(null, 204);
    }
*/
    public function cetakCustomer(Request $request){
        $dataMember = array();
        foreach ($request->id_customer as $id){
            $member = Customer::find($id);
            $dataMember[] = $member;
        }

        return $dataMember;
        $no  = 1;
        $pdf = PDF::loadView('customer.cetak', compact('datamember','no'));
        $pdf->setPaper('a4','potrait');
        return $pdf->stream('customer.pdf');

    }
}
