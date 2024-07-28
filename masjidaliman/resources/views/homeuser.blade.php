@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-center mb-4">Daftar Infaq Jamaah</h2>
    @if($jamaahs->isEmpty())
        <p class="text-center">Tidak ada data infaq untuk pengguna ini.</p>
    @else
        <table class="table table-bordered table-hover table-striped mb-0 bg-white">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Nomor</th>
                    <th>Infaq</th>
                    <th>File Path</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jamaahs as $jamaah)
                <tr>
                    <td>{{ $jamaah->nama }}</td>
                    <td>{{ $jamaah->nomor }}</td>
                    <td>{{ $jamaah->infaq_name }}</td>
                    <td>
                        @if($jamaah->file_path)
                        <a href="{{ asset('storage/' . $jamaah->file_path) }}">Download File</a>
                        @else
                            No File
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
