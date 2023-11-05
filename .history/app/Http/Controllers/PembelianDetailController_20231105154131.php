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

        return view('pembelian_detail.index',compact('id_pembelian','produk','suplier'));
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
        $produk = Produk::where('id_produk', $request->id_produk)->first();
        if (! $produk) {
           return response()->json('Data gagal',400);
        }
        $detail = new PembelianDetail();
        $detail->id_pembelian = $request->id_pembelian;
        $detail->id_produk = $produk->id_produk;
        $detail->hargaJual = $produk->hargaJual;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->hargaSatuan;
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
