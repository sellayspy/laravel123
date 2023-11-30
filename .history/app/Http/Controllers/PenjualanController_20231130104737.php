<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\PenjualanDetail;
use App\Models\Produk;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penjualan.index');
    }

    public function data()
    {
        $penjualan = Pembelian::orderBy('id_penjualan','desc')->get();

       return datatables()
       ->of($penjualan)
       ->addIndexColumn()
       ->addColumn('totalItem',function($penjualan){
        return format_uang($penjualan->totalItem);
       })
       ->addColumn('totalHarga',function($penjualan){
        return 'Rp.'. format_uang($penjualan->totalHarga);
       })
       ->addColumn('bayar', function($penjualan){
        return 'Rp.'. format_uang($penjualan->bayar);
       })
       ->addColumn('tanggal',function($penjualan){
        return tanggal_indonesia($penjualan->created_at, false);
       })
       ->addColumn('suplier', function($penjualan){
        return $penjualan->suplier->namaSuplier;
       })
       ->editColumn('diskon', function($penjualan){
        return $penjualan->diskon . '%';
       })
       ->addColumn('aksi', function($penjualan){
        return '
        <div class="button-group">
        <button onclick="showDetail(`'. route('pembelian.show', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
        <button onclick="deleteData(`'. route('pembelian.destroy', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-info btn-danger"><i class="fa fa-trash"></i></button>
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
    public function store(Request $request)
    {
        $penjualan = Penjualan::findOrFail($request->id_penjualan);
        $penjualan->id_customer = $request->id_customer;
        $penjualan->totalItem = $request->totalItem;
        $penjualan->totalHaga = $request->total;
        $penjualan->diskon  = $request->diskon;
        $penjualan->bayar   = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk = Produk::find($item->id_produk);
            $produk->stok -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('penjualan.index');
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
