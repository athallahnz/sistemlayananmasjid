@extends('layouts.app')

@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
        <img src="{{ Vite::asset('resources/images/sholat-ied.JPG') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{ Vite::asset('resources/images/view-masjid.JPG') }}" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
        <img src="{{ Vite::asset('resources/images/ceramah.jpg') }}" class="d-block w-100" alt="...">
        </div>
    </div>
</div>
{{-- <div class="container-fluid"> --}}
<div id="jadwalsholat" class="" style="background-color: #622200">
    <div class="container py-5 px-4 background-color text-white" style="background-color: #622200">
        <div class="row py-2 px-4 bg-transparent">
            <div class="col-4 card-header">
                <h1 class="text-white">Jadwal Sholat</h1>
                <h4 class=" mt-4 text-white"><i class="bi bi-geo-fill text-white"></i> Surabaya </h4>
                <div class="card-footer text-white mt-4">
                    2 Juni 2024
                </div>
            </div>
            <div class="col bg-transparent">
                <ul class="list-group bg-transparent">
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Imsak
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Shubuh
                        <span class="badge bg-primary rounded-pill">2</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Terbit
                        <span class="badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Dhuhur
                        <span class="badge bg-primary rounded-pill">14</span>
                    </li>
                </ul>
            </div>
            <div class="col bg-transparent">
                <ul class="list-group bg-transparent">
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Ashar
                        <span class="badge bg-primary rounded-pill">2</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Maghrib
                        <span class="badge bg-primary rounded-pill">1</span>
                    </li>
                    <li class="d-flex justify-content-between align-items-center bg-transparent m-3">
                        Isya'
                        <span class="badge bg-primary rounded-pill">1</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div id="footer" class="">
    <div class="container py-5 px-4">
        <div class="row py-2 px-4">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col">
                        <a href="#" class="logo text-decoration-none">
                            <div class="d-flex">
                                <img class="img-fluid mb-4" src="{{ Vite::asset('resources/images/logo.png') }}" alt="Bootstrap Logo" width="90">
                            </div>
                        </a>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="bi bi-map"></i>
                                    </div>
                                    <div class="col">
                                        <a>Jl. Sutorejo Tengah VIII No.12, Dukuh Sutorejo, Kec. Mulyorejo, Surabaya, Jawa Timur 60113</a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="col">
                                        <a class="  " href="#">+62 85369369517</a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-2">
                                <div class="row">
                                    <div class="col-sm-1">
                                        <i class="bi bi-envelope-paper-heart"></i>
                                    </div>
                                    <div class="col">
                                        <a href="#">masjidalimansurabaya@gmail.com</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col">
                        <h5 class="mb-4">Kajian</h5>
                            <ul class="list-unstyled ">
                                <li class="mb-2"><a >Kajian Hari Besar Islam</a></li>
                                <li class="mb-2"><a >Kajian Rutin  Ahad Pagi</a></li>
                                <li class="mb-2"><a >Kajian Tafsir Qur'an</a></li>
                            </ul>
                        <h5 class="my-4">Kegiatan</h5>
                            <ul class="list-unstyled ">
                                <li class="mb-2"><a >Pesantrean Mahasiswa</a></li>
                                <li class="mb-2"><a >Tadarus Al Qur'an</a></li>
                                <li class="mb-2"><a >Syabab Rimayah Community Al Iman</a></li>
                                <li class="mb-2"><a >Panitia Ramadhan 1445 H</a></li>
                                <li class="mb-2"><a >Panitia Idul Adha 1445 H</a></li>
                            </ul>
                    </div>
                    <div class="col">
                        <h5 class="mb-4">Profil</h5>
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a >Sejarah</a></li>
                                    <li class="mb-2"><a >Struktur Organisasi</a></li>
                                    <li class="mb-2"><a >Struktur Organisasi</a></li>
                                </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        <div id="copyright" class="py-3" style="background-color: #622200">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12 text-center" style="color: white;">Masjid Al Iman Sutorejo Indah Surabaya | ©2024</div>
                </div>
            </div>
        </div>
</div>
{{-- </div> --}}
@endsection
