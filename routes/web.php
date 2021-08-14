<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//    return redirect('login');
// });

// customer
Route::group(['middleware' => ['access-log']], function () {
   Route::get('/', 'CustomerController@indexCustomer');
});
// Route::view('/lihat', 'auth.login_2');

Route::get('/tentang-kami', 'CustomerController@indexAboutUsCustomer');
Route::get('/toko', 'CustomerController@toko');
Route::get('/read-article', 'ArticleController@indexUser');
Route::get('/read-article/{article}', 'ArticleController@show');
Route::get('/cart', 'CustomerController@cart');
Route::get('/pembayaran', 'CustomerController@pembayaran');
Route::get('/belanja/{id}', 'CustomerController@belanja');
Route::get('/result/{id}/{kode}', 'CustomerController@result');
Route::get('/cari', 'CustomerController@cari');
Route::get('/toko/{nama}', 'CustomerController@search');
Route::post('/customer/store/pesan', 'CustomerController@pesanCustomer');
Route::post('/toko/cari', 'CustomerController@search');
Route::post('/transaksi', 'CustomerController@transaksi');
Route::post('/deleteCart', 'CustomerController@deleteCart');
Route::post('/pesan', 'CustomerController@pesan');



// owner
Route::group(['middleware' => ['checkuser']], function () {
   // main dashboard
   Route::get('/owner/dashboard', 'OwnerController@indexMainDashboard');
   Route::get('/owner/dashboard/show', 'OwnerController@showMainDashboard');
   // owner
   Route::get('/owner/profile', 'OwnerController@indexOwner');
   Route::post('/owner/profile/update', 'OwnerController@updateOwner');
   Route::post('/owner/profile/updatepassword', 'OwnerController@updatePassword');
   // perusahaan
   Route::get('/owner/perusahaan', 'OwnerController@indexPerusahaan');
   Route::post('/owner/perusahaan/update', 'OwnerController@updatePerusahaan');
   // kategori
   Route::get('/owner/kategori', 'OwnerController@indexKategori');
   Route::post('/owner/kategori/store', 'OwnerController@storeKategori');
   Route::post('/owner/article/category', 'ArticleController@storeKategori');
   Route::post('/owner/article/category-update/{kategori}', 'ArticleController@updateKategori');
   Route::get('/owner/article/category-destroy/{kategori}', 'ArticleController@destroyKategori');
   Route::get('/owner/kategori/search/{nama}', 'OwnerController@searchKategori');
   Route::get('/owner/kategori/edit/{id}', 'OwnerController@editKategori');
   Route::post('/owner/kategori/update/{id}', 'OwnerController@updateKategori');
   Route::get('/owner/kategori/destroy/{id}', 'OwnerController@destroyKategori');
   // produk
   Route::get('/owner/produk', 'OwnerController@indexProduk');
   Route::post('/owner/produk/store', 'OwnerController@storeProduk');
   Route::get('/owner/produk/show/{id}', 'OwnerController@showProduk');
   Route::get('/owner/produk/search/{nilai}', 'OwnerController@searchProduk');
   Route::get('/owner/produk/edit/{id}', 'OwnerController@editProduk');
   Route::post('/owner/produk/update/{id}', 'OwnerController@updateProduk');
   Route::get('/owner/produk/destroy/{id}', 'OwnerController@destroyProduk');
   // transaksi
   Route::get('/owner/transaksi', 'OwnerController@indexTransaksi');
   Route::get('/owner/detail-transaksi/{ip}', 'OwnerController@detailTransaksi');
   Route::get('/owner/transaksi/destroy/{id}', 'OwnerController@destroyTransaksi');
   Route::get('/owner/ganti-status/{id}', 'OwnerController@gantiStatus');
   Route::get('/owner/transaksi/search/{nilai}', 'OwnerController@searchTransaksi');
   // pesan
   Route::get('/owner/pesan', 'OwnerController@indexPesan');
   Route::resource('/owner/article', ArticleController::class);
});

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

// Route::get('/login2', 'CustomerController@loginView');
