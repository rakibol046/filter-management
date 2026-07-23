<x-layouts::app :title="$title">
    <div class="flex h-full flex-col gap-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>

            <x-button wire:navigate href="{{ route('kits.create') }}">
                Add Kit
            </x-button>
        </div>

        @if(session('success'))
            <div class="rounded-lg bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-6">

            @foreach($filters as $filter)

                <div class="rounded-xl overflow-hidden">

                    {{-- Filter Header --}}
                    <div class=" py-4">
                        <h2 class="text-lg font-semibold">
                            {{ $filter->name }}
                        </h2>
                    </div>

                    @if($filter->kits->isEmpty())

                        <div class="px-6 py-8 text-center text-gray-500 border rounded-xl">
                            No kits added for this filter.
                        </div>

                    @else
                        <div class="overflow-x-auto rounded-xl border">
                        <table class="min-w-full">

                            <thead class="border">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                        Kit Name
                                    </th>
                                     <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                        Brand
                                    </th>
                                     <th class="px-6 py-3 text-left text-xs font-semibold uppercase">
                                        Kit Lifespan (Days)
                                    </th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold uppercase">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($filter->kits as $kit)

                                    <tr class="border-b hover:bg-gray-900">

                                        <td class="px-6 py-4 font-medium">
                                            {{ $kit->name }}
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                            {{ $kit->brand }}
                                        </td>
                                        <td class="px-6 py-4 font-medium">
                                            {{ $kit->kit_lifespan_days }}

                                        <td class="px-6 py-4">

                                            <div class="flex justify-center gap-2">

                                                <a
                                                    href="{{ route('kits.edit',$kit->id) }}"
                                                    class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700">
                                                    Edit
                                                </a>

                                                <form
                                                    action="{{ route('kits.destroy',$kit->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Delete this kit?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>
                        </div

                    @endif

                </div>

            @endforeach

        </div>

    </div>
</x-layouts::app>