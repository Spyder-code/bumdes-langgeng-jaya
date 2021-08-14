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

   <li class="nav-item active">
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
        <h1 class="h3 mb-0 text-gray-800">Profil Perusahaan</h1>
      </div>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
         {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @error('nama')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror
      @error('alamat')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror
      @error('nomor')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror
      @error('image')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror

      <!-- Content Row -->
      <div class="row mb-5">
         <div class="col-md-12">
            <div class="card shadow-sm mb-4 py-3 border-left-primary">
               <div class="card-body">
                  <div class="row pl-4 pr-4">
                     <div class="col-md-7">
                        <div class="col-auto">
                           <button type="button" class="btn btn-sm btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalNama">
                              Edit
                           </button>
                        </div>
                        <h4 class="font-weight-bold">Nama Perusahaan</h4>
                        <h6>{{ $perusahaan->nama }}</h6>
                        <hr>
                        <div class="col-auto">
                           <button type="button" class="btn btn-sm btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalAlamat">
                              Edit
                           </button>
                        </div>
                        <h4 class="font-weight-bold">Alamat</h4>
                        <h6>{{ $perusahaan->alamat }}</h6>
                        <hr>
                        <div class="col-auto">
                           <button type="button" class="btn btn-sm btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalEmail">
                              Edit
                           </button>
                        </div>
                        <h4 class="font-weight-bold">Email</h4>
                        <h6 class="mb-4">{{ $perusahaan->email }}</h6>
                        <hr>
                        <div class="col-auto">
                           <button type="button" class="btn btn-sm btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalNomor">
                              Edit
                           </button>
                        </div>
                        <h4 class="font-weight-bold">Nomor</h4>
                        <h6 class="mb-4">{{ $perusahaan->nomor }}</h6>
                        <hr>
                        <div class="col-auto">
                           <button type="button" class="btn btn-sm btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalOperasi">
                              Edit
                           </button>
                        </div>
                        <h4 class="font-weight-bold">Pukul Buka dan Tutup</h4>
                        <h6 class="mb-4">{{ $perusahaan->open_at }} - {{ $perusahaan->closed_at }}</h6>
                     </div>
                     <div class="col-md-5">
                        @if ($perusahaan->logo == "")
                        <img src="{{ asset('owner/images/micel.jpg') }}" alt="avatar" class="img-fluid">
                        @else
                        <img src="{{ asset('owner/images/'.$perusahaan->logo) }}" alt="avatar" class="img-fluid">
                        @endif
                        <button class="btn btn-primary mt-3 float-right" data-toggle="modal" data-target="#modalGambar">Edit Ikon</button>
                     </div>
                  </div>
               </div>
             </div>
         </div>
      </div>

      <!-- modal nama -->
      <div class="modal fade" id="modalNama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Nama Perusahaan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="namaPerusahaan">Masukan Nama Perusahaan Baru</label>
                     <input type="text" name="nama" id="namaPerusahaan" class="form-control" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal alamat -->
      <div class="modal fade" id="modalAlamat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Alamat Perusahaan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="alamatPerusahaan">Masukan Alamat Perusahaan Baru</label>
                     <textarea name="alamat" id="alamatPerusahaan" rows="7" class="form-control" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal email -->
      <div class="modal fade" id="modalEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Email Perusahaan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="emailPerusahaan">Masukan Email Perusahaan Baru</label>
                     <input type="email" name="email" id="emailPerusahaan" class="form-control" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal nomor -->
      <div class="modal fade" id="modalNomor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Nomor Perusahaan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="noPerusahaan">Masukan Nomor Perusahaan Baru</label>
                     <input type="number" name="nomor" id="noPerusahaan" class="form-control" min="0" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal operasi -->
      <div class="modal fade" id="modalOperasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Pukul Buka dan Tutup Perusahaan</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-6">
                           <label>Pukul Buka</label>
                           <input type="time" name="open_at" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                           <label>Pukul Buka</label>
                           <input type="time" name="closed_at" class="form-control" required>
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal gambar -->
      <div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Gambar</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/perusahaan/update') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <label for="gambarProfil">Masukan Gambar Profil Baru</label>
                  <input id="gambarProfil" type="file" name="image" onchange="loadFile(event)" required>
                  <div>
                     <img id="output" class="img-thumbnail mt-3" />
                  </div>
                  <script>
                  var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                        output.onload = function() {
                        URL.revokeObjectURL(output.src)
                        }
                  };
                  </script>
                  <button type="submit" class="btn btn-primary float-right mt-3">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>


   </div>
@endsection
