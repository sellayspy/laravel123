<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penjual;
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
        }else {
            if (auth()->user()->level == 1) {
                return redirect()->route('transaksi.baru');
            }else {
                return redirect()->route('home');
            }
        }
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
