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
      $customer = Customer::orderBy('id_customer','desc')->get();

       return datatables()
       ->of($customer)
       ->addIndexColumn()
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
        $kode_member = $customer->kode_member ?? 1;

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

        $kategori = Kategori::find($id);

        return response()->json($kategori);
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
        $kategori = Kategori::find($id);
         $kategori->nmKategori = $request->nmKategori;
         $kategori->update();

        return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

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
    // public function cetakMember(Request $request){
    //     $dataMember = array();
    //     foreach ($request->id_customer as $id){
    //         $member = Customer::find($id);
    //         $dataMember[] = $member;
    //     }

    //     return $dataMember;

    //     $no = 1;
    //     $pdf = PDF::loadView('produk.barcode', compact('dataMember','no'));
    //     $pdf->setPaper('a4','potrait');
    //     return $pdf->stream('produk.pdf');

    // }
}
