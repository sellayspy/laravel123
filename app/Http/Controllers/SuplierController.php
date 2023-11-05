<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('master.suplier.index');
    }

    public function data()
    {
      $suplier = Suplier::orderBy('id_suplier','desc')->get();

       return datatables()
       ->of($suplier)
       ->addIndexColumn()
       ->addColumn('aksi', function($suplier){
        return '
        <div class="button-group">
        <button type="button" onclick="editForm(`'. route('suplier.update', $suplier->id_suplier) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-pencil"></i></button>
        <button type="button" onclick="deleteData(`'. route('suplier.destroy', $suplier->id_suplier) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
        </div>
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
        $suplier = Suplier::create($request->all());
        return response()->json('Data Berhasil Di Tambahkan', 200);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $suplier = Suplier::find($id);

        return response()->json($suplier);
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
    public function update(Request $request,$id)
    {
        $suplier = Suplier::find($id)->update($request->all());

        return response()->json('Data Berhasil Di Tambahkan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suplier = Suplier::find($id)->delete();

        return response(null, 204);
    }
}
