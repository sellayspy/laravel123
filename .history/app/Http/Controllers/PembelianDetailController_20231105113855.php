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

        return view('transaksi.pembelian_detail.index',compact('id_pembelian','produk','suplier'));
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
        //
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
