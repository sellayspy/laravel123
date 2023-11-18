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
      $detail = PembelianDetail::with('produk')
      ->where('id_pembelian', $id)
      ->get();

      $data = array();
      $total = 0;
      $total_item = 0;

      foreach ($detail as $key => $item) {
        $row = array();
        $row['kode_produk'] ='<span class="label label-success">'. $item->produk['kode_produk'] .'</span>';
        $row['namaProduk']  = $item->produk['namaProduk'];
        $row['hargaBeli']   = 'Rp. '. $item->hargaBeli;
        $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id="'. $item->id_pembelian_detail .'"  value="'. $detail->jumlah .'">';
        $row['subtotal']    = $item->subtotal;
        $data[] = $row;

        $total += $item->hargaBeli * $item->jumlah;
        $total_item += $item->jumlah;
      }


       return datatables()
       ->of($detail)
       ->addIndexColumn()
       ->addColumn('namaProduk', function ($detail) {
        return $detail->produk['namaProduk'];
       })
       ->addColumn('kode_produk', function ($detail) {
        return '<span class="label label-success">'. $detail->produk['kode_produk'] .'</span>';
       })
       ->addColumn('hargaBeli', function($detail){
        return 'Rp. '. $detail->hargaBeli;
       })
       ->addColumn('jumlah', function($detail){
        return '<input type="number" class="form-control input-sm quantity" data-id="'. $detail->id_pembelian_detail .'" value="'. $detail->jumlah .'">';
       })
       ->addColumn('subtotal', function($detail){
        return 'Rp.'. $detail->subtotal;
       })
       ->addColumn('aksi', function($detail) {
        return '
        <div class="btn-group">
        <button onclick="deleteData(`'. route('pembelian_detail.destroy', $detail->id_pembelian_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi','kode_produk','jumlah'])
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
    public function update(Request $request, $id)
    {
        $detail = PembelianDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->hargaBeli * $request->jumlah;
        $detail->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detail = PembelianDetail::find($id);
        $detail->delete();

        return response(null,204);
    }
}
