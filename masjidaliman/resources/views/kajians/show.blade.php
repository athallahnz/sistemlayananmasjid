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
            @if($kajian->image)
                <img src="/images/{{ $kajian->image }}" class="img-fluid mb-3" alt="{{ $kajian->title }}">
            @endif
            <a href="{{ $kajian->youtube_link }}" target="_blank" class="btn btn-primary">Watch on YouTube</a>
        </div>
    </div>
    <a class="btn btn-primary mt-3" href="{{ route('kajians.index') }}">Back</a>
</div>
@endsection
