@extends('layouts.app')

@section('title', 'SIPLS')

{{-- Aktifkan sidebar hanya di halaman ini --}}
@section('withSidebar', true)

@section('content')
<div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
  <div class="col">
    <div class="card h-100">
      <img src="{{ asset('assets/images/sipls1.jpg') }}" class="card-img-top" alt="Kalemdiklat Polri" />
      <div class="card-body">
        <h5 class="card-title">Kalemdiklat Polri</h5>
        <p class="card-text">
          Kalemdiklat Polri Akan Jadikan Semua Kampus di Lemdiklat Jadi Objek Vital Polri.
        </p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card h-100">
      <img src="{{ asset('assets/images/sipls2.jpg') }}" class="card-img-top" alt="Kasetukpa" />
      <div class="card-body">
        <h5 class="card-title">Kasetukpa</h5>
        <p class="card-text">
          Deretan Irjen Pol yang Bertugas di Lemdiklat Polri.
        </p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card h-100">
      <img src="{{ asset('assets/images/sipls3.jpg') }}" class="card-img-top" alt="Wakasetukpa" />
      <div class="card-body">
        <h5 class="card-title">Wakasetukpa</h5>
        <p class="card-text">
          Penjabat Wali Kota Sukabumi Hadiri Upacara Penutupan Pendidikan 923 Perwira di Setukpa Lemdiklat Polri.
        </p>
      </div>
    </div>
  </div>
</div>
@endsection
