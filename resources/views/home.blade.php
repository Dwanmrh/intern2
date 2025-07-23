@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="3000">
            <img src="{{ asset('assets/images/setukpa1.jpg') }}" class="d-block w-100 carousel-img" alt="Setukpa 1">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="{{ asset('assets/images/setukpa2.jpg') }}" class="d-block w-100 carousel-img" alt="Setukpa 2">
        </div>
        <div class="carousel-item" data-bs-interval="3000">
            <img src="{{ asset('assets/images/setukpa3.jpg') }}" class="d-block w-100 carousel-img" alt="Setukpa 3">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="overflow-hidden">
                    <img src="{{ asset('assets/images/kasetukpa.png') }}" class="fixed-card-img w-100" alt="Kalemdiklat">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nama Pimpinan</h5>
                    <p class="card-text">Jabatan</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="overflow-hidden">
                    <img src="{{ asset('assets/images/berita2.png') }}" class="fixed-card-img w-100" alt="Kasetukpa">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nama Pimpinan</h5>
                    <p class="card-text">Jabatan</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="overflow-hidden">
                    <img src="{{ asset('assets/images/berita6.jpg') }}" class="fixed-card-img w-100" alt="Wakasetukpa">
                </div>
                <div class="card-body">
                    <h5 class="card-title">Nama Pimpinan</h5>
                    <p class="card-text">Jabatan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
