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

   <li class="nav-item active">
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
   <!-- Begin Page Content -->
   <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pesan</h1>
      </div>

      <!-- Content Row -->
      <div class="row mb-5">
         <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                  <div class="table-responsive-md">
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Email</th>
                          <th scope="col">Isi</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                         @foreach ($pesan as $ps)
                         <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ps->nama }}</td>
                            <td>{{ $ps->email }}</td>
                            <td>{{ $ps->isi }}</td>
                            <td>
                               <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to={{ $ps->email }}.com&tf=1" class="btn btn-sm btn-danger" target="_blank">Email</a>
                            </td>
                         </tr>
                         @endforeach
                      </tbody>
                   </table>
                  </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $pesan->links() }}
            </div>
         </div>
      </div>

   </div>
@endsection
