<x-layouts::app :title="$title">

    <div class="max-w-3xl mx-auto space-y-6">

        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>

            <a href="{{ route('kits') }}"
               class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700">
                Back
            </a>
        </div>

        <form method="POST" action="{{ route('kits.update', $kit->id) }}">
            @csrf
            @method('PUT')

            <div class="space-y-4">

                <div>
                    <label class="block mb-1 font-medium">Select the Filter</label>

                    <select name="filter_id" class="w-full rounded border p-2">
                        @foreach ($filters as $filter)
                            <option
                                value="{{ $filter->id }}"
                                @selected(old('filter_id', $kit->filter_id) == $filter->id)
                            >
                                {{ $filter->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('filter_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Name</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $kit->name) }}"
                        class="w-full rounded border p-2"
                        required
                    >

                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Brand</label>

                    <input
                        type="text"
                        name="brand"
                        value="{{ old('brand', $kit->brand) }}"
                        class="w-full rounded border p-2"
                    >

                    @error('brand')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block mb-1 font-medium">Kit Lifespan (Days)</label>

                    <input
                        type="number"
                        name="kit_lifespan_days"
                        value="{{ old('kit_lifespan_days', $kit->kit_lifespan_days) }}"
                        class="w-full rounded border p-2"
                    >

                    @error('kit_lifespan_days')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <button
                    type="submit"
                    class="rounded bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                    Update Kit
                </button>

            </div>

        </form>

    </div>

</x-layouts::app>