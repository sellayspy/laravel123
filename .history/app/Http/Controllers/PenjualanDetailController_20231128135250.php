<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\PenjualanDetail;
use App\Models\Produk;
use Illuminate\Http\Request;

class PenjualanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::orderBy('namaProduk')->get();
        $customer = Customer::orderBy('namaCustomer')->get();


        if ($id_penjualan = session('id_penjualan')) {
            return view('penjualan_detail.index',compact('produk','customer','id_penjualan'));
        }else{
            if (auth()->user()->level == 1) {
                return redirect()->route('transaksi.baru');
            }else {
                return redirect()->route('home');
             }
           }
        }

    public function data($id)
    {
      $detail = PenjualanDetail::with('produk')
      ->where('id_penjualan', $id)
      ->get();

      $data = array();
      $total = 0;
      $total_item = 0;


      foreach ($detail as $item) {
        $row = array();
        $row['kode_produk'] = $item->produk['kode_produk'];
        $row['namaProduk']  = $item->produk['namaProduk'];
        $row['hargaJual']   = 'Rp. '. format_uang($item->hargaJual);
        $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id ="'. $item->id_penjualan_detail.'" value="'. $item->jumlah .'">';
        $row['diskon']      = $item->diskon.'%' ;
        $row['subtotal']    = 'Rp.'. format_uang($item->subtotal);
        $row['aksi']        = '<div class="btn-group">
                               <button onclick="deleteData(`'. route('transaksi.destroy', $item->id_penjualan_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                               </div>';
        $data[] = $row;

        $total += $item->hargaJual * $item->jumlah;
        $total_item += $item->jumlah;
      }
      $data[] = [
       'kode_produk' => '
       <div class="total hide">'. $total .'</div>
       <div class="totalItem hide">'. $total_item .'</div>',
       'namaProduk'  => '',
       'hargaJual'   => '',
       'jumlah'      => '',
       'diskon'      => '',
       'subtotal'    => '',
       'aksi'        => '',
      ];

       return datatables()
       ->of($data)
       ->addIndexColumn()
       ->rawColumns(['aksi','kode_produk','jumlah'])
       ->make(true);
    }

    // public function loadForm($diskon = 0, $total, $diterima)
    // {
    //     $bayar = $total - ($diskon / 100 * $total);
    //     $kembali = ($diterima !=0 ? $diterima - $bayar : 0);
    //     $data  = [
    //         'totalrp'   => format_uang($total),
    //         'bayar'     => $bayar,
    //         'bayarrp'   => format_uang($bayar),
    //         'terbilang' => ucwords(terbilang($bayar). 'Rupiah'),
    //         'kembalirp' => format_uang($kembali)
    //     ];

    //     return response()->json($data);
    // }
    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {

    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $produk = Produk::where('id_produk', $request->id_produk)->first();
    //     if (! $produk) {
    //        return response()->json('Data gagal',400);
    //     }
    //     $detail = new PenjualanDetail();
    //     $detail->id_penjualan = $request->id_penjualan;
    //     $detail->id_produk = $produk->id_produk;
    //     $detail->hargaJual = $produk->hargaJual;
    //     $detail->jumlah = 1;
    //     $detail->diskon = 0;
    //     $detail->subtotal = $produk->hargaJual;
    //     $detail->save();

    //     return response()->json('Data berhasil di simpan',200);
    // }

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
