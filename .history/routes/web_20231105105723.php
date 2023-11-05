<?php
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SuplierController;
use App\Http\Controllers\TransaksiDetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', fn () => redirect()->route('login'));

Route::middleware(['auth:sanctum','verified'])->get('/dashboard',function (){
    return view('home');
})->name('dashboard');




Route::resource('transaksis',TransaksiDetailController::class);

Route::group(['middleware'=> 'auth'],function(){

    Route::get('/kategori/data',[KategoriController::class,'data'])->name('kategori.data');
    Route::resource('/kategori',KategoriController::class);

    Route::get('/produk/data',[ProdukController::class,'data'])->name('produk.data');
    Route::post('/produk/delete-selected',[ProdukController::class,'deleteSelected'])->name('produk.delete_selected');
    Route::resource('/produk',ProdukController::class);

    Route::get('/customer/data',[CustomerController::class,'data'])->name('customer.data');
    Route::resource('/customer',CustomerController::class);

    Route::get('/suplier/data',[SuplierController::class,'data'])->name('suplier.data');
    Route::resource('/suplier',SuplierController::class);

    Route::get('/suplier/data',[SuplierController::class,'data'])->name('suplier.data');
    Route::resource('/pembelian',SuplierController::class);
});
