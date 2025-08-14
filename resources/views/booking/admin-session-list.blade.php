<x-layouts.app :title="__('Session List')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            {{-- Number of Upcoming Requests --}}
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-accent">{{ $sessions->where('session_time', '>=', now())->count() }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Upcoming Requests</div>
            </div>

            {{-- Number of Upcoming Paid Requests --}}
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-green-600">
                    {{ $sessions->where('session_time', '>=', now())->where('payment_status', 'paid')->count() }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Upcoming Paid Requests</div>
            </div>

            {{-- Number of Unpaid Upcoming Requests --}}
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 flex flex-col items-center justify-center p-4">
                <div class="text-3xl font-bold text-red-600">
                    {{ $sessions->where('session_time', '>=', now())->whereIn('payment_status', ['pending', 'failed'])->count() }}
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-300 mt-2">Unpaid Upcoming Requests</div>
            </div>
        </div>

        {{-- Table of Session Request Data --}}
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-4">
            <table id="sessions-table" class="display w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Session Time</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sessions as $session)
                        <tr>
                            <td>{{ $session->name }}</td>
                            <td><a href="mailto:{{ $session->email }}"
                                    class="text-blue-600 hover:underline">{{ $session->email }}</a></td>
                            <td>
                                @php
                                    $dt = \Carbon\Carbon::parse($session->session_time);
                                @endphp
                                {{ $dt->format('D d M \a\t H:i\h') }}
                            </td>
                            <td>{{ $session->payment_status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#sessions-table').DataTable();
                });
            </script>
        </div>
    </div>
</x-layouts.app>
