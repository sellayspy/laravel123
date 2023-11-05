<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Suplier;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suplier = Suplier::orderBy('namaSuplier')->get();
        return view('pembelian.index',compact('suplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $pembelian = new Pembelian();
        $pembelian->id_suplier = $id;
        $pembelian->totalItem = 0;
        $pembelian->totalHarga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
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
        //
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
