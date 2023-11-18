<?php
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PembelianDetailController;
use App\Http\Controllers\PenjualanDetailController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\SuplierController;
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
    Route::post('/produk/delete-selected' ,[ProdukController::class,'deleteSelected'])->name('produk.delete_selected');
    Route::resource('/produk',ProdukController::class);

    Route::get('/customer/data',[CustomerController::class,'data'])->name('customer.data');
    Route::post('/customer/delete-selected' ,[CustomerController::class,'deleteSelected'])->name('customer.delete_selected');
    Route::resource('/customer',CustomerController::class);

    Route::get('/suplier/data',[SuplierController::class,'data'])->name('suplier.data');
    Route::resource('/suplier',SuplierController::class);

    Route::get('/pembelian/data',[PembelianController::class,'data'])->name('pembelian.data');
    Route::get('/pembelian/{id}/create',[PembelianController::class,'create'])->name('pembelian.create');
    Route::resource('/pembelian',PembelianController::class)->except('create');


    Route::get('/pembelian_detail/{id}/data',[PembelianDetailController::class,'data'])->name('pembelian_detail.data');
    Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class,'loadForm'])->name('pembelian_detail.load_form');
    Route::resource('/pembelian_detail',PembelianDetailController::class)->except('create','show','edit');

    Route::get('/transaksi/baru', [PenjualanController::class,'create'])->name('transaksi.baru');
    Route::get('/transaksi/{id}/data',[PenjualanDetailController::class,'data'])->name('transaksi.data');
    Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}',[PenjualanDetailController::class,'loadForm'])->name('transaksi.load_form');
    Route::resource('/transaksi', PenjualanDetailController::class)->except('show');

});
