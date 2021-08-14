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

   <li class="nav-item active">
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
         <h1 class="h3 mb-0 text-gray-800">Transaksi</h1>
      </div>

      <div class="input-group mb-3">
         <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"> <i class="fas fa-scroll"></i></span>
         </div>
         <input id="cariTransaksi" type="text" class="form-control" placeholder="Cari transaksi berdasarkan nama">
      </div>

      @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
         {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      @if (session('fail'))
      <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
         {{ session('fail') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif

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
                              <th scope="col">Tanggal</th>
                              <th scope="col">Status</th>
                              <th scope="col">Aksi</th>
                              </tr>
                           </thead>
                           <tbody id="tBodyTransaksi">
                              @foreach ($transaksi as $tr)
                              <tr>
                                 <th scope="row">{{ $loop->iteration }}</th>
                                 <td>{{ $tr->nama }}</td>
                                 <td>{{ date('d F Y', strtotime($tr->created_at)) }}</td>
                                 <td>
                                    @if ($tr->status==0)
                                        <i class="fas fa-hourglass-half text-warning"> Pending</i>
                                    @else
                                        <i class="fas fa-check text-success"> Success</i>
                                    @endif
                                 </td>
                                 <td>
                                    <a href="{{ url('/owner/detail-transaksi/'.$tr->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                    @if ($tr->status==0)
                                       <a href="{{ url('/owner/ganti-status/'.$tr->id) }}" class="btn btn-sm btn-secondary" onclick="return confirm('apakah kamu yakin mengganti status {{ $tr->nama }} ini?')">Ganti status</a>
                                    @else
                                       <button class="btn btn-sm btn-secondary" disabled>Ganti status</button>
                                    @endif
                                    <a href="{{ url('/owner/transaksi/destroy/'.$tr->id) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus transaksi {{ $tr->nama }} ini?')">Hapus</a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                     {{ $transaksi->links() }}
                </div>
            </div>
         </div>
      </div>
   </div>
@endsection

@section('custom-script')
<script>
   $(document).ready(function() {

      // cari transaksi
      $("#cariTransaksi").keyup(function() {
         const nilai =  $(this).val();
         if(nilai) {
            $.get("{{ url('') }}/owner/transaksi/search/"+nilai, function(response) {
               const data = JSON.parse(response);
               let bStatus = '';
               let bChangeStatus = '';
               let output = '';
               $("#tBodyTransaksi").empty();
               data.map((data, index) => {
                  if(data.status == 0) {
                     bStatus = "<i class='fas fa-hourglass-half text-warning'> Pending</i>";
                     bChangeStatus = `<a href="{{ url('/owner/ganti-status/${data.id}') }}" class="btn btn-sm btn-secondary" onclick="return confirm('apakah kamu yakin mengganti status ${data.nama} ini?')">Ganti status</a>`;
                  } else {
                     bStatus = " <i class='fas fa-check text-success'> Success</i>";
                     bChangeStatus = `<button class="btn btn-sm btn-secondary" disabled>Ganti status</button>`;
                  }
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>{{ date('d F Y', strtotime('${data.created_at}')) }}</td>
                     <td>
                        ${bStatus}
                     </td>
                     <td>
                        <a href="{{ url('/owner/detail-transaksi/${data.id}') }}" class="btn btn-sm btn-primary">Detail</a>
                        ${bChangeStatus}
                        <a href="{{ url('/owner/transaksi/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus transaksi ${data.nama} ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyTransaksi").append(output);
            });
         } else {
            $.get("{{ url('') }}/owner/transaksi/search/zero", function(response) {
               const data = JSON.parse(response);
               let bStatus = '';
               let bChangeStatus = '';
               let output = '';
               $("#tBodyTransaksi").empty();
               data.map((data, index) => {
                  if(data.status == 0) {
                     bStatus = "<i class='fas fa-hourglass-half text-warning'> Pending</i>";
                     bChangeStatus = `<a href="{{ url('/owner/ganti-status/${data.id}') }}" class="btn btn-sm btn-secondary" onclick="return confirm('apakah kamu yakin mengganti status ${data.nama} ini?')">Ganti status</a>`;
                  } else {
                     bStatus = " <i class='fas fa-check text-success'> Success</i>";
                     bChangeStatus = `<button class="btn btn-sm btn-secondary" disabled>Ganti status</button>`;
                  }
                  output += `
                  <tr>
                     <th scope="row">${index+1}</th>
                     <td>${data.nama}</td>
                     <td>{{ date('d F Y', strtotime('${data.created_at}')) }}</td>
                     <td>
                        ${bStatus}
                     </td>
                     <td>
                        <a href="{{ url('/owner/detail-transaksi/${data.id}') }}" class="btn btn-sm btn-primary">Detail</a>
                        ${bChangeStatus}
                        <a href="{{ url('/owner/transaksi/destroy/${data.id}') }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('apakah kamu yakin menghapus transaksi ${data.nama} ini?')">Hapus</a>
                     </td>
                  </tr>`;
               })
               $("#tBodyTransaksi").append(output);
            });
         }
      });


   });
</script>
@endsection
