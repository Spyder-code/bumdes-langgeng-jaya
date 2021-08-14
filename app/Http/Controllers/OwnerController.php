<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Checkout;
use App\Company;
use App\Order;
use App\Product;
use App\Transaction;
use App\User;

class OwnerController extends Controller
{
    /*
      index => nampilin semua data
      show => nampilin halaman detail
      store => nyimpan data baru
      edit => menampilkan halaman buat update
      update => update data
      destroy => delete data
   */

   // ------------------------------------------------ main dashboard

   public function indexMainDashboard(Request $request)
   {
      $jumlahProduk = Checkout::where('status',1)->sum('jumlah');
      $jumlahPembeli = Transaction::count();
      $jumlahPengunjung = DB::table('access_logs')->count();
      return view('owner_view.index', ['jumlahProduk' => $jumlahProduk, 'jumlahPembeli' => $jumlahPembeli, 'jumlahPengunjung' => $jumlahPengunjung]);
   }

   public function showMainDashboard()
   {
      $aksesLog =  DB::table('access_logs')->orderBy('created_at', 'asc')->get();
      echo json_encode($aksesLog);
   }

   // ------------------------------------------------ pesan

   public function indexPesan()
   {
      $pesan = Order::orderByDesc('created_at')->paginate(10);
      return view('owner_view.pesan', ['pesan' => $pesan]);
   }

   // ------------------------------------------------ transaksi

   public function indexTransaksi()
   {
      $transaksi = Transaction::orderByDesc('created_at')->paginate(10);
      return view('owner_view.transaksi', ['transaksi' => $transaksi]);
   }

   public function destroyTransaksi($id)
   {
      $transaksi = Transaction::find($id);
      $transaksi->delete();
      return redirect('/owner/transaksi')->with('success', 'Data berhasil dihapus');
   }

   public function detailTransaksi($id)
   {
      $produkDanJumlah =  DB::table('transactions')
                              ->join('checkouts', 'checkouts.id_transaksi', '=', 'transactions.id')
                              ->join('products', 'products.id', '=', 'checkouts.id_produk')
                              ->select('checkouts.jumlah as jumlah', 'products.nama as namaproduk')
                              ->where('checkouts.id_transaksi', '=', $id)
                              ->where('checkouts.status', '=', 1)
                              ->groupBy('products.nama')
                              ->get();

      $namaDanTotalHarga =  DB::table('transactions')
                              ->join('checkouts', 'checkouts.id_transaksi', '=', 'transactions.id')
                              ->join('products', 'products.id', '=', 'checkouts.id_produk')
                              ->select('transactions.*')
                              ->where('checkouts.id_transaksi', '=', $id)
                              ->where('checkouts.status', '=', 1)
                              ->groupBy('products.nama')
                              ->first();

      return view('owner_view.detail_transaksi', ['produkDanJumlah' => $produkDanJumlah, 'namaDanTotalHarga' => $namaDanTotalHarga]);
   }

   public function gantiStatus($id)
   {
      $transaksi = Transaction::find($id);
      if($transaksi->status != 1) {
         $transaksi->status = 1;
         $transaksi->save();
         return back()->with('success', 'Status berhasil diganti');;
      } else {
         return back()->with('fail', 'Status telah terpenuhi!');;
      }
   }

   public function searchTransaksi($nilai)
   {
      if($nilai != "zero") {
         $transaksi = DB::table('transactions')
                        ->where('nama', 'like', $nilai."%")
                        ->get();
         echo json_encode($transaksi);
      } else {
         $transaksi = Transaction::orderByDesc('created_at')->get();
         echo json_encode($transaksi);
      }
   }


   // ------------------------------------------------ produk

   public function indexProduk()
   {
     $produk = DB::table('products')
                  ->join('categories', 'categories.id', '=', 'products.id_kategori')
                  ->select('products.*', 'categories.nama as kategori')
                  ->orderBy('created_at', 'desc')
                  ->paginate(10);
     $kategori = Category::all()->where('type',0);
     return view('owner_view.produk', ['produk' => $produk, 'kategori' => $kategori]);
   }

