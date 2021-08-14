@extends('layouts.customer')

@section('navbar')
<ul>
    <li><a href="{{ url('/') }}">Beranda</a></li>
    <li><a href="{{url('toko')}}">Toko</a></li>
    <li><a href="{{url('/read-article')}}">Article</a></li>
    <li class="active"><a href="{{ url('/tentang-kami') }}">Tentang Kami</a></li>
</ul>
@endsection

@section('content')
   @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show mt-3 mr-5 ml-5" role="alert">
         {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      </div>
   @endif
   @error('nama')
      <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
         {{ $message }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      </div>
   @enderror
   @error('email')
      <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
         {{ $message }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      </div>
   @enderror
   @error('pesan')
      <div class="alert alert-warning alert-dismissible fade show mt-1" role="alert">
         {{ $message }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      </div>
   @enderror

   <!-- Contact Section Begin -->
   <section class="contact spad">
      <div class="container">
         <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact__widget">
                     <span class="icon_phone"></span>
                     <h4>Telephone</h4>
                     <p>{{ $perusahaan->nomor }}</p>
                  </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact__widget">
                     <span class="icon_pin_alt"></span>
                     <h4>Alamat</h4>
                     <p>{{ $perusahaan->alamat }}</p>
                  </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact__widget">
                     <span class="icon_clock_alt"></span>
                     <h4>Buka Jam</h4>
                     <p>{{ $perusahaan->open_at }} am to {{ $perusahaan->closed_at }} pm</p>
                  </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                  <div class="contact__widget">
                     <span class="icon_mail_alt"></span>
                     <h4>Email</h4>
                     <p>{{ $perusahaan->email }}</p>
                  </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Contact Section End -->

   <!-- Map Begin -->
   <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1176.3874451876254!2d112.80641519005985!3d-7.367351789939783!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7e561a6fecf09%3A0xcd0982843b670ec6!2sJl.%20Dadapan%20I%2C%20Segoro%20Tambak%2C%20Kec.%20Sedati%2C%20Kabupaten%20Sidoarjo%2C%20Jawa%20Timur%2061253!5e0!3m2!1sid!2sid!4v1628902143454!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      <div class="map-inside">
         <i class="icon_pin"></i>
         <div class="inside-widget">
            <h4>Sidoarjo</h4>
            <ul>
                  <li>{{ $perusahaan->nama }}</li>
                  <li>{{ $perusahaan->alamat }}</li>
            </ul>
         </div>
      </div>
   </div>
   <!-- Map End -->

   <!-- Contact Form Begin -->
   <div class="contact-form spad">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
                  <div class="contact__form__title">
                     <h2>Tinggalkan Pesan</h2>
                  </div>
            </div>
         </div>
         <form action="{{ url('/customer/store/pesan') }}" method="post">
            @csrf
            <div class="row">
                  <div class="col-lg-6 col-md-6">
                     <input type="text" name="nama" placeholder="Nama Anda" required>
                  </div>
                  <div class="col-lg-6 col-md-6">
                     <input type="email" name="email" placeholder="Email Anda" required>
                  </div>
                  <div class="col-lg-12 text-center">
                     <textarea name="pesan" placeholder="Pesan Anda" required></textarea>
                     <button type="submit" class="site-btn">Kirim Pesan</button>
                  </div>
               </div>
         </form>
      </div>
   </div>
   <!-- Contact Form End -->
@endsection
