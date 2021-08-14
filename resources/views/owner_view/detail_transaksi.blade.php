@extends('layouts.owner')

@section('sidebar')
   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/dashboard') }}">
       <i class="fas fa-fw fa-tachometer-alt"></i>
       <span>Dashboard</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
     Menu Utama
   </div>



   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/produk') }}">
       <i class="fas fa-cart-arrow-down"></i>
       <span>Produk</span></a>
   </li>

   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/kategori') }}">
       <i class="fas fa-list"></i>
       <span>Kategori</span></a>
   </li>

   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/pesan') }}">
       <i class="fas fa-file-import"></i>
       <span>Pesan</span></a>
   </li>

   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/transaksi') }}">
       <i class="fas fa-scroll"></i>
       <span>Transaksi</span></a>
   </li>

   <!-- Divider -->
   <hr class="sidebar-divider">

   <!-- Heading -->
   <div class="sidebar-heading">
     Menu Lainnya
   </div>

   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/perusahaan') }}">
       <i class="far fa-building"></i>
       <span>Perusahaan</span></a>
   </li>
   <li class="nav-item">
    <a class="nav-link" href="{{ route('article.index')}}">
      <i class="fas fa-book-open"></i>
      <span>Article</span></a>
  </li>
   <li class="nav-item">
     <a class="nav-link" href="{{ url('/owner/profile') }}">
       <i class="fas fa-user-cog"></i>
       <span>Owner</span></a>
   </li>
@endsection

@section('content')
   <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Detail Transaksi</h1>
      </div>

      <div class="row">
         <div class="col-md-4">
            <div class="card shadow-sm border-left-primary">
               <div class="card-body">
                  <h4 class="font-weight-bold">Nama</h4>
                     <h6>{{ $namaDanTotalHarga->nama }}</h6>
                     <hr>
                     <h4 class="font-weight-bold">Alamat</h4>
                     <h6>{{ $namaDanTotalHarga->alamat }}</h6>
                     <hr>
                     <h4 class="font-weight-bold">Nomor</h4>
                     <h6>{{ $namaDanTotalHarga->nomor }}</h6>
                     <hr>
                     <h4 class="font-weight-bold">Catatan</h4>
                     <h6>{{ $namaDanTotalHarga->catatan }}</h6>
               </div>
            </div>
         </div>
         <div class="col-md-8 mt-3">
            <div class="card shadow-sm">
               <div class="card-body">
                  <table class="table">
                     <thead class="thead-dark">
                       <tr>
                         <th scope="col">No.</th>
                         <th scope="col">Nama Produk</th>
                         <th scope="col">Jumlah</th>
                       </tr>
                     </thead>
                     <tbody>
                        @foreach ($produkDanJumlah as $pj)
                        <tr>
                           <th scope="row">{{ $loop->iteration }}</th>
                           <td>{{ $pj->namaproduk  }}</td>
                           <td>{{ $pj->jumlah }}</td>
                         </tr>
                         @endforeach
                     </tbody>
                  </table>
                  <div class="row mt-5">
                     <div class="col-md-6">
                        <h4 class="mx-auto pl-5">Total Harga:</h4>
                     </div>
                     <div class="col-md-6">
                        <h3 class="font-weight-bold pl-5">{{ $namaDanTotalHarga->total_harga }}</h3>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
      <a href="{{ url('owner/transaksi') }}" class="btn btn-secondary mt-5 mb-5">Kembali</a>


   </div>
@endsection
