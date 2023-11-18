<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Suplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suplier = Suplier::orderBy('id_suplier')->get();
        return view('pembelian.index', compact('suplier'));
    }


    public function data()
    {
        $pembelian = Pembelian::orderBy('id_pembelian','desc')->get();

       return datatables()
       ->of($pembelian)
       ->addIndexColumn()
       ->addColumn('totalItem',function($pembelian){
        return format_uang($pembelian->totalItem);
       })
       ->addColumn('totalHarga',function($pembelian){
        return 'Rp.'. format_uang($pembelian->totalHarga);
       })
       ->addColumn('bayar', function($pembelian){
        return 'Rp.'. format_uang($pembelian->bayar);
       })
       ->addColumn('tanggal',function($pembelian){
        return tanggal_indonesia($pembelian->created_at, false);
       })
       ->addColumn('supplier', function($pembelian){
        return $pembelian->suplier->namaSuplier;
       })
       ->addColumn('aksi', function($pembelian){
        return '
        <div class="button-group">
        <button onclick="showDetail(`'. route('pembelian.show', $pembelian->id_pembelian) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
        <button onclick="deleteData(`'. route('pembelian.destroy', $pembelian->id_pembelian) .'`)" class="btn btn-xs btn-info btn-danger"><i class="fa fa-trash"></i></button>
        </div>
        ';
       })
       ->rawColumns(['aksi'])
       ->make(true);
    }

    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_suplier   = $id;
        $pembelian->totalItem    = 0;
        $pembelian->totalHarga   = 0;
        $pembelian->diskon       = 0;
        $pembelian->bayar        = 0;
        $pembelian->save();

        session(['id_pembelian' => $pembelian->id_pembelian]);
        session(['id_suplier' => $pembelian->id_suplier]);

        return redirect()->route('pembelian_detail.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pembelian = Pembelian::findOrFail($request->id_pembelian);
        $pembelian->totalItem = $request->totalItem;
        $pembelian->totalHarga = $request->total;
        $pembelian->diskon  = $request->diskon;
        $pembelian->bayar   = $request->bayar;
        $pembelian->update();

        $detail = PembelianDetail::where('id_pembelian', $pembelian->id)->get();
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
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
