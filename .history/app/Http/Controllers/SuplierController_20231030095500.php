<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supliers = Suplier::all();
        return view('master.suplier.index',['supliers'=> $supliers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.suplier.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'kdCustomer'      => 'required|size:7|unique:customers,kdCustomer',
            'nmCustomer'      => 'required|min:3|max:20',
            'alamat'          => 'required',
            'noTelepon'       => ''
        ]);

        Customer::create($validateData);

        return redirect()->route('customers.index')->with('pesan',"Customer Dengan {$validateData['nmCustomer']} Berhasil");
    }

    /**
     * Display the specified resource.
     */
    public function show(Suplier $suplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplier $suplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suplier $suplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplier $suplier)
    {
        //
    }
}
