@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Kajian</h2>
    <div class="card">
        <div class="card-header">
            {{ $kajian->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Description</h5>
            <p class="card-text">{{ $kajian->description }}</p>
            <h5 class="card-title">Image</h5>
            @if($kajian->image)
                <img src="/images/{{ $kajian->image }}" alt="{{ $kajian->title }}" class="img-fluid">
            @else
                <p>No Image Available</p>
            @endif
            <a href="{{ $kajian->youtube_link }}" target="_blank" class="btn btn-primary mt-3">Watch on YouTube</a>
        </div>
    </div>
    <a class="btn btn-primary mt-3" href="{{ route('user.kajians.index') }}">Back</a>
</div>
@endsection
