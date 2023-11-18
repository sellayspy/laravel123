<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penjual;
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


      return $detail;
      $data = array();
      $total = 0;
      $total_item = 0;


      foreach ($detail as $item) {
        $row = array();
        $row['kode_produk'] = $item->produk['kode_produk'];
        $row['namaProduk']  = $item->produk['namaProduk'];
        $row['hargaJual']   = 'Rp. '. format_uang($item->hargaJual);
        $row['jumlah']      = '<input type="number" class="form-control input-sm quantity" data-id ="'. $item->id_pembelian_detail.'" value="'. $item->jumlah .'">';
        $row['diskon']      = $item->diskon.'%' ;
        $row['subtotal']    = 'Rp.'. format_uang($item->subtotal);
        $row['aksi']        = '<div class="btn-group">
                               <button onclick="deleteData(`'. route('pembelian_detail.destroy', $item->id_pembelian_detail) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
       'hargaBeli'   => '',
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
