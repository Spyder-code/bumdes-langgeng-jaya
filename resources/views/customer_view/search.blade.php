@extends('customer_view.toko')
@section('total',$total)
@section('produk')
    @foreach ($data as $item)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div class="product__item__pic set-bg" 
                data-setbg="{{asset('owner/images/produk/'.$item->image)}}" 
                style="background-image: url('{{ asset('owner/images/produk/'.$item->image) }}');">
                <ul class="product__item__pic__hover">
                    <li><a href="{{url('belanja/'.$item->id)}}"><i class="fa fa-shopping-cart"></i></a></li>
                </ul>
            </div>
            <div class="product__item__text">
                <h6><a href="#">{{$item->nama}}</a></h6>
                <h5>Rp. {{ number_format($item->harga) }}</h5>
            </div>
        </div>
    </div>
    @endforeach
@endsection
