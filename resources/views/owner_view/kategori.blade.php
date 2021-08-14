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

   <li class="nav-item active">
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
         <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
      </div>

      <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i></span>
         </div>
         <input id="cariKategori" type="text" class="form-control" placeholder="Cari kategori" aria-label="Username" aria-describedby="basic-addon1">
      </div>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalKategori">
         Tambah Kategori
      </button>


      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
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

      <!-- Content Row -->
      <div class="row mb-5">
         <div class="col-md-12">
            <div class="card shadow-sm mb-4 border-left-info">
               <div class="card-body">
                  <div class="table-responsive-md">
                     <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="tBodyKategori">
                           @foreach ($kategori as $ktg)
                           <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $ktg->nama }}</td>
                              <td>
                                 <button type="button" class="btn btn-sm btn-warning bEditKategori" data-toggle="modal" data-target="#modalEdit" value="{{ $ktg->id }}">Edit</button>
                                 <a href="{{ url('/owner/kategori/destroy/'.$ktg->id) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus kategori ini?')">Hapus</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  {{ $kategori->links() }}
               </div>
            </div>

         </div>
      </div>


      <!-- modal tambah kategori -->
      <div class="modal fade" id="modalKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form action="{{ url('/owner/kategori/store') }}" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="namaKategori">Masukan nama kategori baru</label>
                     <input type="text" name="nama" id="namaKategori" class="form-control" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal edit kategori -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="formEdit" method="post">
                  @csrf
                  <div class="form-group">
                     <label for="ubahKategori">Ubah nama kategori baru</label>
                     <input type="text" name="nama" id="ubahKategori" class="form-control" autocomplete="off" required>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

   </div>
@endsection

@section('custom-script')
<script>
    $(document).ready(function(){

      $("#tBodyKategori").on("click", "button.bEditKategori", function(){
         const nilai = $(this).val();
         $.get("{{ url('') }}/owner/kategori/edit/"+nilai, function(response) {
            const data = JSON.parse(response);
            $("#ubahKategori").val(data.nama);
            $('#formEdit').attr('action', `{{ url('/owner/kategori/update/${nilai}') }}`);
         });
      });

      $("#cariKategori").keyup(function(){
         const nilai = $(this).val();
         if(nilai) {
            $.get("{{ url('') }}/owner/kategori/search/"+nilai, function(response) {
               const data = JSON.parse(response);
               let output;
               $("#tBodyKategori").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>
                        <button type="button" class="btn btn-sm btn-warning bEditKategori" data-toggle="modal" data-target="#modalEdit" value="${data.id}">Edit</button>
                        <a href="{{ url('/owner/kategori/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus kategori ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyKategori").append(output);

            });

         } else {
            $.get("{{ url('') }}/owner/kategori/search/zero", function(response) {
               const data = JSON.parse(response);
               let output;
               $("#tBodyKategori").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>
                        <button type="button" class="btn btn-sm btn-warning bEditKategori" data-toggle="modal" data-target="#modalEdit" value="${data.id}">Edit</button>
                        <a href="{{ url('/owner/kategori/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus kategori ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyKategori").append(output);
            });
         }
      });

    });
</script>
@endsection
