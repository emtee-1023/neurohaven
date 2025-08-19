<x-layouts.app :title="__('Newsletter Submissions')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-4">
            <h2 class="text-lg font-bold mb-4 text-dark dark:text-neutral-100">Newsletter Emails</h2>
            <table id="newsletter-table" class="table table-striped table-bordered w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->email }}</td>
                            <td>{{ $submission->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#newsletter-table').DataTable();
                });
            </script>
        </div>
    </div>
</x-layouts.app>
