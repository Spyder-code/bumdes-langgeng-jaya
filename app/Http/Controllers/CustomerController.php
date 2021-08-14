<?php

namespace App\Http\Controllers;

use App\Company;
use App\Order;
use App\Product;
use App\Category;
use App\Checkout;
use App\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
   /*
       index => nampilin semua data
       show => nampilin halaman detail
       store => nyimpan data baru
       edit => menampilkan halaman buat update
       update => update data
       destroy => delete data
   */

  public function loginView()
  {
    return view('auth.login_2');
  }

   public function indexCustomer(Request $request)
   {
      $perusahaan = Company::find(1);
      $request->session()->put('nomorperusahaan', $perusahaan->nomor);
      $request->session()->put('alamatperusahaan', $perusahaan->alamat);
      $request->session()->put('emailperusahaan', $perusahaan->email);
      $request->session()->put('logoperusahaan', $perusahaan->logo);

      $ip = $request->getClientIp();
      $data = DB::table('checkouts')
      ->join('products','products.id','=','checkouts.id_produk')
      ->select('products.nama','products.harga','products.image','checkouts.*')
      ->where('ip',$ip)
      ->where('status',0)
      ->get();
      $total = $data->count();
      if($total==0){
         $request->session()->put('total',0);
      }
      $request->session()->put('cartTotal',$total);
      $katalog = Category::all();

      $produkIkan          =  DB::table('products')
                                ->join('categories', 'categories.id', '=', 'products.id_kategori')
                                ->select('products.*', 'categories.nama as kategori')
                                ->where('categories.id','=', 18)
                                ->orderBy('products.created_at', 'desc')
                                ->limit(5)
                                ->get();
      $produkIkanShowCase  = DB::table('products')
                                ->join('categories', 'categories.id', '=', 'products.id_kategori')
                                ->select('products.*', 'categories.nama as kategori')
                                ->where('categories.id','=', 18)
                                ->orderBy('products.created_at', 'desc')
                                ->paginate(8);

        return view('customer_view.index', compact('produkIkan', 'produkIkanShowCase', 'katalog'));
   }

   public function toko()
   {
        return redirect('toko/all');
   }

   public function indexAboutUsCustomer()
   {
    $katalog = Category::all()->where('type',0);
      $perusahaan = Company::first();
      return view('customer_view.tentangkami', ['perusahaan' => $perusahaan,'katalog' =>$katalog]);
   }

   public function pesanCustomer(Request $request)
   {
      $request->validate([
          'nama'     => 'required|max:255',
          'email'    => 'required|email|max:255',
          'pesan'    => 'required|max:255'
      ]);
      $pesan  = new Order;
      $pesan->nama    = $request->nama;
      $pesan->email   = $request->email;
      $pesan->isi     = $request->pesan;
      $pesan->save();
      return redirect('/tentang-kami')->with('success', 'Pesan berhasil dikirim');
   }


    public function cari(Request $request)
    {
        return redirect('toko/'.$request->nama);
    }

    public function belanja($id)
    {
        $katalog = Category::all();
        $item = Product::find($id);
        $perusahaan = Company::first();
        return view('customer_view.transaksi',compact('item','katalog','perusahaan'));
    }

    public function cart(Request $request)
    {
        $ip = $request->getClientIp();
        $katalog = Category::all();
        $data = DB::table('checkouts')
                ->join('products','products.id','=','checkouts.id_produk')
                ->select('products.nama','products.harga','products.image','checkouts.*')
                ->where('ip',$ip)
                ->where('status',0)
                ->get();
        $total = $data->count();
        $request->session()->put('cartTotal',$total);
        $a = 0;
        return view('customer_view.cart',compact('data','katalog','a'));
    }

   public function search($nama)
   {
       if($nama=="all"){
        $katalog = Category::all();
        $data = Product::paginate(9);
        $total = $data->count();
        return view('customer_view.search',compact('data','total','katalog'));
        }else{
            $katalog = Category::all();
    $data = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.id_kategori')
            ->select('products.*', 'categories.nama as kategori')
            ->where('products.nama','like', $nama."%")
            ->orWhere('categories.nama','like', $nama."%")
            ->paginate(9);
    $total = $data->count();
        return view('customer_view.search',compact('data','total','katalog'));
        }
   }

    public function transaksi(Request $request)
    {

        $produk = Product::where('id',$request->idProduk)->first();
        $a = $produk->stock;
        if($a>$request->jumlah){
            Product::where('id',$request->idProduk)
                ->update([
                    'stock' => $a - $request->jumlah,
                ]);
            Checkout::create([
                'ip' => $request->getClientIp(),
                'id_produk' => $request->idProduk,
                'jumlah' => $request->jumlah,
                'status' =>0
            ]);
        }else{
            return back()->with('danger', 'Jumlah produk yang ingin dibeli melebihi stock kami');
        }
        return redirect('cart');
    }

    public function pembayaran(Request $request)
    {
        $ip = $request->getClientIp();
        $data = DB::table('checkouts')
            ->join('products','products.id','=','checkouts.id_produk')
            ->select('products.nama','products.harga','products.image','checkouts.*')
            ->where('ip',$ip)
            ->where('status',0)
            ->get();
        $katalog = Category::all();
        return view('customer_view.pembayaran',compact('katalog','data'));
    }

    public function deleteCart(Request $request)
    {
        $produk = Checkout::find($request->id);
        $produk->delete();
        return back();
    }

    public function pesan(Request $request)
    {
        $request->validate([
            'nama'     => 'required|max:255',
            'alamat'    => 'required|max:255',
            'nomor'    => 'required|max:13',
        ]);
        mt_srand(10);
        $data = new Transaction();
        $data->nama = $request->nama;
        $data->alamat = $request->alamat;
        $data->nomor = $request->nomor;
        $data->catatan = $request->catatan;
        $data->status = 0;
        $data->kode = mt_rand();;
        $data->total_harga = $request->totalHarga;
        $data->save();

        $request->session()->forget('total');
        $request->session()->forget('cartTotal');
        Checkout::where('ip',$request->getClientIp())
        ->where('status',0)
            ->update([
                'status' => 1,
                'id_transaksi' => $data->id,
            ]);
            return redirect('result/'.$data->id.'/'.$data->kode);
    }

    public function result($id,$kode)
    {
        $katalog = Category::all();
        $data =  DB::table('transactions')
        ->join('checkouts', 'checkouts.id_transaksi', '=', 'transactions.id')
        ->join('products', 'products.id', '=', 'checkouts.id_produk')
        ->select('checkouts.jumlah as jumlah','transactions.*', 'products.nama as namaProduk','products.harga')
        ->where('checkouts.id_transaksi', '=', $id)
        ->where('checkouts.status', '=', 1)
        ->where('transactions.kode', '=', $kode)
        ->groupBy('products.nama')
        ->get();

        $dataPerson =  DB::table('transactions')
        ->join('checkouts', 'checkouts.id_transaksi', '=', 'transactions.id')
        ->join('products', 'products.id', '=', 'checkouts.id_produk')
        ->select('checkouts.jumlah as jumlah','transactions.*', 'products.nama as namaProduk','products.harga')
        ->where('checkouts.id_transaksi', '=', $id)
        ->where('checkouts.status', '=', 1)
        ->where('transactions.kode', '=', $kode)
        ->groupBy('products.nama')
        ->first();

        $perusahaan = Company::first();

        $count = $data->count();
        if($count==0){
            return redirect('toko/all');
        }else{
            return view('customer_view.result',compact('katalog','data','dataPerson', 'perusahaan'));
        }
    }
}
