<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $customers = Customer::all();
        return view('master.customer.index',['customers'=>$customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.customer.create');

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('master.customer.edit',['customer'=>$customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validateData = $request->validate([
            'nmCustomer'      => 'required|min:3|max:20',
            'alamat'          => 'required',
            'noTelepon'       => 'required'
        ]);

        Customer::where('id',$customer->id)->update($validateData);
        return redirect()->route('customers.index',['customer'=>$customer->id])->with('pesan',"Update Data{$validateData['nmCustomer']} Berhasil");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('pesan',"Hapus Data $customer->nmCustomer Berhasil");
    }
}
