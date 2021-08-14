@extends('layouts.customer')

@section('navbar')
<ul>
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li><a href="{{url('/read-article')}}">Article</a></li>
    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')
<section class="shoping-cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td class="shoping__cart__item">
                                    <img src="{{asset('owner/images/produk/'.$item->image)}}" style="width: 200px; height:110px">
                                    <h5>{{$item->nama}}</h5>
                                </td>
                                <td class="shoping__cart__price">Rp. {{number_format($item->harga)}}</td>
                                <td class="shoping__cart__quantity">
                                    <b>{{$item->jumlah}}</b>
                                </td>
                                <td class="shoping__cart__total total">
                                    Rp. {{ number_format($item->harga * $item->jumlah) }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <form action="{{url('deleteCart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$item->id}}">
                                        <button type="submit" class="icon_close btn-danger"></button>
                                    </form>
                                </td>
                            </tr>
                            {{session()->put('total',$a = $a + $item->harga * $item->jumlah)}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{url('toko/')}}" class="btn btn-primary float-right ">Lanjutkan Belanja</a>
                </div>
            </div>
            <div class="col-lg-6"></div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <ul>
                        <li><h5>Total Harga<span>Rp. {{ number_format(session()->get('total')) }}</span></h5></li>
                    </ul>
                    <a href="{{url('pembayaran')}}" class="primary-btn">Proses Pembayaran</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection
