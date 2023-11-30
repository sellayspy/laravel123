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
        $penjualan = Penjualan::orderBy('id_penjualan','desc')->get();

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
       ->addColumn('kode_member', function($penjualan){
        return '<span class="label label-success">'.$penjualan->customer['kode_member'] ?? ''.'</span>';
       })
       ->editColumn('diskon', function($penjualan){
        return $penjualan->diskon . '%';
       })
       ->addColumn('kasir', function($penjualan){
        return $penjualan->user->name ?? '';
       })
       ->addColumn('aksi', function($penjualan){
        return '
        <div class="button-group">
        <button onclick="showDetail(`'. route('penjualan.show', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
        <button onclick="deleteData(`'. route('penjualan.destroy', $penjualan->id_penjualan) .'`)" class="btn btn-xs btn-info btn-danger"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi','kode_member'])
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
        $penjualan->totalHarga = 0;
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
        $penjualan->totalHarga = $request->total;
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
        $detail = PenjualanDetail::with('produk')->where('id_penjualan', $id)->get();

        return datatables()
        ->of($detail)
        ->addIndexColumn()
        ->addColumn('kode_produk',function($detail){
         return $detail->produk->kode_produk;
        })
        ->addColumn('namaProduk',function($detail){
         return $detail->produk->namaProduk;
        })
        ->addColumn('hargaJual', function($detail){
         return 'Rp.'. format_uang($detail->hargaJual);
        })
        ->addColumn('jumlah', function($detail){
            return format_uang($detail->jumlah);
           })
           ->addColumn('subtotal', function($detail){
            return 'Rp.'. format_uang($detail->subtotal);
           })
        ->make(true);
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
        $penjualan  = Penjualan::find($id);
        $detail     = PenjualanDetail::where('id_penjualan', $penjualan->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->delete();
        }

        $penjualan->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        return view('penjualan.selesai');
    }
}
