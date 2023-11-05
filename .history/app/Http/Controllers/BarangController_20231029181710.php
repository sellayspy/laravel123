<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $barangs = Barang::all();

        if($request->filled('search')){
            $barangs = Barang::search($request->search)->get();
        }else{
            $barangs = Barang::get();
        }

        return view('master.barang.index',['barangs'=>$barangs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'kdBarang'   => 'required|size:6|unique:barangs,kdBarang',
            'nmBarang'   => 'required',
            'satuan'     => 'required',
            'hargaSatuan'=> 'required|numeric',
            'stock'      => 'required',
            'tglExpired' => ''
        ]);

        Barang::create($validateData);
         return redirect()->route('barangs.index')->with('pesan',"Penambahan Data {$validateData['nmBarang']}Berhasil");
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
    public function edit(Barang $barang)
    {
        return view('master.barang.edit',['barang'=>$barang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Barang $barang)
    {
        $validateData = $request->validate([
            'nmBarang'   => 'required',
            'satuan'     => 'required',
            'hargaSatuan'=> 'required|numeric',
            'stock'      => 'required',
            'tglExpired' => ''
        ]);

        Barang::where('id',$barang->id)->update($validateData);
        return redirect()->route('barangs.index',['barang'=>$barang->id])->with('pesan',"Update Data{$validateData['nmBarang']} Berhasil");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with('pesan',"Hapus Data $barang->nmBarang Berhasil");
    }
}
