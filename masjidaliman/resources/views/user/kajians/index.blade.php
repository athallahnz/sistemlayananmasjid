@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kajian</h2>
    <table class="table table-bordered mt-3">
        <tr>
            {{-- <th>ID</th> --}}
            <th>Title</th>
            <th>Link YouTube</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kajians as $kajian)
        <tr>
            {{-- <td>{{ $kajian->id }}</td> --}}
            <td>{{ $kajian->title }}</td>
            <td><a href="{{ $kajian->youtube_link }}" target="_blank">{{ $kajian->youtube_link }}</a></td>
            <td>
                <a class="btn btn-info" href="{{ route('user.kajians.show', $kajian->id) }}">Show</a>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
