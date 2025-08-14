<x-layouts.app :title="__('Blog List')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-accent">{{ $blogs->count() }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Total Blogs</div>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-green-600">{{ $blogs->where('status', 'published')->count() }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Published Blogs</div>
            </div>
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-red-600">{{ $blogs->where('status', 'draft')->count() }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Draft Blogs</div>
            </div>
        </div>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <div>
            <a href="{{ route('admin.blogs.create') }}"
                class="px-4 py-2 bg-accent text-white dark:text-black rounded-md shadow hover:bg-accent-dark transition mb-3 inline-block">Add
                New Blog</a>
        </div>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-4">
            <table id="blogs-table" class="display w-full">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Published On</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->title }}</td>
                            <td>{{ ucfirst($blog->status) }}</td>
                            <td>{{ $blog->published_at ? \Carbon\Carbon::parse($blog->published_at)->format('D d M Y') : '-' }}
                            </td>
                            <td>
                                <a href="{{ route('admin.blogs.edit', $blog) }}"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">Edit</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition"
                                        onclick="return confirm('Delete this blog?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#blogs-table').DataTable();
                });
            </script>
        </div>
    </div>
</x-layouts.app>
