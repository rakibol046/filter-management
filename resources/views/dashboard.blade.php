<x-layouts::app :title="$title">

    <div class="space-y-6">

        <div class="grid gap-4 md:grid-cols-3">

            <div class="rounded-xl border p-6">
                <p class="text-sm text-gray-500">Total Filters</p>
                <h2 class="mt-2 text-4xl font-bold">
                    {{ $totalFilters }}
                </h2>
            </div>

            <div class="rounded-xl border p-6">
                <p class="text-sm text-gray-500">Total Kits</p>
                <h2 class="mt-2 text-4xl font-bold">
                    {{ $totalKits }}
                </h2>
            </div>

            <div class="rounded-xl border p-6">
                <p class="text-sm text-gray-500">
                    Expiring Within 5 Days
                </p>

                <h2 class="mt-2 text-4xl font-bold
                    {{ $expiringSoon ? 'text-red-600' : 'text-green-600' }}">
                    {{ $expiringSoon }}
                </h2>
            </div>

        </div>

        <div class="rounded-xl border">

            <div class="border-b px-6 py-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">
                    Upcoming Kit Expirations
                </h2>
                <a href="{{ route('history') }}"
                   class="border px-3 py-1 rounded font-semibold">
                    View All
                </a>
            </div>

            @if($upcomingHistories->isEmpty())

                <div class="p-10 text-center text-gray-500">
                    No upcoming expirations.
                </div>

            @else

                <table class="min-w-full divide-y divide-gray-200">

                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase">Filter</th>
                            <th class="px-6 py-3 text-left text-xs uppercase">Kit</th>
                            <th class="px-6 py-3 text-left text-xs uppercase">Next Change</th>
                            <th class="px-6 py-3 text-center text-xs uppercase">Remaining</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        @foreach($upcomingHistories as $history)

                            @php
                                $days = now()->startOfDay()->diffInDays(
                                    \Carbon\Carbon::parse($history->next_change_date),
                                    false
                                );
                            @endphp

                            <tr>

                                <td class="px-6 py-4">
                                    {{ $history->filter->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $history->kit->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($history->next_change_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-center">

                                    @if($days <= 5)

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm text-red-700">
                                            {{ $days }} Days
                                        </span>
                                    @elseif($days <= 15)

                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-700">
                                            {{ $days }} Days
                                        </span>

                                    @else

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm text-green-700">
                                            {{ $days }} Days
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @endif

        </div>

    </div>

</x-layouts::app>