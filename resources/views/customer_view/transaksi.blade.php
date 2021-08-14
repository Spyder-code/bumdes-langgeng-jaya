@extends('layouts.customer')

@section('meta')
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('belanja/'.$item->id) }}">
    <meta property="og:title" content="{{ $item->nama }}">
    <meta property="og:description" content="{{ $perusahaan->nama }} | {{ $item->nama }}">
    <meta property="og:image" content="{{ asset('owner/images/produk/'.$item->image) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('belanja/'.$item->id) }}">
    <meta property="twitter:title" content="{{ $item->nama }}">
    <meta property="twitter:description" content="{{ $perusahaan->nama }} | {{ $item->nama }}">
    <meta property="twitter:image" content="{{ asset('owner/images/produk/'.$item->image) }}">
@endsection

@section('navbar')
<ul>
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li><a href="{{url('/read-article')}}">Article</a></li>
    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')
@if (session('danger'))
<div class="alert alert-danger alert-dismissible fade show mt-3 mr-5 ml-5" role="alert">
   {{ session('danger') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<section class="product-details">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large img-fluid"
                            src="{{asset('owner/images/produk/'.$item->image)}}" style="max-height: 400px; max-width:200px" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{$item->nama}}</h3>
                    <div class="d-inline">
                        <div class="product__details__price">Rp. {{number_format($item->harga)}}</div>
                        <h6 class="mb-3"><b>Persediaan: {{$item->stock}}</b></h6>
                    </div>

                    <p>{{$item->deskripsi}}</p>
                    @php
                        $phone = $perusahaan->nomor;
                        if(substr(trim($phone), 0, 1)=='0'){
                            $phone= '62'.substr(trim($phone), 1);
                        }
                    @endphp
                    <a href="https://wa.me/{{ $phone }}?text=Saya mau tanya tentang produk {{$item->nama}}%0A{{ url('belanja/'.$item->id) }}" target="_blank" class="primary-btn mb-3">Beli produk</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
