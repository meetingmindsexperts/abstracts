@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h2>Video Details</h2>
        <p>Email: {{ $video->email }}</p>
        <p>Paper Number: {{ $video->paper_number }}</p>
        <div>
            <a href="{{ $videoUrl }}" target="_blank">View Video</a>
            <video width="320" height="240" controls>
                <source src="{{ Storage::disk('local')->url($video->video_path) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
@endsection
