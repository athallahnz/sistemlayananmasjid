@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Kajian</h2>
    <a href="{{ route('kajians.create') }}" class="btn btn-primary">Tambah Kajian</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success mt-3">
            {{ $message }}
        </div>
    @endif
    <table class="table table-bordered mt-3">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Link YouTube</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($kajians as $kajian)
        <tr>
            <td>{{ $kajian->id }}</td>
            <td>{{ $kajian->title }}</td>
            <td><a href="{{ $kajian->youtube_link }}" target="_blank">{{ $kajian->youtube_link }}</a></td>
            <td>
                <form action="{{ route('kajians.destroy',$kajian->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('kajians.show',$kajian->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('kajians.edit',$kajian->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
