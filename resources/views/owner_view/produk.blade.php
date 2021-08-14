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



   <li class="nav-item active">
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
         <h1 class="h3 mb-0 text-gray-800">Produk</h1>
      </div>

      <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-cart-arrow-down"></i></span>
         </div>
         <input id="cariProduk" type="text" class="form-control" placeholder="Cari produk berdasarkan (Nama/Kategori)" aria-label="Username" aria-describedby="basic-addon1">
      </div>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
         {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if (session('fail'))
      <div class="alert alert-warning alert-dismissible fade show mt-2" role="alert">
         {{ session('fail') }}
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
      @error('harga')
         <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
            {{ $message }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
         </button>
         </div>
      @enderror
      @error('stok')
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
         <div class="col-md-4">
            <div class="card shadow-sm mb-4 border-left-info">
               <div class="card-body">
                  <h5 class="font-weight-bold">Tambah Produk</h5>
                  <hr>
                  <form action="{{ url('/owner/produk/store') }}" method="post" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Produk" autocomplete="off" required>
                     </div>
                     <div class="form-group">
                        <label for="kategoriProduk1" class="font-weight-bold">Kategori</label>
                        <select name="kategori" id="kategoriProduk1" class="form-control" required>
                           @foreach ($kategori as $ktg)
                              <option value="{{ $ktg->id }}">{{ $ktg->nama }}</option>
                           @endforeach
                        </select>
                     </div>
                     <hr>
                     <div class="form-group">
                        <input type="number" name="harga" class="form-control" placeholder="Harga" min="0" required>
                     </div>
                     <div class="form-group">
                        <input type="number" name="stok" class="form-control" placeholder="Stok" min="0" required>
                     </div>
                     <div class="form-group">
                        <textarea name="deskripsi" class="form-control" cols="30" rows="5" placeholder="Deskripsi"></textarea>
                     </div>
                     <div class="form-group">
                        <label for="gambarProduk1" class="font-weight-bold">Gambar</label>
                        <div class="mb-3"><small class="text-danger">disarankan gambar berukuran persegi</small></div>
                        <input type="file" name="image" id="gambarProduk1" onchange="loadFile1(event)" required>
                        <img id="output1" class="img-thumbnail mt-3" />
                        <script>
                        var loadFile1 = function(event) {
                              var output1 = document.getElementById('output1');
                              output1.src = URL.createObjectURL(event.target.files[0]);
                              output1.onload = function() {
                              URL.revokeObjectURL(output1.src)
                              }
                        };
                        </script>
                     </div>
                     <button type="submit" class="btn btn-primary float-right">Submit</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                  <div class="table-responsive-md">
                     <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        <tbody id="tBodyProduk">
                           @foreach ($produk as $prd)
                           <tr>
                              <th scope="row">{{ $loop->iteration }}</th>
                              <td>{{ $prd->nama }}</td>
                              <td>{{ $prd->kategori }}</td>
                              <td>{{ $prd->harga }}</td>
                              <td>{{ $prd->stock }}</td>
                              <td>
                                <button type="button" class="btn btn-sm btn-primary bDetailGambar" data-toggle="modal" data-target="#modalDetailGambar" value="{{ $prd->id }}">Detail Produk</button>
                                <button type="button" class="btn btn-sm btn-warning bEditProduk" data-toggle="modal" data-target="#modalEdit" value="{{ $prd->id }}">Edit</button>
                                <a href="{{ url('/owner/produk/destroy/'.$prd->id) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk {{ $prd->nama }} ini?')">Hapus</a>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                </div>
            </div>
           <div class="mt-2">
            {{ $produk->links() }}
           </div>
         </div>
      </div>

      <!-- modal edit produk -->
      <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form id="formEdit" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                     <input id="editNama" type="text" name="nama" class="form-control" placeholder="Nama Produk" autocomplete="off" required>
                  </div>
                  <div class="form-group">
                     <label for="kategoriProduk2" class="font-weight-bold">Kategori</label>
                     <select name="kategori" id="kategoriProduk2" class="form-control" required>
                        @foreach ($kategori as $ktg)
                           <option value="{{ $ktg->id }}">{{ $ktg->nama }}</option>
                        @endforeach
                     </select>
                  </div>
                  <hr>
                  <div class="form-group">
                     <input id="editHarga" type="number" name="harga" class="form-control" placeholder="Harga" min="0" required>
                  </div>
                  <div class="form-group">
                     <input id="editStok" type="number" name="stok" class="form-control" placeholder="Stok" min="0" required>
                  </div>
                  <div class="form-group">
                    <textarea id="editDeskripsi" name="deskripsi" class="form-control" cols="30" rows="5" placeholder="Deskripsi"></textarea>
                 </div>
                  <div class="form-group">
                     <label for="gambarProduk2" class="font-weight-bold">Gambar (tidak wajib diisi apabila tidak di edit)</label>
                     <input type="file" name="image" id="gambarProduk2" onchange="loadFile2(event)">
                     <img id="output2" class="img-thumbnail mt-3" />
                     <script>
                     var loadFile2 = function(event) {
                           var output2 = document.getElementById('output2');
                           output2.src = URL.createObjectURL(event.target.files[0]);
                           output2.onload = function() {
                           URL.revokeObjectURL(output2.src)
                           }
                     };
                     </script>
                  </div>
                  <button type="submit" class="btn btn-primary float-right">Submit</button>
               </form>
            </div>
         </div>
         </div>
      </div>

      <!-- modal detail produk -->
      <div class="modal fade" id="modalDetailGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Detail Produk</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <h6 class="font-weight-bold">Deskripsi</h6>
               <p id="pDeskripsiProduk"></p>
               <h6 class="font-weight-bold">Gambar</h6>
               <img id="detailGambar" class="img-fluid">
            </div>
         </div>
         </div>
      </div>



   </div>
@endsection

@section('custom-script')
<script>
   $(document).ready(function() {

      $(".close").click(function() {
         $("#output2").attr('src', '');
         $("#gambarProduk2").attr('value', '');
      });

      // cari produk
      $("#cariProduk").keyup(function() {
         const nilai = $(this).val();
         if(nilai) {
            $.get("{{ url('') }}/owner/produk/search/"+nilai, function(response) {
               const data = JSON.parse(response);
               let output = '';
               $("#tBodyProduk").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>${data.kategori}</td>
                     <td>${data.harga}</td>
                     <td>${data.stock}</td>
                     <td>
                       <button type="button" class="btn btn-sm btn-primary bDetailGambar" data-toggle="modal" data-target="#modalDetailGambar" value="${data.id}">Detail Produk</button>
                       <button type="button" class="btn btn-sm btn-warning bEditProduk" data-toggle="modal" data-target="#modalEdit" value="${data.id}">Edit</button>
                       <a href="{{ url('/owner/produk/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk ${data.nama} ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyProduk").append(output);
            })
         } else {
            $.get("{{ url('') }}/owner/produk/search/zero", function(response) {
               const data = JSON.parse(response);
               let output;
               $("#tBodyProduk").empty();
               data.map((data, index) => {
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>${data.kategori}</td>
                     <td>${data.harga}</td>
                     <td>${data.stock}</td>
                     <td>
                       <button type="button" class="btn btn-sm btn-primary bDetailGambar" data-toggle="modal" data-target="#modalDetailGambar" value="${data.id}">Detail Produk</button>
                       <button type="button" class="btn btn-sm btn-warning bEditProduk" data-toggle="modal" data-target="#modalEdit" value="${data.id}">Edit</button>
                       <a href="{{ url('/owner/produk/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus produk ${data.nama} ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyProduk").append(output);
            });
         }
      });

      // detail gambar
      $("#tBodyProduk").on("click", "button.bDetailGambar", function() {
         const nilai = $(this).val();
         $.get("{{ url('') }}/owner/produk/show/"+nilai, function(response) {
            const data = JSON.parse(response);
            $("#detailGambar").attr('src', `{{ asset('owner/images/produk/${data.image}') }}`);
            $("#pDeskripsiProduk").text(data.deskripsi)
         });
      });

      // edit produk
      $("#tBodyProduk").on("click", "button.bEditProduk", function() {
         const nilai = $(this).val();
         $.get("{{ url('') }}/owner/produk/edit/"+nilai, function(response) {
            const data = JSON.parse(response);
            $("#editNama").val(data.nama);
            $("#editHarga").val(data.harga);
            $("#editDeskripsi").val(data.deskripsi);
            $("#editStok").val(data.stock);
            $('#formEdit').attr('action', `{{ url('/owner/produk/update/${nilai}') }}`);
         });
      });

   });
</script>
@endsection
