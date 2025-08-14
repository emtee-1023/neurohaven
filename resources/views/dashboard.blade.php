<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- Total Bookings -->
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-success shadow bg-white dark:bg-neutral-900 p-4 flex flex-col justify-center items-center">
                <h2 class="text-lg font-bold mb-2 text-dark dark:text-neutral-100">Total Bookings</h2>
                <span
                    class="text-3xl font-extrabold text-success dark:text-success">{{ \App\Models\Booking::count() }}</span>
            </div>

            <!-- Total Revenue -->
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-warning shadow bg-white dark:bg-neutral-900 p-4 flex flex-col justify-center items-center">
                <h2 class="text-lg font-bold mb-2 text-dark dark:text-neutral-100">Total Revenue</h2>
                <span class="text-green-600 text-3xl font-extrabold text-warning dark:text-warning">KES
                    {{ number_format(\App\Models\Booking::where('payment_status', 'paid')->sum('amount')) }}</span>
            </div>
            <!-- Bookings by Status -->
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-info shadow bg-white dark:bg-neutral-900 p-4 flex flex-col justify-center items-center">
                <h2 class="text-lg font-bold mb-2 text-dark dark:text-neutral-100">Booking Status</h2>
                <ul class="w-full">
                    <li class="flex justify-between py-1">
                        <span>Paid</span><span>{{ \App\Models\Booking::where('payment_status', 'paid')->count() }}</span>
                    </li>
                    <li class="flex justify-between py-1">
                        <span>Pending</span><span>{{ \App\Models\Booking::where('payment_status', 'pending')->count() }}</span>
                    </li>
                    <li class="flex justify-between py-1">
                        <span>Failed</span><span>{{ \App\Models\Booking::where('payment_status', 'failed')->count() }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Recent Bookings Table -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 p-4">
            <h2 class="text-lg font-bold mb-4 text-dark dark:text-neutral-100">Recent Bookings</h2>
            <table id="dashboard-table" class="table table-striped table-bordered w-full">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Session Time</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (\App\Models\Booking::latest()->take(50)->get() as $booking)
                        <tr>
                            <td>{{ $booking->name }}</td>
                            <td><a href="mailto:{{ $booking->email }}"
                                    class="text-blue-600 hover:underline">{{ $booking->email }}</a></td>
                            <td>{{ $booking->session_time ? \Carbon\Carbon::parse($booking->session_time)->format('D d M \a\t H:i\h') : '' }}
                            </td>
                            <td>
                                <span
                                    class="px-2 py-1 rounded {{ $booking->payment_status == 'paid' ? 'bg-success text-white' : ($booking->payment_status == 'pending' ? 'bg-warning text-dark' : 'bg-danger text-white') }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </td>
                            <td>KES {{ number_format($booking->amount) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <script>
                $(document).ready(function() {
                    $('#dashboard-table').DataTable();
                });
            </script>
        </div>
    </div>
</x-layouts.app>
