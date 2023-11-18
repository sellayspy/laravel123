<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Produk;
use App\Models\Suplier;
use Egulias\EmailValidator\Result\Reason\UnclosedComment;
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
        $diskon  = Pembelian::find($id_pembelian)->diskon ?? 0;

        if (! $suplier) {
            abort(404);
        }

        return view('pembelian_detail.index',compact('id_pembelian', 'produk', 'suplier','diskon'));
    }

    public function data($id)
    {
      $detail = PembelianDetail::with('produk')
      ->where('id_pembelian', $id)
      ->get();
      $data = array();
      $total = 0;
      $total_item = 0;

      foreach ($detail as $item) {
        $row = array();
        $row['kode_produk'] = $item->produk['kode_produk'];
        $row['namaProduk']  = $item->produk['namaProduk'];
        $row['hargaBeli']   = 'Rp. '. format_uang($item->hargaBeli);
        $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id ="'. $item->id_pembelian_detail.'" value="'. $item->jumlah .'">';
        $row['subtotal']    = 'Rp.'. format_uang($item->subtotal);
        $row['aksi']        = '<div class="btn-group">
                               <button onclick="deleteData(`'. route('pembelian_detail.destroy', $item->id_pembelian_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                               </div>';
        $data[] = $row;

        $total += $item->hargaBeli * $item->jumlah;
        $total_item += $item->jumlah;
      }
      $data[] = [
       'kode_produk' => '
       <div class="total hide">'. $total .'</div>
       <div class="totalItem hide">'. $total_item .'</div>',
       'namaProduk'  => '',
       'hargaBeli'   => '',
       'jumlah'      => '',
       'subtotal'    => '',
       'aksi'        => '',
      ];

       return datatables()
       ->of($data)
       ->addIndexColumn()
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
    public function loadForm($diskon, $total){


       $bayar = $total - ($diskon / 100 * $total);
        $data  = [
            'totalrp'   => format_uang($total),
            'bayar'     => $bayar,
            'bayarrp'   => format_uang($bayar),
            'terbilang' => ucwords(terbilang($bayar). ' Rupiah')
        ];

        return response()->json($data);

    }
}
