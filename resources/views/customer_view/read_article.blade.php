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
                            <div class="col-lg-12 col-md-12">
                                <div class="filter__found">
                                    <h2>{{ $article->title }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <img class="card-img-top img-fluid" src="{{ asset($item->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <div class="px-5 mt-3">
                                        {!! $article->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

