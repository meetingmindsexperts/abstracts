@extends('layouts.main')

@section('content')
    <div class="container py-5">
        <h2>Uploaded Videos</h2>

        {{-- Search Form --}}
        <form action="{{ route('admin.videos.index') }}" method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="email" class="form-control" placeholder="Search by Email" value="{{ request()->input('email') }}">
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('admin.videos.index') }}" class="btn btn-secondary">Clear</a>
                </div>
            </div>
        </form>

        {{-- Videos List --}}
        <ul class="list-group">
            @forelse($videos as $video)
                <li class="list-group-item d-flex flex-wrap justify-content-between align-items-center">
                    <p>{{ $video->email }} - {{ $video->paper_number }}</p>
                    <div class="mt-2 ">
                        <a href="{{ asset(Storage::url($video->video_path)) }}" class="btn btn-sm btn-primary mx-1" target="_blank">View</a>
                        <a href="{{ route('admin.videos.download', $video->id) }}" target="_blank" class="btn btn-sm btn-success mx-1">Download</a>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No videos found.</li>
            @endforelse
        </ul>

        {{-- Pagination Links --}}
        <div class="mt-4">
            {{ $videos->withQueryString()->links() }}
        </div>
    </div>
@endsection
