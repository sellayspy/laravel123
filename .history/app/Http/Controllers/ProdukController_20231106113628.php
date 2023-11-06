<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ProdukController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all()->pluck('namaKategori','id_kategori');
        return view('master.barang.index', compact('kategori'));
    }
    public function data()
    {
     $produk = Produk::orderBy('id_produk', 'desc')->get();

       return datatables()
       ->of($produk)
       ->addIndexColumn()
       ->addColumn('aksi', function($produk){
        return '
        <div class="btn-group">
        <button onclick="editForm(`'. route('produk.update',$produk->id_produk) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button onclick="deleteData(`'. route('produk.destroy',$produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        $produk = Produk::latest()->first();
        $request['kode_produk'] = 'P-'. tambah_nol_didepan($produk->id, 6);
        $produk = Produk::create($request->all());

        return response()->json('Data Di Simpan',200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $produk = Produk::find($id);

        return response()->json($produk);
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
        $produk = Produk::find($id);
        $produk->update($request->all());

       return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $produk = Produk::find($id);
       $produk->delete();

        return response(null, 204);
    }
    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = Produk::find($id);
            $produk->delete();
        }
        return response(null, 204);
    }
}
