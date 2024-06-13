@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container-fluid">
    <h3 class="position-absolute text-center text-white fs-1">Selamat Datang di Dashboard Jamaah</h3>
    <img class="img-fluid" src="{{ Vite::asset('resources/images/sholat-ied.JPG') }}" alt="...">
    <div>

    </div>
</div>
<div class="container mt-4" >
    <div class="row mb-0">
        <div class="col-lg-9 col-xl-10">
            <h4 class="mb-3">-{{--{{ $pageTitle }}--}} </h4>
        </div>
        <div class="col-lg-3 col-xl-2">
            <div class="d-grid gap-2">
                <a href="{{ route('jamaah.create') }}" class="btn btn-primary">Tambah Jamaah</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="table-responsive border p-3 rounded-3">
        <table class="table table-bordered table-hover table-striped mb-0 bg-white">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>No.Tlp</th>
                    <th>Tujuan</th>
                    <th>Bukti Transfer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jamaahs as $jamaah)
                <tr>
                    <td>{{ $jamaah->nama }}</td>
                    <td>{{ $jamaah->nomor }}</td>
                    <td>{{ $jamaah->infaq_name }}</td>
                    <td>-</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('jamaah.show', ['jamaah' => 1]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-person-lines-fill"></i></a>
                            <a href="{{ route('jamaah.edit', ['jamaah' => 1]) }}" class="btn btn-outline-dark btn-sm me-2"><i class="bi-pencil-square"></i></a>

                            <div>
                                <form action="{{ route('jamaah.destroy', ['jamaah' => 1]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-dark btn-sm me-2"><i class="bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
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
</div> --}}
@endsection
