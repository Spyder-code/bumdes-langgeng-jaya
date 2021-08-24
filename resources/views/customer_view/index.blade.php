@extends('layouts.customer')

@section('navbar')
<ul>
    <li class="active"><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li><a href="{{url('/read-article')}}">Article</a></li>
    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')

   <div class="hero__item set-bg" data-setbg="{{ url('customer/img/banner.jpg') }}">
       {{-- <div class="hero__text ml-auto text-right mr-5">
           <span>Jual</span>
           <h3>Berbagai macam ikan segar,<br>Sayuran, Buah-buahan, <br>Empon-empon, Sembako, <br>Kebutuhan sehari-hari</h3>
           <p>Dan masih banyak yang lainya</p>
           <a href="{{url('toko/all')}}" class="primary-btn">Belanja Sekarang</a>
       </div> --}}
   </div>

   <!-- Categories Section Begin -->
   <section class="categories">
   <div class="container">
       <div class="row">
           <div class=" mx-auto mt-5 section-title">
               <h2>Produk Unggulan</h2>
           </div>
           <div class="categories__slider owl-carousel">
               @foreach ($produkIkan as $pi)
               <div class="col-lg-3">
                   <div class="categories__item set-bg"
                    data-setbg="{{ asset('owner/images/produk/'.$pi->image) }}"
                    style="background-image: url('{{ asset('owner/images/produk/'.$pi->image) }}');">
                       <h5><a href="{{url('belanja/'.$pi->id)}}">{{ $pi->nama }}</a></h5>
                   </div>
               </div>
               @endforeach
           </div>
       </div>
   </div>
   </section>
   <!-- Categories Section End -->

   <!-- Featured Section Begin -->
   <section class="featured spad mb-5">
   <div class="container">
       <div class="row">

       </div>
       <div id="produk-showcase" class="row featured__filter justify-content-center">
           @foreach ($produkIkanShowCase as $psc)
           <div class="col-lg-3 col-md-4 col-sm-6 mb-4 mix oranges fresh-meat">
               <div class="product__discount__item">
                   <div class="product__discount__item__pic set-bg"
                       data-setbg="{{ asset('owner/images/produk/'.$psc->image) }}"
                       style="background-image: url('{{ asset('owner/images/produk/'.$psc->image) }}');">
                       <ul class="product__item__pic__hover">
                           <li><a href="{{url('belanja/'.$psc->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                       </ul>
                   </div>
                   <div class="product__discount__item__text">
                       <h5><a href="#">{{ $psc->nama }}</a></h5>
                       <div class="product__item__price">Rp. {{ number_format($psc->harga) }}</div>
                   </div>
               </div>
           </div>
           @endforeach
        </div>
       <div class="row justify-content-center mt-3">
        {{ $produkIkanShowCase->links() }}
       </div>
   </div>
   </section>
   <!-- Featured Section End -->


@endsection
