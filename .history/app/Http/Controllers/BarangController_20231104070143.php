<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{

    public function index(): View
    {
        return view('master.barang.index');
    }
    public function data()
    {
     $barang = Barang::orderBy('id','desc')->get();

       return datatables()
       ->of($barang)
       ->addIndexColumn()
       ->addColumn('aksi', function($barang){
        return '
        <div class="button-group">
        <button onclick="editForm(`'. route('barang.update',$barang->id) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button onclick="deleteData(`'. route('barang.destroy',$barang->id) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $barang = new Barang();
        $barang->nmBarang = $request->nmBarang;
       $barang->save();
       return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $barang = Barang::find($id);

        return response()->json($barang);
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
        $barang = Barang::find($id);
        $barang->nmBarang = $request->nmBarang;
        $barang->update();

        return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $barang = Barang::find($id);
       $barang->delete();

        return response(null, 204);
    }
}
