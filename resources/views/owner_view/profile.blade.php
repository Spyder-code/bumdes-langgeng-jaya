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
   <li class="nav-item active">
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
        <h1 class="h3 mb-0 text-gray-800">Profil Owner</h1>
      </div>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
         {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if (session('fail'))
      <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
         {{ session('fail') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @error('username')
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
      @error('password')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror


      <!-- Content Row -->
      <div class="row mb-5">
         <div class="col-md-5">
            @if ($owner->image == "")
            <img src="{{ asset('owner/images/micel.jpg') }}" alt="avatar" class="img-fluid">
            @else
            <img src="{{ asset('owner/images/'.$owner->image) }}" alt="avatar" class="img-fluid">
            @endif
            <button type="button" class="btn btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalGambar">
               Edit Gambar
            </button>
         </div>
         <div class="col-md-7">
            <div class="card border-left-primary shadow-sm py-2 mb-3">
               <div class="card-body">
                 <div class="row no-gutters align-items-center">
                   <div class="col mr-2">
                     <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><h6>Username</h6></div>
                     <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $owner->username }}</div>
                   </div>
                   <div class="col-auto">
                     <button type="button" class="btn btn-primary float-right mt-3 mb-3" data-toggle="modal" data-target="#modalUsername">
                        Edit Username
                     </button>
                   </div>
                 </div>
               </div>
            </div>
            <div class="card border-left-info shadow-sm py-2">
               <div class="card-body">
                  <div class="row mx-auto">
                     <div class="col-md-12">
                        <h4 class="font-weight-bold">Ganti Password</h4>
                        <form action="{{ url('/owner/profile/updatepassword') }}" method="post">
                           @csrf
                           <div class="row mt-3">
                              <div class="col-md-6 form-group">
                                 <label for="pass1">Password Lama</label>
                                 <input id="pass1" type="password" name="pass1" class="form-control" placeholder="masukan password lama" required>
                               </div>
                               <div class="col-md-6 form-group">
                                 <label for="pass2">Password Baru</label>
                                 <input id="pass2" type="password" name="pass2" class="form-control" placeholder="password baru min. 4 karakter" required>
                               </div>

                            </div>
                            <button type="submit" class="btn btn-primary float-right">Ubah</button>
                        </form>


                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

    </div>
    <!-- /.container-fluid -->


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
            <form action="{{ url('/owner/profile/update') }}" method="post" enctype="multipart/form-data">
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
               <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
         </div>
      </div>
      </div>
   </div>

   <!-- modal username -->
   <div class="modal fade" id="modalUsername" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Username</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{ url('/owner/profile/update') }}" method="post">
               @csrf
               <div class="form-group">
                  <label for="username">Masukan Username Baru</label>
                  <input type="text" id="username" name="username" class="form-control" autocomplete="off" required>
               </div>
               <button type="submit" class="btn btn-primary float-right">Submit</button>
            </form>
         </div>
      </div>
      </div>
   </div>

  </div>
  <!-- End of Main Content -->
@endsection
