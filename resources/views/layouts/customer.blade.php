<!DOCTYPE html>
<html lang="zxx">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Merupakan website yg menyediakan berbagai keperluan produk sehari-hari seperti ikan, sayuran, makanan, minuman, dll.">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   @yield('meta')
   @php( $perusahaan = \App\Company::first())
   <title>{{ $perusahaan->nama }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="icon" href="{{ asset('owner/images/'.$perusahaan->logo) }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customer/css/style1.css') }}">
</head>

<body>
   <!-- Humberger Begin -->
   <div class="humberger__menu__overlay"></div>
   <div class="humberger__menu__wrapper">
       <div class="humberger__menu__logo">
           <a href="{{ url('/') }}"><img src="{{ asset('owner/images/'.$perusahaan->logo) }}"></a>
       </div>
       <div class="humberger__menu__cart">
           <ul>
               <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>{{session()->get('total')}}</span></a></li>
           </ul>
           <div class="header__cart__price">total: <span>Rp. {{ number_format(session()->get('total')) }}</span></div>
       </div>
       <nav class="humberger__menu__nav mobile-menu">
           <ul>
               <li class="active"><a href="{{ url('/') }}">Beranda</a></li>
               <li><a href="{{ url('toko') }}">Toko</a></li>
               {{-- <li><a href="{{ url('pembayaran') }}">Pembayaran</a></li> --}}
               <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
           </ul>
       </nav>
       <div id="mobile-menu-wrap"></div>
       <div class="humberger__menu__contact">
           <ul>
               <li><i class="fa fa-envelope"></i> {{ $perusahaan->email }}</li>
           </ul>
       </div>
   </div>
   <!-- Humberger End -->

          <!-- Header Section Begin -->
   <header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                     <a href="{{ url('/') }}"><img src="{{ asset('owner/images/'.$perusahaan->logo) }}" class="img-fluid" style="height: 100px;"></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <!-- navbar section -->
                     @yield('navbar')
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
                     <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>{{session()->get('cartTotal')}}</span></a></li>
                    </ul>
                    <div class="header__cart__price">total: <span>Rp. {{ number_format(session()->get('total')) }}</span></div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
<!-- Header Section End -->

<!-- Hero Section Begin -->
 <section class="hero hero-normal">
     <div class="container">
         <div class="row">
             <div class="col-lg-3">
                 <div class="hero__categories">
                     <div class="hero__categories__all">
                         <i class="fa fa-bars"></i>
                         <span>Semua Kategori</span>
                     </div>
                     <ul>
                         @foreach ($katalog as $item)
                         <li><a href="{{url('toko/'.$item->nama)}}">{{$item->nama}}</a></li>
                         @endforeach
                     </ul>
                 </div>
             </div>
             <div class="col-lg-9">
                 <div class="hero__search">
                     <div class="hero__search__form">
                         <form action="{{url('cari/')}}" method="get">
                             @csrf
                             {{-- <div class="hero__search__categories">
                                 Semua Produk
                                 <span class="arrow_carrot-down"></span>
                             </div> --}}
                             <input id="cariProdukCustomer" name="nama" type="text" autocomplete="off" placeholder="Cari produk">
                             <button type="submit" class="site-btn">Cari</button>
                         </form>
                     </div>
                     <div class="hero__search__phone">
                         <div class="hero__search__phone__icon">
                             <i class="mt-1 fa fa-2x fa-whatsapp"></i>
                         </div>
                         <div class="hero__search__phone__text">
                             <h5>{{ $perusahaan->nomor }}</h5>
                             <span>Hubungi Kami</span>
                         </div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </section>
    <!-- Hero Section End -->

   @yield('content')

   <!-- Footer Section Begin -->
   <footer class="footer spad">
       <div class="container">
           <div class="row">
               <div class="col-lg-3 col-md-6 col-sm-6">
                   <div class="footer__about">
                       <img src="{{ asset('owner/images/'.$perusahaan->logo) }}" style="max-width: 200px">
                   </div>
               </div>
               <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                   <div class="footer__widget">
                       <h6>Link Lainnya</h6>
                       <ul>
                           <li><a href="{{ url('/toko') }}">Toko</a></li>
                           <li><a href="{{ url('/read-article') }}">Artikel</a></li>
                           <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
                       </ul>

                   </div>
               </div>
               <div class="col-lg-4 col-md-12">
                   <div class="footer__widget">
                       <h6>Info Perusahaan</h6>
                       <ul>
                            <li><a>Alamat: {{ $perusahaan->alamat }}</a></li>
                            <li><a>Email: {{ $perusahaan->email }}</a></li>
                       </ul>
                   </div>
               </div>
           </div>
           <div class="row">
               <div class="col-lg-12">
                   <div class="footer__copyright">
                       <div class="footer__copyright__text"><p>
 Copyright &copy;<script>document.write(new Date().getFullYear());</script> {{ $perusahaan->nama }}</a></p></div>                    </div>
               </div>
           </div>
       </div>
   </footer>
   <!-- Footer Section End -->

   <!-- Js Plugins -->
   <script src="{{ asset('customer/js/jquery-3.3.1.min.js') }}"></script>
   <script src="{{ asset('customer/js/bootstrap.min.js') }}"></script>
   <script src="{{ asset('customer/js/jquery.nice-select.min.js') }}"></script>
   <script src="{{ asset('customer/js/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('customer/js/jquery.slicknav.js') }}"></script>
   <script src="{{ asset('customer/js/mixitup.min.js') }}"></script>
   <script src="{{ asset('customer/js/owl.carousel.min.js') }}"></script>
   <script src="{{ asset('customer/js/main.js') }}"></script>
   @yield('custom-script')

</body>

</html>
