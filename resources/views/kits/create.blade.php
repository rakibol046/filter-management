<x-layouts::app :title="$title">

    <div class="max-w-3xl mx-auto space-y-6">

       <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">{{ $title }}</h1>

            <a href="{{ route('kits') }}"
               class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700">
                Back
            </a>
        </div>

        <form method="POST" action="{{ route('kits.store') }}">
            @csrf

            <div class="space-y-4">

                  <div>
                    <label>Select the Filter</label>

                    <select name="filter_id" class="w-full border rounded p-2">
                        @foreach ($filters as $filter)
                            <option class="text-black" value="{{ $filter->id }}">{{ $filter->name }}</option>
                        @endforeach
                        @error('filter_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </select>
                </div>


                <div>
                    <label>Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2 required">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Brand</label>
                    <input type="text" name="brand" class="w-full border rounded p-2">
                    @error('brand')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Kit Lifespan (Days)</label>
                    <input type="number" name="kit_lifespan_days" class="w-full border rounded p-2">
                    @error('kit_lifespan_days')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Save Kit
                </button>

            </div>

        </form>

    </div>

</x-layouts::app>