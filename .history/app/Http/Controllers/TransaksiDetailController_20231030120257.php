<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
        $barang = Barang::orderBy('nmBarang')->get();
        $customer = Customer::orderBy('nmCustomer')->get();

        dd($barang,$customer);
    }
}