   public function searchProduk($nilai)
   {
      if($nilai != "zero") {
         $produk = DB::table('products')
                     ->join('categories', 'categories.id', '=', 'products.id_kategori')
                     ->select('products.*', 'categories.nama as kategori')
                     ->where('products.nama','like', $nilai."%")
                     ->orWhere('categories.nama','like', $nilai."%")
                     ->get();
         echo json_encode($produk);
      } else {
         $produk =  DB::table('products')
                     ->join('categories', 'categories.id', '=', 'products.id_kategori')
                     ->select('products.*', 'categories.nama as kategori')
                     ->get();
         echo json_encode($produk);
      }
   }

   public function editProduk($id)
   {
      $produk = Product::find($id);
      echo json_encode($produk);
   }

   public function showProduk($id)
   {
      $produk = Product::find($id);
      echo json_encode($produk);
   }

   public function updateProduk(Request $request, $id)
   {
      if($request->hasFile('image')) {
         $request->validate([
            'kategori'        => 'required|numeric',
            'nama'            => 'required|max:255',
            'deskripsi'       => 'required|max:255',
            'harga'           => 'required|numeric',
            'stok'            => 'required|numeric',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar = $request->image->getClientOriginalName();
         $request->image->move('owner/images/produk/', $namaGambar);
         //---------------------------
         $produk = Product::find($id);
         $produk->id_kategori = $request->kategori;
         $produk->nama        = $request->nama;
         $produk->deskripsi   = $request->deskripsi;
         $produk->harga       = $request->harga;
         $produk->stock       = $request->stok;
         $produk->image       = $namaGambar;
         $produk->save();
         return redirect('/owner/produk')->with('success', 'Data produk berhasil diperbarui');
      } else {
         $request->validate([
            'kategori'        => 'required|numeric',
            'nama'            => 'required|max:255',
            'harga'           => 'required|numeric',
            'stok'            => 'required|numeric'
         ]);
         $produk = Product::find($id);
         $produk->id_kategori = $request->kategori;
         $produk->nama        = $request->nama;
         $produk->deskripsi   = $request->deskripsi;
         $produk->harga       = $request->harga;
         $produk->stock       = $request->stok;
         $produk->save();
         return redirect('/owner/produk')->with('success', 'Data produk berhasil diperbarui');
      }
   }

   public function storeProduk(Request $request)
   {
      if($request->image && $request->hasFile('image')) {
         $request->validate([
            'kategori'        => 'required|numeric',
            'nama'            => 'required|max:255',
            'deskripsi'       => 'required|max:255',
            'harga'           => 'required|numeric',
            'stok'            => 'required|numeric',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar = $request->image->getClientOriginalName();
         $request->image->move('owner/images/produk/', $namaGambar);
         //---------------------------
         $produk = new Product;
         $produk->id_kategori = $request->kategori;
         $produk->nama        = $request->nama;
         $produk->deskripsi   = $request->deskripsi;
         $produk->harga       = $request->harga;
         $produk->stock       = $request->stok;
         $produk->image       = $namaGambar;
         $produk->save();
         return redirect('/owner/produk')->with('success', 'Data produk berhasil ditambahkan');
      } else {
         return redirect('/owner/produk')->with('fail', 'Data gambar wajib dimasukan!');
      }
   }

   public function destroyProduk($id)
   {
      $produk = Product::find($id);
      $produk->delete();
      return redirect('/owner/produk')->with('success', 'Data berhasil dihapus');
   }


   // ------------------------------------------------ kategori
   public function indexKategori()
   {
     $kategori = Category::where('type',0)->orderByDesc('created_at')->paginate(10);
     return view('owner_view.kategori', ['kategori' => $kategori]);
   }

   public function searchKategori($nama)
   {
      if($nama != "zero") {
         $kategori = DB::table('categories')
                     ->where('categories.nama','like', $nama."%")
                     ->get();
         echo json_encode($kategori);
      } else {
         $kategori = Category::all();
         echo json_encode($kategori);
      }
   }

   public function storeKategori(Request $request)
   {
      $request->validate([
         'nama'     => 'required|max:255'
      ]);
      $kategori = new Category;
      $kategori->nama = $request->nama;
      $kategori->type = 0;
      $kategori->save();
      return redirect('/owner/kategori')->with('success', 'Data kategori berhasil ditambahkan');
   }

   public function editKategori($id)
   {
      $kategori = Category::find($id);
      echo json_encode($kategori);
   }

   public function updateKategori(Request $request, $id)
   {
      $request->validate([
         'nama'     => 'required|max:255'
      ]);
      $kategori = Category::find($id);
      $kategori->nama = $request->nama;
      $kategori->save();
      return redirect('/owner/kategori')->with('success', 'Data berhasil diperbarui');
   }

   public function destroyKategori($id)
   {
      $kategori = Category::find($id);
      $kategori->delete();
      return redirect('/owner/kategori')->with('success', 'Data berhasil dihapus');
   }


   // ------------------------------------------------ perusahaan

   public function indexPerusahaan()
   {
     $perusahaan = Company::all()->first();
     return view('owner_view.perusahaan', ['perusahaan' => $perusahaan]);
   }

   public function updatePerusahaan(Request $request)
   {
      if($request->nama) {
         $request->validate([
            'nama'         => 'required|max:255'
         ]);
         $perusahaan = Company::find(1);
         $perusahaan->nama = $request->nama;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data nama berhasil diperbarui');
      }  elseif($request->alamat) {
         $request->validate([
            'alamat'         => 'required|max:255'
         ]);
         $perusahaan = Company::find(1);
         $perusahaan->alamat = $request->alamat;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data alamat berhasil diperbarui');
      }  elseif($request->email) {
         $request->validate([
            'email'         => 'required|email|max:255'
         ]);
         $perusahaan = Company::find(1);
         $perusahaan->email = $request->email;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data email berhasil diperbarui');
      }  elseif($request->nomor) {
         $request->validate([
            'nomor'         => 'required|min:11|max:16'
         ]);
         $perusahaan = Company::find(1);
         $perusahaan->nomor = $request->nomor;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data nomor berhasil diperbarui');
      }  elseif($request->open_at && $request->closed_at) {
         $request->validate([
            'open_at'         => 'required',
            'closed_at'         => 'required'
         ]);
         $perusahaan = Company::find(1);
         $perusahaan->open_at = $request->open_at;
         $perusahaan->closed_at = $request->closed_at;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data pukul operasi berhasil diperbarui');
      }  elseif($request->hasFile('image') && $request->image) {
         $request->validate([
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar = $request->image->getClientOriginalName();
         $request->image->move('owner/images', $namaGambar);
         //---------------------------
         $perusahaan = Company::find(1);
         $perusahaan->logo = $namaGambar;
         $perusahaan->save();
         return redirect('/owner/perusahaan')->with('success', 'Data gambar berhasil diperbarui');
      }  else {
         return redirect('/owner/perusahaan');
      }
   }

   // ------------------------------------------------ owner

   public function indexOwner()
   {
      $owner = User::all()->where('name', '=', 'owner')->first();
      return view('owner_view.profile', ['owner' => $owner]);
   }

   public function updateOwner(Request $request)
   {
      if($request->username) {
         $request->validate([
            'username'         => 'required|max:255'
         ]);
         DB::table('users')->where('name', '=', 'owner')->update(['username' => $request->username]);
         return redirect('/owner/profile')->with('success', 'Data username berhasil diperbarui');
      }  elseif($request->hasFile('image') && $request->image) {
         $request->validate([
            'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
         ]);
         $namaGambar =$request->image->getClientOriginalName();
         $request->image->move('owner/images', $namaGambar);
         //---------------------------
         DB::table('users')->where('name', '=', 'owner')->update(['image' => $namaGambar]);
         return redirect('/owner/profile')->with('success', 'Data gambar berhasil diperbarui');
      }  else {
         return redirect('/owner/profile');
      }
   }

   public function updatePassword(Request $request)
   {
      $pass1 = $request->pass1;
      $user = User::all()->where('name', '=', 'owner')->first();
      // cek password lama
      if (Hash::check($pass1, $user->password)) {
         $request->validate([
            'pass2'         => 'required|min:4|max:40'
         ]);
         $newPassword = Hash::make($request->pass2);
         DB::table('users')->where('name', '=', 'owner')->update(['password' => $newPassword]);
         return redirect('/owner/profile')->with('success', 'Password berhasil diperbarui');
      } else {
         return redirect('/owner/profile')->with('fail', 'Pastikan password lama yang dimasukan benar');
      }
   }

}
