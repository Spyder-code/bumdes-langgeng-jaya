@extends('layouts.owner')

@section('sidebar')
   <!-- Divider -->
   <hr class="sidebar-divider my-0">

   <!-- Nav Item - Dashboard -->
   <li class="nav-item active">
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
   <!-- Begin Page Content -->
   <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Main Dashboard</h1>
      </div>

      <!-- Content Row -->
      <div class="row justify-content-center">

         <!-- Produk terjual -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Produk Terjual</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahProduk }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-cart-arrow-down fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

         <!-- Jumlah pembeli -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jumlah Pembeli</div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $jumlahPembeli }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-check fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

       <!-- Jumlah pengunjung -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Jumlah Pengunjung</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlahPengunjung }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Content Row -->

      <div class="row mb-4">

        <!-- Area Chart -->
        <div class="col-md-12">
          <div class="card shadow mb-4 pb-md-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Grafik Jumlah Pengunjung</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
               <div class="chart-area">
                  <canvas id="myChart" max-width="200" height="110"></canvas>
               </div>
            </div>
          </div>
        </div>



      </div>



    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->
@endsection

@section('custom-script')
<script>
    $(document).ready(function() {

      const arrayTotalVisitor = [];
            monthVisitor = [];

      let monthJan = 0;
      let monthFeb = 0;
      let monthMar = 0;
      let monthApr = 0;
      let monthMay = 0;
      let monthJun = 0;
      let monthJul = 0;
      let monthAug = 0;
      let monthSep = 0;
      let monthOct = 0;
      let monthNov = 0;
      let monthDec = 0;

      $.get( "{{ url('owner/dashboard/show') }}", function(response) {
        const data = JSON.parse(response);
        const currentYear = new Date().getFullYear();
        data.map((data) => {
            const jsDate = new Date(data.created_at).toString();
            let splited = jsDate.split(" ");
            if(splited[3] == currentYear){

               if(splited[1] == "Jan") {
                  monthJan += 1;
                  if(monthVisitor.includes("Jan") != true){
                     monthVisitor.push("Jan");
                  }

               } else if(splited[1] == "Feb") {
                  monthFeb += 1;
                  if(monthVisitor.includes("Feb") != true){
                     monthVisitor.push("Feb");
                  }

               } else if(splited[1] == "Mar") {
                  monthMar += 1;
                  if(monthVisitor.includes("Mar") != true){
                     monthVisitor.push("Mar");
                  }

               } else if(splited[1] == "Apr") {
                  monthApr += 1;
                  if(monthVisitor.includes("Apr") != true){
                     monthVisitor.push("Apr");
                  }

               } else if(splited[1] == "May") {
                  monthMay += 1;
                  if(monthVisitor.includes("May") != true){
                     monthVisitor.push("May");
                  }

               } else if(splited[1] == "Jun") {
                  monthJun += 1;
                  if(monthVisitor.includes("Jun") != true){
                     monthVisitor.push("Jun");
                  }

               } else if(splited[1] == "Jul") {
                  monthJul += 1;
                  if(monthVisitor.includes("Jul") != true){
                     monthVisitor.push("Jul");
                  }

               } else if(splited[1] == "Aug") {
                  monthAug += 1;
                  if(monthVisitor.includes("Aug") != true){
                     monthVisitor.push("Aug");
                  }

               } else if(splited[1] == "Sep") {
                  monthSep += 1;
                  if(monthVisitor.includes("Sep") != true){
                     monthVisitor.push("Sep");
                  }

               } else if(splited[1] == "Oct") {
                  monthOct += 1;
                  if(monthVisitor.includes("Oct") != true){
                     monthVisitor.push("Oct");
                  }

               } else if(splited[1] == "Nov") {
                  monthNov += 1;
                  if(monthVisitor.includes("Nov") != true){
                     monthVisitor.push("Nov");
                  }

               } else if(splited[1] == "Dec") {
                  monthDec += 1;
                  if(monthVisitor.includes("Dec") != true){
                     monthVisitor.push("Dec");
                  }
               }
            }
        })


         if(monthJan != 0){
            arrayTotalVisitor.push(monthJan);
         }

         if(monthFeb != 0){
            arrayTotalVisitor.push(monthFeb);
         }

         if(monthMar != 0){
            arrayTotalVisitor.push(monthMar);
         }

         if(monthApr != 0){
            arrayTotalVisitor.push(monthApr);
         }

         if(monthMay != 0){
            arrayTotalVisitor.push(monthMay);
         }

         if(monthJun != 0){
            arrayTotalVisitor.push(monthJun);
         }

         if(monthJul != 0){
            arrayTotalVisitor.push(monthJul);
         }

         if(monthAug != 0){
            arrayTotalVisitor.push(monthAug);
         }

         if(monthSep != 0){
            arrayTotalVisitor.push(monthSep);
         }

         if(monthOct != 0){
            arrayTotalVisitor.push(monthOct);
         }

         if(monthNov != 0){
            arrayTotalVisitor.push(monthNov);
         }

         if(monthDec != 0){
            arrayTotalVisitor.push(monthDec);
         }

         var ctx = document.getElementById('myChart');
         var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: monthVisitor,
               datasets: [{
                     label: {{ $jumlahPengunjung }} ,
                     data: arrayTotalVisitor,
                     backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                     ],
                     borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                     ],
                     borderWidth: 1
               }]
            },
            options: {
               scales: {
                     yAxes: [{
                        ticks: {
                           beginAtZero: true
                        }
                     }]
               }
            }
         });

      });
    });
</script>
@endsection
