<x-layouts::app :title="$title">

    <div class="max-w-3xl mx-auto space-y-6">

        <div class="mb-6 flex items-center justify-between">
            <h1 class="text-2xl font-bold">Edit Filter</h1>

            <a href="{{ route('filters') }}"
               class="rounded bg-gray-600 px-4 py-2 text-white hover:bg-gray-700">
                Back
            </a>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('filters.update', $filter->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-5">

                <!-- Name -->
                <div>
                    <label class="mb-1 block font-medium">
                        Filter Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $filter->name) }}"
                        class="w-full rounded-lg border p-2">
                </div>

                <!-- Brand -->
                <div>
                    <label class="mb-1 block font-medium">
                        Brand
                    </label>

                    <input
                        type="text"
                        name="brand"
                        value="{{ old('brand', $filter->brand) }}"
                        class="w-full rounded-lg border p-2">
                </div>

                <!-- Model -->
                <div>
                    <label class="mb-1 block font-medium">
                        Model
                    </label>

                    <input
                        type="text"
                        name="model"
                        value="{{ old('model', $filter->model) }}"
                        class="w-full rounded-lg border p-2">
                </div>

               
                <!-- Description -->
                <div>
                    <label class="mb-1 block font-medium">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        class="w-full rounded-lg border p-2">{{ old('description', $filter->description) }}</textarea>
                </div>

                <!-- Status -->
                <div>
                    <label class="mb-1 block font-medium">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-lg border p-2">

                        <option value="1" {{ old('status', $filter->status) ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ !old('status', $filter->status) ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3">

                    <button
                        type="submit"
                        class="rounded bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                        Update Filter
                    </button>

                    <a
                        href="{{ route('filters') }}"
                        class="rounded bg-gray-500 px-6 py-2 text-white hover:bg-gray-600">
                        Cancel
                    </a>

                </div>

            </div>

        </form>

    </div>

</x-layouts::app>