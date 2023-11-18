<?php

namespace App\Http\Controllers;

use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Suplier;
use Illuminate\Http\Request;

class PembelianDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_pembelian = session('id_pembelian');
        $produk = Produk::orderBy('namaProduk')->get();
        $suplier = Suplier::find(session('id_suplier'));

        if (! $suplier) {
            abort(404);
        }

        return view('pembelian_detail.index',compact('id_pembelian', 'produk', 'suplier'));
    }

    public function data($id)
    {
      $detail = PembelianDetail::with('produks')
      ->where('id_pembelian', $id)
      ->get();



       return datatables()
       ->of($detail)
       ->addIndexColumn()
       ->addColumn('namaProduk', function ($detail) {
        return $detail->produk['namaProduk'];
       })
       ->addColumn('kode_produk', function ($detail) {
        return $detail->produk['kode_produk'];
       })
       ->addColumn('aksi', function($detail) {
        return '
        <div class="btn-group">
        <button onclick="deleteData(`'. route('pembelian_detail.destroy', $detail->id_pembelian_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi'])
       ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (! $produk) {
           return response()->json('Data gagal',400);
        }
        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->hargaBeli = $produk->hargaBeli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->hargaBeli;
        $detail->save();

        return response()->json('Data berhasil di simpan',200);

    }

    /**
     * Display the specified resource.
     */
    public function show(PembelianDetail $pembelianDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PembelianDetail $pembelianDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PembelianDetail $pembelianDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PembelianDetail $pembelianDetail)
    {
        //
    }
}
