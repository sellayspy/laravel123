<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransaksiDetailController extends Controller
{
    public function index()
    {
      return view('transaksi.index');
    }
}
