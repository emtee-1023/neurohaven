@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Blogs</h1>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">Add New Blog</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Author</th>
                    <th>Published At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ ucfirst($blog->status) }}</td>
                        <td>{{ $blog->author->name ?? 'N/A' }}</td>
                        <td>{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this blog?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No blogs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
