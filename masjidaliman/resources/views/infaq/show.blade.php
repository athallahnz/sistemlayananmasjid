<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masjid Al Iman Surabaya</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-sm my-5">
        <div class="row justify-content-center">
            <div class="p-5 bg-light rounded-3 col-xl-4 border">
            <div class="mb-3 text-center">
            <i class="bi-person-circle fs-1"></i>
            <h4>Detail Infaq</h4>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <h5>{{ $jamaahs->nama }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="nomor" class="form-label">Nomor</label>
                    <h5>{{ $jamaahs->nomor }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="infaq" class="for-label">Tujuan</label>
                    <h5>{{ $jamaahs->infaq->name }}</h5>
                </div>
                <div class="col-md-12 mb-3">
                <label for="age" class="form-label">Bukti</label>
                        @if ($jamaahs->file_path)
                            <h5>{{ $jamaahs->file_path }}</h5>
                            {{-- <a href="{{ route('employees.downloadFile', ['employeeId' => $employee->id]) }}" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-download me-1"></i> Download CV
                            </a> --}}
                        @else
                            <h5>Tidak ada</h5>
                        @endif
                <hr>
                <div class="row">
                    <div class="col-md-12 d-grid">
                        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-lg mt-3"><i class="bi-arrow-left-circle me-2"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
