
@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mobility Experience</h2>

    @if (auth()->user()->role_id == 2) <!-- Only students (role_id 3) can see -->
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-4">Create New Post</a>
    @endif

    @if ($posts->count())
        <div id="postCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
            <div class="carousel-inner">
                @foreach ($posts->chunk(3) as $chunkIndex => $postChunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row">
                            @foreach ($postChunk as $post)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        @if ($post->photo)
                                            <img src="{{ asset('storage/' . $post->photo) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('https://placehold.co/600x400/cccccc/ffffff?text=No+Image+Available') }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <a href="{{ route('posts.full.post', $post->id) }}" class="btn btn-outline-primary mt-auto">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#postCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#postCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @else
        <p class="text-muted text-center">No posts available.</p>
    @endif
</div>

<!-- Custom CSS for Arrow Hover Effect -->
<style>
/* Darker, visible, rounded carousel arrows */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.7);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    transition: all 0.3s ease;
}

/* Hover effect */
.carousel-control-prev:hover .carousel-control-prev-icon,
.carousel-control-next:hover .carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.9);
    transform: scale(1.2);
}
</style>
@endsection



