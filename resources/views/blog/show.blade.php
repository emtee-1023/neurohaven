@extends('layouts.app')
@section('title', $blog->title)
@section('content')
    @include('partials.nav')
    <div class="container py-5">
        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">{{ $blog->title }}</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li><a href="{{ route('blog') }}">Blog</a></li>
                        <li class="current">{{ $blog->title }}</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <div class="row justify-content-center">
            <div>
                <div class="card shadow-sm border-0 mb-4">
                    @if ($blog->featured_image)
                        <img src="{{ asset('storage/' . $blog->featured_image) }}" class="w-100 card-img-top"
                            style="max-height: 700px; object-fit: fit;" alt="{{ $blog->title }}">
                    @else
                        <img src="{{ asset('storage/blog_images/default-blog.jpg') }}" class="w-100 card-img-top"
                            style="max-height: 500px; object-fit: cover;" alt="Default image">
                    @endif
                    <div class="card-body">
                        <p class="text-muted small mb-2">
                            <i class="bi bi-calendar"></i>
                            {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M j, Y') : '' }}
                        </p>
                        <h1 class="mt-3 mb-4">{{ $blog->title }}</h1>
                        <div class="mb-5">
                            {!! $blog->content !!}
                        </div>
                        <a href="{{ route('blog') }}" class="btn btn-success">&larr; Back to Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
