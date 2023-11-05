<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('master.kategori.index');
    }

    public function data()
    {
      $kategori = Kategori::orderBy('id','desc')->get();

       return datatables()
       ->of($kategori)
       ->addIndexColumn()
       ->addColumn('aksi', function($kategori){
        return '<button class="btn btn-xs btn-info btn-flat"><i class="fa fa-edit"></i></button>
        <button class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $kategori = new Kategori();
        $kategori->nmKategori = $request->nmKategori;
       $kategori->save();

        return response()->json('Data Berhasil Di Tambahkan', 200);
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