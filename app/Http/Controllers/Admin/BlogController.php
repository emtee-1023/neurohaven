<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')->latest()->get();
        return view('blog.admin-index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:51200',
            'status' => 'required|in:draft,published',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        $validated['author_id'] = Auth::id();
        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }
        $blog = Blog::create($validated);
        return redirect()->route('admin.blogs.edit', $blog)->with('success', 'Blog created!');
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:51200',
            'status' => 'required|in:draft,published',
        ]);
        $validated['slug'] = Str::slug($validated['title']);
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blog_images', 'public');
        }
        if ($validated['status'] === 'published' && !$blog->published_at) {
            $validated['published_at'] = now();
        }
        $blog->update($validated);
        return redirect()->route('admin.blogs.edit', $blog)->with('success', 'Blog updated!');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted!');
    }
}
