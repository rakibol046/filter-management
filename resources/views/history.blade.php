<x-layouts::app :title="$title">

    <div class="flex flex-col gap-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($histories->isEmpty())

            <div class="rounded-xl border border-dashed p-10 text-center text-gray-500">
                No installation history found.
            </div>

        @else

            <div class="overflow-x-auto rounded-xl border">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Filter</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Kit</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Lifespan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Installed</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Next Change</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Remaining</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach($histories as $history)

                            @php
                                $today = now()->startOfDay();
                                $next = \Carbon\Carbon::parse($history->next_change_date)->startOfDay();

                                $daysLeft = $today->diffInDays($next, false);
                            @endphp

                            <tr class="hover:bg-gray-900">

                                <td class="px-6 py-4 font-medium">
                                    {{ $history->filter->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $history->kit->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $history->kit->kit_lifespan_days }} Days
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($history->change_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($history->next_change_date)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 text-center">

                                    @if($daysLeft < 0)

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                            Expired
                                        </span>

                                    @elseif($daysLeft <= 5)

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                                            {{ $daysLeft }} day{{ $daysLeft != 1 ? 's' : '' }} left
                                        </span>

                                    @elseif($daysLeft <= 15)

                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-700">
                                            {{ $daysLeft }} days left
                                        </span>

                                    @else

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                                            {{ $daysLeft }} days left
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @endif

    </div>

</x-layouts::app>