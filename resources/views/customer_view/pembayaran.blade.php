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
    <section class="checkout">
        <div class="container">
            <div class="checkout__form">
                <h4>Detail Pembayaran</h4>
                <form action="{{url('pesan')}}" method="POST">
                    @csrf
                    <input type="hidden" name="totalHarga" value="{{session()->get('total')}}">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Nama Lengkap<span>*</span></p>
                                        <input type="text" name="nama">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Alamat Rumah<span>*</span></p>
                                <input type="text" name="alamat">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Telefon<span>*</span></p>
                                        <input type="number" name="nomor">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Catatan Pesanan</p>
                                <input type="text" name="catatan"
                                    placeholder="Catatan penting untuk pengantaran agar tidak salah">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Pesanan Anda</h4>
                                <div class="checkout__order__products">Produk <span>Total</span></div>
                                <ul>
                                    @foreach ($data as $item)
                                    <li>{{$item->nama}} <span>Rp. {{ number_format($item->harga) }}</span></li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__total">Total <span>Rp. {{ number_format(session()->get('total')) }}</span></div>
{{--
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        BCA
                                        <input type="checkbox" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        BRI
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        BNI
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Mandiri
                                        <input type="checkbox" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div> --}}
                                <button type="submit" class="site-btn">PESAN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@endsection
