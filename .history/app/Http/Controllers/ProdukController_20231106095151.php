<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;


class ProdukController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all()->pluck('namaKategori','id_kategori');
        return view('master.barang.index',compact('kategori'));
    }
    public function data()
    {
     $produk = Produk::leftJoin('kategoris', 'kategoris.id_kategori', 'produks.id_kategori')
     ->select('produks.*', 'namaKategori')
     ->orderBy('id_produk','desc')
     ->get();

       return datatables()
       ->of($produk)
       ->addIndexColumn()
       ->addColumn('kodeProduk', function($produk){
        return '
        <span class="label label-success">'. $produk->kodeProduk .'</span>
        ';
       })
       ->addColumn('hargaSatuan', function($produk){
        return format_uang($produk->hargaSatuan);
       })
       ->addColumn('hargaBeli', function($produk){
        return format_uang($produk->hargaBeli);
       })
       ->addColumn('aksi', function($produk){
        return '
        <div class="btn-group">
        <button type="button" onclick="editForm(`'. route('produk.update',$produk->id_produk) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button type="button" onclick="deleteData(`'. route('produk.destroy',$produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi','kodeProduk'])
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
        $produk = Produk::create($request->all());

       return response()->json('Data Berhasil Di Tambahkan', 200);
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
