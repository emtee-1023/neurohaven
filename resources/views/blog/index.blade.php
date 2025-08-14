@extends('layouts.app')
@section('title', 'Neurohaven | Blog')
@section('content')
    <div class="container py-5">
        @include('partials.nav')
        <!-- Page Title -->
        <div class="page-title">
            <div class="container d-lg-flex justify-content-between align-items-center">
                <h1 class="mb-2 mb-lg-0">Blog</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ route('landing') }}">Home</a></li>
                        <li class="current">Blog</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <div class="row">
            @forelse($blogs as $blog)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <!-- Blog Image -->
                        @if ($blog->featured_image)
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" class="w-100 card-img-top"
                                style="max-height: 500px; object-fit: cover;" alt="{{ $blog->title }}">
                        @else
                            <img src="{{ asset('storage/blog_images/default-blog.jpg') }}" class="w-100 card-img-top"
                                style="max-height: 500px; object-fit: cover;" alt="Default image">
                        @endif

                        <!-- Blog Content -->
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <a href="{{ route('blog.show', $blog->slug) }}" class="text-decoration-none text-dark">
                                    {{ $blog->title }}
                                </a>
                            </h5>

                            <!-- Meta Info -->
                            <p class="text-muted small mb-2">
                                <i class="bi bi-calendar"></i>
                                {{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('M j, Y') : '' }}
                            </p>

                            <!-- Excerpt -->
                            <p class="card-text">
                                {{ Str::limit(strip_tags($blog->content), 120) }}
                            </p>

                            <!-- Read More -->
                            <a href="{{ route('blog.show', $blog->slug) }}" class="btn btn-success">
                                Read More
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No blog posts found.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection
