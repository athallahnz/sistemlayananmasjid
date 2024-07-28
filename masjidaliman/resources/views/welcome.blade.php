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

<div id="jadwalsholat" class="" style="background-color: #622200">
    <div class="container py-5 px-4 background-color text-white" style="background-color: #622200">
        <div class="row py-2 px-4 bg-transparent">
            <div class="col-4 card-header">
                <h1 class="fw-bold text-white">Jadwal Sholat</h1>
                <h5 class=" my-4 text-white"><i class="bi bi-geo-fill text-white"></i> Surabaya, {{ \Carbon\Carbon::now()->format('d F Y') }}</h5>
                {{-- <div class="card-footer text-white mt-4">
                    {{ \Carbon\Carbon::now()->format('d F Y') }}
                </div> --}}
                {{-- <form action="{{ route('welcome') }}" method="GET" class="mb-3">
                    <div class="input-group mt-5">
                        <input type="text" class="form-control mt-5" placeholder="Cari kotamu!" name="search_city" value="{{ $searchCity ?? '' }}">
                        <button class="btn btn-outline-light mt-5" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form> --}}
            </div>
            <div class="col bg-transparent">
                <ul class="list-group bg-transparent">
                    @if(isset($jadwalDefault['data']['jadwal']))
                        @php $jadwal = $jadwalDefault['data']['jadwal'][0]; @endphp
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Imsak
                            <span class="badge bg-secondary">{{ $jadwal['imsak'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Shubuh
                            <span class="badge bg-secondary">{{ $jadwal['subuh'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Terbit
                            <span class="badge bg-secondary">{{ $jadwal['terbit'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Dhuha
                            <span class="badge bg-secondary">{{ $jadwal['dhuha'] }}</span>
                        </h4>
                    @else
                        <p class="text-white">Data tidak tersedia untuk Surabaya.</p>
                    @endif
                </ul>
            </div>
            <div class="col bg-transparent">
                <ul class="list-group bg-transparent">
                    @if(isset($jadwalDefault['data']['jadwal']))
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Dzuhur
                            <span class="badge bg-secondary">{{ $jadwal['dzuhur'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Ashar
                            <span class="badge bg-secondary">{{ $jadwal['ashar'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Maghrib
                            <span class="badge bg-secondary">{{ $jadwal['maghrib'] }}</span>
                        </h4>
                        <h4 class="d-flex justify-content-between align-items-center bg-transparent m-3">
                            Isya'
                            <span class="badge bg-secondary">{{ $jadwal['isya'] }}</span>
                        </h4>
                    @else
                        <p class="text-white">Data tidak tersedia untuk Surabaya.</p>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-sm mt-5">
    <form action="{{ route('home.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 border col-xl-6">
                <div class="mb-4 text-center">
                    <h4 class="fs-2 fw-bold">Siapkan Infaq Terbaikmu!</h4>
                </div>
                <div class="row">
                    <div class="col-mb-3">
                        <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" value="{{ Auth::check() ? Auth::user()->name : '' }}" placeholder="Masukkan Nama">
                        <input class="form-control @error('user_id') is-invalid @enderror" type="hidden" name="user_id" id="user_id" value="{{ Auth::check() ? Auth::id() : ''}}" placeholder="Masukkan Nama">
                        @error('nama')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                        <input class="form-control mt-3 @error('nomor') is-invalid @enderror" type="text" name="nomor" id="nomor" value="{{ old('nomor') }}" placeholder="Masukkan No. Tlp">
                        @error('nomor')
                        <div class="text-danger"><small>{{ $message }}</small></div>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <div class="col-md-12 mb-3">
                            <label for="infaq" class="form-label">Tentukan tujuan Infaqmu</label>
                            <select name="infaq" id="infaq" class="form-select mb-3">
                                @foreach ($infaqs as $Infaq)
                                <option value="{{ $Infaq->id }}" {{ old('infaq') == $Infaq->id ? 'selected' : '' }}>{{ $Infaq->code.' - '.$Infaq->name }}</option>
                                @endforeach
                            </select>
                            @error('infaq')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                            <label for="infaq" class="form-label">Upload bukti transfer</label>
                            <input class="form-control" type="file" id="formFile" name="file">
                            @error('file')
                            <div class="text-danger"><small>{{ $message }}</small></div>
                            @enderror
                        </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-outline-light" style="background-color: #622200">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
</div>
<div id="copyright" class="container-fluid py-3" style="background-color: #622200">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xs-12 text-center" style="color: white;">Masjid Al Iman Sutorejo Indah Surabaya | ©2024</div>
        </div>
    </div>
</div>

@endsection
