@extends('layouts.error')

@section('navbar')
<ul>
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li><a href="{{url('/read-article')}}">Article</a></li>
    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-sm-12 text-center mt-5">
            <h1 text-success>Mohon maaf! halaman tidak ditemukan</h1>
            <a href="{{url('/')}}" class="site-btn mb-5 mt-5">Kembali ke Beranda</a>
        </div>
    </div>
</div>
@endsection
