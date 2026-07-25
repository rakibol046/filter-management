<x-layouts::app :title="$title">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ $title }}</h1>
        <x-button wire:navigate href="{{ route('filters.create') }}">{{ __('Add Filter') }}</x-button>
      </div>

      <div class="flex items-center gap-2">
        <x-input wire:model="search" placeholder="Search filters..." />
        <x-button wire:navigate href="{{ route('filters') }}">Reset</x-button>
      </div>

<div class="flex flex-col gap-4">

    @if(session('success'))
        <div class="rounded-lg bg-green-100 p-4 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if($filters->isEmpty())
        <div class="rounded-xl border border-dashed p-10 text-center text-gray-500">
            No filters found.
        </div>
    @else

        <div class="overflow-x-auto rounded-xl border">
            <table class="min-w-full divide-y divide-gray-200">

                <thead class="">
                    <tr>
                        {{-- <th class="px-6 py-3 text-left text-xs font-semibold uppercase">#</th> --}}
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Brand</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Model</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Status</th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-semibold uppercase">Created</th> --}}
                        <th class="px-6 py-3 text-center text-xs font-semibold uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">

                    @foreach($filters as $filter)

                        <tr class="hover:bg-gray-900">

                            {{-- <td class="px-6 py-4">
                                {{ $loop->iteration }}
                            </td> --}}

                            <td class="px-6 py-4 font-medium">
                                {{ $filter->name }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $filter->brand }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $filter->model ?: '-' }}
                            </td>

                       

                            <td class="px-6 py-4">
                                @if($filter->status)
                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-700">
                                        Active
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-700">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            {{-- <td class="px-6 py-4">
                                {{ $filter->created_at->format('d M Y') }}
                            </td> --}}

                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('filters.edit', $filter->id) }}"
                                        class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('filters.destroy', $filter->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this filter?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            class="rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">
                                            Delete
                                        </button>

                                    </form>
                                    <form action="{{ route('history.create') }}" method="POST" class="inline">
                                        @csrf

                                        <input type="hidden" name="filter_id" value="{{ $filter->id }}">

                                        <button
                                            type="submit"
                                            class="rounded bg-blue-600 px-3 py-1 text-sm text-white hover:bg-blue-700">
                                            Install Kit
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    @endif

</div>
    </div>
</x-layouts::app>
