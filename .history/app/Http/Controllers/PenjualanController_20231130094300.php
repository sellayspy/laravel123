<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $penjualan = new Penjualan();
        $penjualan->id_customer = null;
        $penjualan->totalItem = 0;
        $penjualan->totalHaga = 0;
        $penjualan->diskon    = 0;
        $penjualan->bayar     = 0;
        $penjualan->diterima  = 0;
        $penjualan->id_user   = auth()->id();
        $penjualan->save();

        session(['id_penjualan' => $penjualan->id_penjualan]);
        return redirect()->route('transaksi.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $requpenjualan = Pembelian::findOrFail($request->id_pembelian);
        $penjualan->totalItem = $request->totalItem;
        $penjualan->totalHarga = $request->total;
        $penjualan->diskon  = $request->diskon;
        $penjualan->bayar   = $request->bayar;
        $penjualan->update();

        $detail = PembelianDetail::where('id_pembelian', $penjualan->id)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->stok += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
