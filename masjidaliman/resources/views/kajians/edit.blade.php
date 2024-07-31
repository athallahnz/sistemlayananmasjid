@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Kajian</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kajians.update', $kajian->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" value="{{ $kajian->title }}" class="form-control" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" placeholder="Description">{{ $kajian->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="youtube_link">YouTube Link:</label>
            <input type="url" name="youtube_link" value="{{ $kajian->youtube_link }}" class="form-control" placeholder="YouTube Link">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control">
            @if($kajian->image)
                <img src="/images/{{ $kajian->image }}" width="100px">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
