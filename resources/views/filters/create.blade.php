<x-layouts::app :title="$title">

    <div class="max-w-3xl mx-auto space-y-6">

       <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Add Filter</h1>

            <a href="{{ route('filters') }}"
               class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700">
                Back
            </a>
        </div>

        <form method="POST" action="{{ route('filters.store') }}">
            @csrf

            <div class="space-y-4">

                <div>
                    <label>Name</label>
                    <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Brand</label>
                    <input type="text" name="brand" class="w-full border rounded p-2" value="{{ old('brand') }}">
                    @error('brand')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Model</label>
                    <input type="text" name="model" class="w-full border rounded p-2" value="{{ old('model') }}">
                    @error('model')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

        


                <div>
                    <label>Description</label>
                    <textarea name="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label>Status</label>

                    <select name="status" class="w-full border rounded p-2 ">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button class="px-4 py-2 bg-blue-600 text-white rounded">
                    Save Filter
                </button>

            </div>

        </form>

    </div>

</x-layouts::app>