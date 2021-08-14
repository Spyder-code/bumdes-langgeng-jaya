@extends('layouts.customer')

@section('navbar')
<ul>
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li class="active"><a href="{{url('/read-article')}}">Article</a></li>
    <li><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Artikel List</h4>
                            <ul>
                            <li><a href="{{url('read-article')}}">All</a></li>
                            @foreach ($data as $item)
                            <li><a href="{{url('read-article/'.$item->id)}}">{{$item->title}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h3><span>{{ $data->count() }}</span> Artikel ditemukan</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($data as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="{{ asset($item->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->title }}</h5>
                                    <div class="card-text">{!! Str::limit($item->content, 50, '...') !!}</div>
                                    <a href="{{ url('read-article/'.$item->id) }}" class="btn btn-primary">Read</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

