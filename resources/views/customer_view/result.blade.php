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
        <!-- Checkout Section Begin -->
        <section class="checkout mt-5">
            <div class="container">
                <div class="checkout__form">
                    <h1 class="text-center text-success">Terimakasih sudah berbelanja</h1>
                    <hr>
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="alert alert-success" role="alert">
                                  <h4 class="font-weight-normal pb-1">Pesanan anda sudah tercatat di database kami, silahkan kunjungi toko kami untuk mengambil barang dan melakukan pembayaran.</h4>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nama produk</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">sub Total</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <th scope="row">{{$loop->iteration}}</th>
                                                    <td>{{$item->namaProduk}}</td>
                                                    <td>{{ number_format($item->harga) }}</td>
                                                    <td>{{$item->jumlah}}</td>
                                                    <td>{{ number_format($item->jumlah*$item->harga) }}</td>
                                                  </tr>
                                                @endforeach
                                            </tbody>
                                          </table>
                                          <hr>
                                            <h2 class="float-right">Total harga: Rp. <span>{{ number_format($item->total_harga) }}</span></h2>
                                    </div>
                                </div>

        <section class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                        <div class="contact__widget">
                            <span class="icon_pin_alt"></span>
                            <h4>Alamat</h4>
                            <p>{{ $perusahaan->alamat }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                        <div class="contact__widget">
                            <span class="icon_clock_alt"></span>
                            <h4>Buka Jam</h4>
                            <p>{{ $perusahaan->open_at }} am to {{ $perusahaan->closed_at }} pm</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 text-center">
                        <div class="contact__widget">
                            <span class="icon_phone"></span>
                            <h4>Telefon</h4>
                            <p>{{ $perusahaan->nomor }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Contact Section End -->

                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Data Anda</h4>
                                    <ul>
                                        <li class="list-group-item font-weight-bold">Nama:<p>{{$dataPerson->nama}}</p></li>
                                        <li class="list-group-item font-weight-bold">Alamat:<p>{{$dataPerson->alamat}}</p></li>
                                        <li class="list-group-item font-weight-bold">Nomor:<p>{{$dataPerson->nomor}}</p></li>
                                        <li class="list-group-item font-weight-bold">Catatan:<p>{{$dataPerson->catatan}}</p></li>
                                    </ul>
                                    <hr>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
        <!-- Checkout Section End -->
@endsection
