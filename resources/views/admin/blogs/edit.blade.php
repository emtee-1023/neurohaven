<x-layouts.app :title="__('Edit Blog')">
    <div class="max-w-2xl mx-auto py-8">
        <div class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
            <h1 class="text-2xl font-bold mb-6 text-accent">Edit Blog</h1>
            <form id="blog-edit-form" method="POST" action="{{ route('admin.blogs.update', $blog) }}"
                enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                    <input type="text" name="title" id="title"
                        class="mt-1 block w-full text-lg rounded-lg border-2 border-gray-300 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 text-gray-900 dark:text-gray-100 focus:border-accent focus:ring-accent focus:ring-2 focus:outline-none focus:cursor-text"
                        value="{{ old('title', $blog->title) }}" required>
                </div>
                <div>
                    <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Excerpt
                        <span class="text-xs text-gray-500 dark:text-gray-400 ml-1"
                            title="A short summary or introduction for your blog post. Shown in blog listings.">(What is
                            this?)</span>
                    </label>
                    <textarea name="excerpt" id="excerpt"
                        class="mt-1 block w-full text-lg rounded-lg border-2 border-gray-300 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 text-gray-900 dark:text-gray-100 focus:border-accent focus:ring-accent focus:ring-2 focus:outline-none focus:cursor-text"
                        rows="2">{{ old('excerpt', $blog->excerpt) }}</textarea>
                </div>
                <div>
                    <label for="content"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Content</label>
                    <div id="quill-editor" style="height: 350px;">{!! old('content', $blog->content) !!}</div>
                    <input type="hidden" name="content" id="content">
                </div>
                <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
                <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
                <script>
                    var quill = new Quill('#quill-editor', {
                        theme: 'snow',
                        modules: {
                            toolbar: [
                                [{
                                    header: [1, 2, false]
                                }],
                                ['bold', 'italic', 'underline', 'strike'],
                                ['blockquote', 'code-block'],
                                [{
                                    list: 'ordered'
                                }, {
                                    list: 'bullet'
                                }],
                                ['link', 'image'],
                                ['clean']
                            ]
                        }
                    });
                    document.getElementById('blog-edit-form').addEventListener('submit', function(e) {
                        document.getElementById('content').value = quill.root.innerHTML.trim();
                    });
                </script>
                <div>
                    <label for="featured_image"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Featured Image</label>
                    <div
                        class="mt-1 flex flex-col items-center justify-center border-2 border-dashed border-accent rounded-lg p-4 bg-gray-50 dark:bg-neutral-800 cursor-pointer hover:border-accent-dark transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-accent mb-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 16V8a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12l2 2 4-4" />
                        </svg>
                        <input type="file" name="featured_image" id="featured_image" accept="image/*"
                            class="w-full text-lg border-none bg-transparent focus:outline-none"
                            style="padding:0; margin:0;">
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-2">Upload a featured image for your
                            blog post.</span>
                        @if ($blog->featured_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image"
                                    class="rounded-md max-h-40">
                            </div>
                        @endif
                    </div>
                </div>
                <div>
                    <label for="status"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                    <select name="status" id="status"
                        class="mt-1 block w-full text-lg rounded-lg border-2 border-gray-300 dark:border-neutral-700 bg-gray-50 dark:bg-neutral-800 text-gray-900 dark:text-gray-100 focus:border-accent focus:ring-accent focus:ring-2 focus:outline-none focus:cursor-text">
                        <option value="draft" {{ old('status', $blog->status) == 'draft' ? 'selected' : '' }}>Draft
                        </option>
                        <option value="published" {{ old('status', $blog->status) == 'published' ? 'selected' : '' }}>
                            Published
                        </option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="submit"
                        class="px-6 py-2 bg-accent text-white dark:text-black rounded-md shadow hover:bg-accent-dark transition">Update
                        Blog</button>
                </div>
            </form>
            <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" class="mt-6">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-6 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition"
                    onclick="return confirm('Are you sure you want to delete this blog?')">Delete Blog</button>
            </form>
        </div>
    </div>
</x-layouts.app>
